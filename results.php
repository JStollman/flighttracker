<?php


$input = $flightStatsWebsite.$flightStatus.$carrier/$flight/dep/$year/$month/$day;


$results=json_decode (file_get_contents($input),1);

?>