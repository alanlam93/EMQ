<?php
if (!isset($_GET['order'])) {
    header('Location: index.php');
    return;
}

require 'include/header.php';

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while accessing the database.";
    return;
}

$orderId = $mysqli->real_escape_string($_GET['order']);
$orderResult = $mysqli->query("SELECT accountId, address_pt1, address_pt2, date, TIMESTAMPDIFF(SECOND, date, CURRENT_TIMESTAMP()) as time_elapsed, est_speed FROM `order` WHERE order.id = $orderId");
if ($orderResult->num_rows > 0) {
    $orderDetails = $orderResult->fetch_array(MYSQLI_ASSOC);
    $customerAddress = $orderDetails['address_pt1'] . ' ' . $orderDetails['address_pt2'];
    $orderDate = $orderDetails['date'];
    $orderTimeStamp = explode(" ", $orderDate);

    $closestWarehouse = $mysqli->query("SELECT address, city, state, zip, lat, 'long' FROM `warehouse_address` INNER JOIN `order` ON order.warehouseId = warehouse_address.id WHERE order.id = $orderId");
    $warehouseResult = $closestWarehouse->fetch_array(MYSQLI_ASSOC);
    $warehouseAddress = $warehouseResult['address'] . ', ' . $warehouseResult['city'] . ', ' . $warehouseResult['state'] . ' ' . $warehouseResult['zip'];
    $orderResult->close();
}

$mysqli->close();

if (!isset($_SESSION['userid']) || !isset($orderDetails) || isset($_SESSION['userid']) && $orderDetails['accountId'] != $_SESSION['userid']) {
    header('Location: index.php');
    return;
}
?>

                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmNrhRRBuvnxqNgPSluDN-PX59TbDWWBw&libraries=geometry"></script>
                <script type ="text/javascript" src="http://www.geocodezip.com/scripts/v3_epoly.js"></script>
                <div class="container" id="ctnr">
                    <div class="container">
                        <h2>Package Status for <span style="color: green;">Order #<?php echo $orderId; ?></span></h2>
                        <p>Track the status of your package. Green indicates current package status.</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-1" role="progressbar" style="width:25%;background:silver" id="step-1">
                                <h4 class="hidden-xs">Order Processed</h4>
                                <h5 class="visible-xs">Processed</h5>
                            </div>
                            <div class="progress-bar progress-bar-2" role="progressbar" style="width:25%;background:silver" id="step-2">
                                <h4 class="hidden-xs">Preparing for Delivery</h4>
                                <h5 class="visible-xs">Preparing</h5>
                            </div>
                            <div class="progress-bar progress-bar-3" role="progressbar" style="width:25%;background:silver" id="step-3">
                                <h4 class="hidden-xs">Out for Delivery</h4>
                                <h5 class="visible-xs">In Transit</h5>
                            </div>
                            <div class="progress-bar progress-bar-4" role="progressbar" style="width:25%;background:silver" id="step-4">
                                <h4 class="hidden-xs">Delivered</h4>
                                <h5 class="visible-xs">Delivered</h5>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript" src="assets/flipclock.js"></script>
                    <link rel="stylesheet" href="assets/flipclock.css">
                    <script type="text/javascript" src="assets/flipclock.min.js"></script>

                    <div class="clock"></div>
                    <div class="description">
                    </div>

                    <script type="text/javascript">

                        document.getElementsByClassName('progress-bar-1')[0].style.backgroundColor = "#33B63B";
                        document.getElementsByClassName('progress-bar-2')[0].style.backgroundColor = "#33B63B";

                        var x = '<?php echo json_encode($warehouseAddress); ?>';
                        var warehouseAddress = x.split('"');

                        var y = '<?php echo json_encode($customerAddress); ?>';
                        var customerAddress = y.split('"');

                        for (var i = customerAddress.length; i >= 0; i--) {
                            if (i % 2 === 0) {
                                warehouseAddress.splice(i, 1);
                                customerAddress.splice(i, 1);
                            }
                        }

                        var map;
                        var directionDisplay;
                        var directionsService;
                        var stepDisplay;

                        var position;
                        var marker = [];
                        var polyline = [];
                        var poly2 = [];
                        var poly = null;
                        var startLocation = [];
                        var endLocation = [];
                        var timerHandle = [];
                        var finish = false;

                        var speed = 0.000005, wait = 1;
                        var infowindow = null;

                        var startLoc = new Array();
                        var endLoc = new Array();

                        endLoc[0] = customerAddress[0];
                        startLoc[0] = warehouseAddress[0];

                        var dist_and_traffic = calculateDistances();
                        var dist = dist_and_traffic[0];
                        var traffic = dist_and_traffic[1];

                        orderTime = '<?php echo $orderTimeStamp[0]; ?>' + ' ' + '<?php echo $orderTimeStamp[1]; ?>';
                        var orderTime = Date.parse(orderTime);
                        var currentTime = Date.now();
                        var deliveryTime = orderTime + traffic * 60000;
                        var someTime = deliveryTime - currentTime;
                        if ((deliveryTime - currentTime) < 1) {
                            someTime = 0;
                        }

                        var clock = $('.clock').FlipClock((someTime / 1000), {
                            countdown: true
                        });

               
                        var addTime = setInterval(function() {
                            if((clock.getTime().time <= 10) && (finish == false)){
                                clock.setTime(10);
                            } 
                            if(finish) {
                                clock.setTime(0);
                                clock.stop();
                            }
                        }, 3000);
                        

                        function initialize() {
                            infowindow = new google.maps.InfoWindow(
                                    {
                                        size: new google.maps.Size(25, 25)
                                    });
                            var myOptions = {
                                zoom: 13,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
                            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                            var overlay = document.createElement('h6');
                            overlay.style.color = 'black';
                            overlay.innerHTML = '&nbsp' + 'Distance: ' + dist + '&nbsp';
                            var textBox = document.createElement('div');
                            textBox.appendChild(overlay);
                            textBox.style.border = "solid thin black";
                            textBox.style.backgroundColor = "white";
                            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(textBox);
                            setRoutes();
                        }

                        function createMarker(latlng, label, html) {
                            var contentString = '<b>' + label + '</b><br>' + html;

                            var icon = {
                                url: "./img/turkey.png",
                                scaledSize: new google.maps.Size(35, 35),
                                origin: new google.maps.Point(0, 0), 
                                anchor: new google.maps.Point(5, 30)
                            };

                            var icon2 = {
                                url:"./img/pilgrim.png",
                                scaledSize: new google.maps.Size(35, 35)
                            };

                            if (label === "Turkey") {
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: map,
                                    title: label,
                                    icon: icon,
                                    zIndex: Math.round(latlng.lat() * -100000) << 5
                                });
                                marker.myname = label;
                            } else {
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: map,
                                    title: label,
                                    icon: icon2,
                                    zIndex: Math.round(latlng.lat() * -100000) << 5
                                });
                                marker.myname = label;
                            }

                            google.maps.event.addListener(marker, 'click', function () {
                                infowindow.setContent(contentString);
                                infowindow.open(map, marker);
                            });
                            return marker;
                        }

                        function setRoutes() {
                            var directionsDisplay = new Array();
                            for (var i = 0; i < startLoc.length; i++) {
                                var rendererOptions = {
                                    map: map,
                                    suppressMarkers: true,
                                    preserveViewport: true
                                };
                                directionsService = new google.maps.DirectionsService();
                                var travelMode = google.maps.DirectionsTravelMode.DRIVING;
                                var request = {
                                    origin: startLoc[i],
                                    destination: endLoc[i],
                                    travelMode: travelMode
                                };
                                directionsService.route(request, makeRouteCallback(i, directionsDisplay[i]));
                            }

                            function makeRouteCallback(routeNum, disp) {
                                if (polyline[routeNum] && (polyline[routeNum].getMap() !== null)) {
                                    startAnimation(routeNum);
                                    return;
                                }
                                return function (response, status) {
                                    if (status === google.maps.DirectionsStatus.OK) {
                                        startLocation[routeNum] = new Object();
                                        endLocation[routeNum] = new Object();
                                        polyline[routeNum] = new google.maps.Polyline({
                                            path: [],
                                            strokeColor: '#FFFF00',
                                            strokeWeight: 3
                                        });
                                        poly2[routeNum] = new google.maps.Polyline({
                                            path: [],
                                            strokeColor: '#FFFF00',
                                            strokeWeight: 3
                                        });

                                        var legs = response.routes[0].legs;

                                        disp = new google.maps.DirectionsRenderer(rendererOptions);
                                        disp.setMap(map);
                                        disp.setDirections(response);

                                        //Markers               
                                        for (i = 0; i < legs.length; i++) {
                                            if (i === 0) {
                                                startLocation[routeNum].latlng = legs[i].start_location;
                                                startLocation[routeNum].address = legs[i].start_address;
                                                //marker = google.maps.Marker({map:map,position: startLocation.latlng});
                                                marker[routeNum] = createMarker(legs[i].start_location, "Turkey", legs[i].start_address, "green");
                                            }
                                            endLocation[routeNum].latlng = legs[i].end_location;
                                            endLocation[routeNum].address = legs[i].end_address;
                                            createMarker(legs[i].end_location, "Pilgrim", legs[i].end_address, "red"); // End marker
                                            var steps = legs[i].steps;
                                            for (j = 0; j < steps.length; j++) {
                                                var nextSegment = steps[j].path;
                                                //var nextSegment = steps[j].path;
                                                for (k = 0; k < nextSegment.length; k++) {
                                                    polyline[routeNum].getPath().push(nextSegment[k]);
                                                    //bounds.extend(nextSegment[k]);
                                                }
                                            }
                                        }
                                    }
                                    polyline[routeNum].setMap(map);
                                    //map.fitBounds(bounds);
                                    var distance = <?php echo $orderDetails['time_elapsed']; ?> * <?php echo $orderDetails['est_speed']; ?>;
                                    marker[routeNum].setPosition(polyline[routeNum].GetPointAtDistance(distance));
                                    startAnimation(routeNum, distance);
                                }; // else alert("Directions request failed: "+status);
                            }
                        }

                        var lastVertex = 1;
                        var stepnum = 0;
                        var step = <?php echo $orderDetails['est_speed']; ?>; // Around 1.5 - 2 for realistic speed
                        var tick = 1000; // milliseconds
                        var eol = [];

                        function updatePoly(i, d) {
                            // Spawn a new polyline every 20 vertices, because updating a 100-vertex poly is too slow
                            if (poly2[i].getPath().getLength() > 20) {
                                poly2[i] = new google.maps.Polyline([polyline[i].getPath().getAt(lastVertex - 1)]);
                                // map.addOverlay(poly2)
                            }
                            if (polyline[i].GetIndexAtDistance(d) < lastVertex + 2) {
                                if (poly2[i].getPath().getLength() > 1) {
                                    poly2[i].getPath().removeAt(poly2[i].getPath().getLength() - 1);
                                }
                                poly2[i].getPath().insertAt(poly2[i].getPath().getLength(), polyline[i].GetPointAtDistance(d));
                            } else {
                                poly2[i].getPath().insertAt(poly2[i].getPath().getLength(), endLocation[i].latlng);
                            }
                        }

                        function animate(index, d) {
                            if (d > eol[index]) {
                                marker[index].setPosition(endLocation[index].latlng);
                                map.setCenter(endLocation[index].latlng);
                                document.getElementsByClassName('progress-bar-3')[0].style.backgroundColor = "#33B63B";
                                document.getElementsByClassName('progress-bar-4')[0].style.backgroundColor = "#33B63B";
                                finish = true;
                                return;
                            }
                            var p = polyline[index].GetPointAtDistance(d);
                            //map.panTo(p);
                            marker[index].setPosition(p);
                            map.setCenter(p);
                            updatePoly(index, d);
                            timerHandle[index] = setTimeout("animate(" + index + "," + (d + step) + ")", tick);
                        }

                        function startAnimation(index, meters) {
                            if (timerHandle[index])
                                clearTimeout(timerHandle[index]);
                            eol[index] = polyline[index].Distance();
                            map.setCenter(polyline[index].getPath().getAt(0));
                            poly2[index] = new google.maps.Polyline({path: [polyline[index].getPath().getAt(0)], strokeColor: "#FFFF00", strokeWeight: 3});
                            document.getElementsByClassName('progress-bar-3')[0].style.backgroundColor = "#33B63B";
                            timerHandle[index] = setTimeout("animate(" + index + "," + meters + ")", 2000);  // Allow time for the initial map display
                        }

                        function calculateDistances() {
                            var start = startLoc[0];
                            var end = endLoc[0];

                            var request = new XMLHttpRequest();
                            request.open('GET', 'include/traffic.php?startVal=' + start + '&endVal=' + end, false);
                            request.send();

                            var data = request.responseText.split("||");
                            var distance = data[0];
                            var trafficDuration = parseFloat(data[1]);

                            trafficDuration = trafficDuration / 60.0;
                            trafficDuration = Math.round(trafficDuration);

                            return [distance, trafficDuration];
                        }

                        $(document).ready(function () {
                            initialize();
                        });
                    </script>
                </div>
                <div id="outputDiv" style="margin-top: 50px;"></div>
                <div id="map_canvas" style="width:50%;height:50%;"></div>
                <script src="http://www.google-analytics.com/analytics.js" type="text/javascript"></script>
            </div>
        </div>
    </body>
</html>