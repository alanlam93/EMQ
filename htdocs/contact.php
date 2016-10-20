<?php require 'include/header.php'; ?>
        <div class="map-list-container" style="height:550px">
            <h1 style="white-space: pre;"> Store Locations</h1>
            <div id="map-container" class="col-md-6"></div>
            <div class="store-list">
                <ol class="list-group" id="store-results">
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(0)" class="loc">
                            <div class="store-marker"><h3>A</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                5604 Bay St <br>       Emeryville, CA 94608
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (510)428-0129</p>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(1)" class="loc">
                            <div class="store-marker"><h3>B</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                Union Landing Shopping Center<br>31350 Courthouse Dr<br> Union City, CA 94587
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (510)687-4103</p>
                            </div>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a href="javascript:triggerClick(2)" class="loc">
                            <div class="store-marker"><h3>C</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                1333 N California Blvd<br> Walnut Creek, CA 94596
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (925)555-6684</p>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(3)" class="loc">
                            <div class="store-marker"><h3>D</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                1817 Somersville Rd<br> Antioch, CA 94509
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (925)321-4788</p>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(4)" class="loc">
                            <div class="store-marker"><h3>E</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                250 W Maude Ave<br> Sunnyvale, CA 94085
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (866)754-9660</p>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(5)" class="loc">
                            <div class="store-marker"><h3>F</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                The Plant<br> 2179 Monterey Highway<br>San Jose, CA 95125
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (408)988-4862</p>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(6)" class="loc">
                            <div class="store-marker"><h3>G</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                2309 Noriega St<br> San Francisco, CA 94122
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (415)531-4995</p>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(7)" class="loc">
                            <div class="store-marker"><h3>H</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                896 Valencia St<br> San Francisco, CA 94110
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (415)679-0510</p>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(8)" class="loc">
                            <div class="store-marker"><h3>I</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                1901 Junipero Serra Blvd<br> Daly City, CA 94014
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (650)439-8882</p>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="javascript:triggerClick(9)" class="loc">
                            <div class="store-marker"><h3>J</h3></div>
                            <div class="store-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                3520 S El Camino Real<br> San Mateo, CA 94403
                                <br />
                                <p><span class="glyphicon glyphicon-earphone"></span>  (650)284-7965</p>
                            </div>
                        </a>
                    </li>
                </ol>
            </div>

            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
            <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <script type="text/javascript">

                var locations = [
                    ['5604 Bay St, Emeryville, CA 94608', 37.8334512, -122.2950276],
                    ['Union Landing Shopping Center, 31350 Courthouse Dr, Union City, CA 94587', 37.6011705, -122.0682412],
                    ['1333 N California Blvd, Walnut Creek, CA 94596', 37.89828, -122.0658557],
                    ['1817 Somersville Rd, Antioch, CA 94509 ', 38.0033342, -121.8399909],
                    ['250 W Maude Ave, Sunnyvale, CA 94085', 37.3885503, -122.0305683],
                    ['The Plant, 2179 Monterey Highway, San Jose, CA 95125', 37.3041444, -121.8659664],
                    ['2309 Noriega St, San Francisco, CA 94122', 37.7535142, -122.4906292],
                    ['896 Valencia St, San Francisco, CA 94110', 37.7586289, -122.42378],
                    ['1901 Junipero Serra Blvd, Daly City, CA 94014', 37.7025388, -122.4725672],
                    ['3520 S El Camino Real, San Mateo', 37.5334449, -122.2957149]
                ];
                var centerlocation = new google.maps.LatLng(37.6011705, -122.0682412);
                var mapoptions = {
                    center: centerlocation,
                    zoom: 9
                };

                var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var labelIndex = 0;
                markers = [];

                function init_map() {
                    var marker, i;

                    var infoWindow = new google.maps.InfoWindow();
                    var map = new google.maps.Map(document.getElementById("map-container"),
                            mapoptions);
                    for (i = 0; i < locations.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            label: labels[labelIndex++ % labels.length],
                            map: map,
                        });

                        markers.push(marker);

                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infoWindow.setContent(locations[i][0]);
                                infoWindow.open(map, marker);
                                map.setZoom(9);
                                map.setCenter(marker.getPosition());
                            }
                        })(marker, i));
                    }
                }

                google.maps.event.addDomListener(window, 'load', init_map);
                function triggerClick(i) {
                    google.maps.event.trigger(markers[i], 'click');
                }
            </script>
        </div>
<?php require 'include/footer.php'; ?>