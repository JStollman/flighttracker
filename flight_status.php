<?php
$appId = "1abe5fb1";
$appKey = "1906baca833f85417361ef6a3aaf8e50";


$flightStatsWebsite = "https://api.flightstats.com/flex";
$flightStatus = "flightstatus/rest/v2/json/flight/status";
$carrier = "carrier";
$flight = "flight";
$year = "year";
$month = "month";
$day = "day";



if (!empty($_POST)){
    
    //$input = "https://api.flightstats.com/flex/flightstatus/rest/v2/json/flight/status/$carrier/$flight/dep/$year/$month/$day";
$input = "$flightStatsWebsite/$flightStatus/{$_POST['Airline']}/{$_POST['flight']}/dep/{$_POST['year']}/{$_POST['month']}/{$_POST['day']}?appId={$appId}&appKey={$appKey}";

$results=json_decode (file_get_contents($input),1);

}?>


<ul>
<li>Airline: <?php echo $results['appendix']['airlines'][0]['name']; ?></li>
<li>IATA Code: <?php echo $results['appendix']['airlines'][0]['iata']; ?></li>
<li>ICAO Code: <?php echo $results['appendix']['airlines'][0]['icao']; ?></li>

<li>Origin: <?php echo $results['appendix']['airports'][0]['name']; ?></li>
<li>IATA Code: <?php echo $results['appendix']['airports'][0]['iata']; ?></li>
<li>ICAO Code: <?php echo $results['appendix']['airports'][0]['icao']; ?></li>
<li>Terminal: <?php echo $results['flightStatuses'][0]['airportResources']['departureTerminal']; ?></li>
<?php if(!empty($results['flightStatuses'][0]['airportResources']['departureGate'])):?>
<li>Gate: <?php echo $results['flightStatuses'][0]['airportResources']['departureGate']; ?></li>
<?php endif ?>

<li>Destination: <?php echo $results['appendix']['airports'][1]['name']; ?></li>
<li>IATA Code: <?php echo $results['appendix']['airports'][1]['iata']; ?></li>
<li>ICAO Code: <?php echo $results['appendix']['airports'][1]['icao']; ?></li>
<li>Terminal: <?php echo $results['flightStatuses'][0]['airportResources']['arrivalTerminal']; ?></li>
<?php if(!empty($results['flightStatuses'][0]['airportResources']['arrivalGate'])):?>
    <li>Gate: <?php echo $results['flightStatuses'][0]['airportResources']['arrivalGate']; ?></li>
<?php endif ?>
<li>Aircraft: <?php echo $results['appendix']['equipments'][0]['name']; ?></li>
<li>Tail Number: <?php echo $results['flightStatuses'][0]['flightEquipment']['tailNumber']; ?></li>


<button onclick="window.location.href='https://aviationweather.gov/adds/tafs/?station_ids=<?php echo $results['appendix']['airports'][0]['icao']?>&std_trans=translated&submit_both=Get+TAFs+and+METARs'"> <?php echo $results['appendix']['airports'][0]['name']; ?>  Weather</button>
<button onclick="window.location.href='https://aviationweather.gov/adds/tafs/?station_ids=<?php echo $results['appendix']['airports'][1]['icao']?>&std_trans=translated&submit_both=Get+TAFs+and+METARs'"> <?php echo $results['appendix']['airports'][1]['name']; ?>  Weather</button>

<br>
<br>