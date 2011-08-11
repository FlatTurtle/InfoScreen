<?php

$stationsNMBS = json_decode(file_get_contents("http://api.iRail.be/stations/?format=json"));
$stationsMIVB = json_decode(file_get_contents("http://api.iRail.be/stations/?format=json&system=MIVB"));
$idtoname = array();

foreach($stationsNMBS->station as $s){
    $idtoname[$s->id] = $s->name;
}

foreach($stationsMIVB->station as $s){
    $idtoname[$s->id] = $s->name;
}
?>
