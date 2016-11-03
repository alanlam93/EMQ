<?php
    require('include/header.php');

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while connecting to the database.";
    return;
}
$mysqli->set_charset("utf8");
$result = $mysqli->query("SELECT * FROM warehouse_address");
$locations = array();
$locations_js = array();
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $locations[] = $row;
    if (empty($row['name'])) {
        $locations_js[] = "['<a href=\"http://maps.apple.com/?q=EMQ&ll={$row['lat']},{$row['long']}\" target=\"_blank\">{$row['address']}, {$row['city']}, {$row['state']} {$row['zip']}</a>', {$row['lat']}, {$row['long']}]";
    } else {
        $locations_js[] = "['<a href=\"http://maps.apple.com/?q=EMQ&ll={$row['lat']},{$row['long']}\" target=\"_blank\">{$row['name']} {$row['address']}, {$row['city']}, {$row['state']} {$row['zip']}</a>', {$row['lat']}, {$row['long']}]";
    }
}
$result->close();
$mysqli->close();
$label = 'A';
$loc_index = 0;
?>
        <h1 style="text-align: center">Store Locations</h1>
        <div class="row">
            <div class="col-sm-6 col-md-5 col-lg-7 col-sm-offset-1 col-md-offset-2 col-lg-offset-1" style="padding-right: 0px;">
                <div id="map-container"></div>
            </div>
            <ol class="list-group col-sm-4 col-md-3 col-lg-3" id="store-results">
            <?php foreach ($locations as $location): ?>    <li class="list-group-item">
                    <a href="javascript:triggerClick(<?php echo $loc_index++; ?>)" id="loc<?php echo $loc_index; ?>">
                        <div class="store-marker"><h3><?php echo $label++; ?></h3></div>
                        <div class="store-content">
                            <span class="glyphicon glyphicon-map-marker"></span><br />
                            <?php if (!empty($location['name'])) : ?><?php echo $location['name']; ?><br />
                            <?php endif; ?><?php echo $location['address']; ?><br />
                            <?php echo $location['city']; ?>, <?php echo $location['state']; ?> <?php echo $location['zip']; ?><br />
                            <p><span class="glyphicon glyphicon-earphone"></span> <?php echo $location['phone']; ?></p>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?></ol>
        </div>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNFssYGfC3PBwUPiG6NLWNloRKq5N-5FM"></script>
        <script type="text/javascript">
            var locations = [
                <?php echo implode(",\n                ", $locations_js) . "\n"; ?>
            ];

            var mapoptions = {
                center: new google.maps.LatLng(37.6011705, -122.0682412),
                zoom: 9
            };

            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var labelIndex = 0;
            markers = [];
            function init_map() {
                var marker, i;
                var infoWindow = new google.maps.InfoWindow();
                var map = new google.maps.Map(document.getElementById("map-container"), mapoptions);
                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        content: labels[labelIndex++ % labels.length],
                        map: map
                    });
                    markers.push(marker);
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            infoWindow.setContent(locations[i][0]);
                            infoWindow.open(map, marker);
                            map.setZoom(15);
                            map.setCenter(marker.getPosition());
                        };
                    })(marker, i));
                }
            }
            google.maps.event.addDomListener(window, 'load', init_map);


            function triggerClick(i) {
                google.maps.event.trigger(markers[i], 'click');
            }
        </script>
<?php require 'include/footer.php'; ?>