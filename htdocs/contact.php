<?php require 'include/header.php'; ?>
<div class="map-list-container" style="height:550px">
    <h1 style="white-space: pre;"> Store Locations</h1>
    <div id="map-container" class="col-md-6 hidden-sm hidden-xs"></div>
    
    <ol class="list-group" id="store-results">
        <a href="javascript:triggerClick(0)" id="loc1">
             <li class="list-group-item">
                <div class="store-marker"><h3>A</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    5604 Bay St <br>       Emeryville, CA 94608
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (510)428-0129</p>
                </div>
            </li>
        </a>
        
        <a href="javascript:triggerClick(1)" id="loc2">
            <li class="list-group-item">
                <div class="store-marker"><h3>B</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    Union Landing Shopping Center<br>31350 Courthouse Dr<br> Union City, CA 94587
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (510)687-4103</p>
                </div>
                
            </li>
        </a>
        <a href="javascript:triggerClick(2)" id="loc3">
            <li class="list-group-item">
                <div class="store-marker"><h3>C</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    1333 N California Blvd<br> Walnut Creek, CA 94596
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (925)555-6684</p>
                </div>
                
            </li>
        </a>
        <a href="javascript:triggerClick(3)" id="loc4">
            <li class="list-group-item">
                <div class="store-marker"><h3>D</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    1817 Somersville Rd<br> Antioch, CA 94509
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (925)321-4788</p>
                </div>
                
            </li>
        </a>
        <a href="javascript:triggerClick(4)" id="loc5">
            <li class="list-group-item">
                <div class="store-marker"><h3>E</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    250 W Maude Ave<br> Sunnyvale, CA 94085
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (866)754-9660</p>
                </div>
                
            </li>
        </a>
        <a href="javascript:triggerClick(5)" id="loc6">
            <li class="list-group-item">
                <div class="store-marker"><h3>F</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    The Plant<br> 2179 Monterey Highway<br>San Jose, CA 95125
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (408)988-4862</p>
                </div>
                
            </li>
        </a>
        <a href="javascript:triggerClick(6)" id="loc7">
            <li class="list-group-item">
                <div class="store-marker"><h3>G</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    2309 Noriega St<br> San Francisco, CA 94122
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (415)531-4995</p>
                </div>
                
            </li>
            
            <a href="javascript:triggerClick(7)" id="loc8">
            <li class="list-group-item">
                <div class="store-marker"><h3>H</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    896 Valencia St<br> San Francisco, CA 94110
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (415)679-0510</p>
                </div>
                
            </li>
        </a>
        <a href="javascript:triggerClick(8)" id="loc9">
            <li class="list-group-item">
                <div class="store-marker"><h3>I</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    1901 Junipero Serra Blvd<br> Daly City, CA 94014
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (650)439-8882</p>
                </div>
                
            </li>
        </a>
        <a href="javascript:triggerClick(9)" id="loc10">
            <li class="list-group-item">
                <div class="store-marker"><h3>J</h3></div>
                <div class="store-content">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    3520 S El Camino Real<br> San Mateo, CA 94403
                    <br />
                    <p><span class="glyphicon glyphicon-earphone"></span>  (650)284-7965</p>
                </div>
                
            </li>
        </a>
    </ol>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        var locations = [
            ['5604 Bay St, Emeryville, CA 94608', 37.833451, -122.292839],
            ['Union Landing Shopping Center, 31350 Courthouse Dr, Union City, CA 94587', 37.601174, -122.064223],
            ['1333 N California Blvd, Walnut Creek, CA 94596', 37.898266, -122.063781],
            ['1817 Somersville Rd, Antioch, CA 94509 ', 38.003324, -121.837789],
            ['250 W Maude Ave, Sunnyvale, CA 94085', 37.388547, -122.028365],
            ['The Plant, 2179 Monterey Highway, San Jose, CA 95125', 37.303547,-121.866899],
            ['2309 Noriega St, San Francisco, CA 94122',37.753514, -122.488441],
            ['896 Valencia St, San Francisco, CA 94110', 37.758629,-122.421591],
            ['1901 Junipero Serra Blvd, Daly City, CA 94014', 37.702539, -122.470378],
            ['3520 S El Camino Real, San Mateo', 37.535410, -122.296773]
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

            var geoStr = "geo:";
            var locStr = "loc";

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                for(i = 0; i < locations.length; i++){
                    geoStr = "geo:";
                    locStr = "loc";
                    locStr += (i+1);
                    geoStr += locations[i][1];
                    geoStr += ",";
                    geoStr += locations[i][2];
                    geoStr += "?q=";
                    geoStr += locations[i][1];
                    geoStr += ",";
                    geoStr += locations[i][2];
                    document.getElementById(locStr).href = geoStr;  

                }
               

            }

        };



     


    </script>
</div>
<?php require 'include/footer.php'; ?>