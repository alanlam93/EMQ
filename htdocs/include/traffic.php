<?php
	
 header('Content-type: application/json');

 $key = "AIzaSyDmNrhRRBuvnxqNgPSluDN-PX59TbDWWBw";
 $url = "https://maps.googleapis.com/maps/api/distancematrix/json";
 
 $startLocation = $_GET['startVal'];
 $endLocation = $_GET['endVal'];

$startLocation = preg_replace('/\s+/', '_', $startLocation);
$endLocation = preg_replace('/\s+/', '_', $endLocation);

$request = $url .
   "?units=imperial" . 
   "&origins=" . $startLocation .
   "&destinations=" . $endLocation .
   "&departure_time=now" .
   "&key=" . urlencode($key);




 $data = file_get_contents($request);
 $decoded = json_decode($data, true);



 echo $decoded['rows'][0]['elements'][0]['distance']['text'];
 echo " || ";
 echo $decoded['rows'][0]['elements'][0]['duration_in_traffic']['value'];

?>