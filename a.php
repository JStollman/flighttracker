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

//$input = "https://api.flightstats.com/flex/flightstatus/rest/v2/json/flight/status/$carrier/$flight/dep/$year/$month/$day?appId=1abe5fb1&appKey=1906baca833f85417361ef6a3aaf8e50&utc=false";
//$input = "$flightStatsWebsite/$flightStatus/$carrier/$flight/dep/$year/$month/$day";

//$results=json_decode (file_get_contents($input),1);




if (!empty($_POST)){
    print_r($_POST);
    //$input = "https://api.flightstats.com/flex/flightstatus/rest/v2/json/flight/status/$carrier/$flight/dep/$year/$month/$day";
$input = "$flightStatsWebsite/$flightStatus/{$_POST['Airline']}/{$_POST['flight']}/dep/{$_POST['year']}/{$_POST['month']}/{$_POST['day']}?appId={$appId}&appKey={$appKey}";

$results=json_decode (file_get_contents($input),1);
echo "<pre>";
var_dump ($results);
echo "</pre>";
}?>

<ul>
<li>Airline: <?php echo $results['appendix']['airlines'][0]['name']; ?></li>
<li>IATA Code: <?php echo $results['appendix']['airlines'][0]['iata']; ?></li>
<li>ICAO Code: <?php echo $results['appendix']['airlines'][0]['icao']; ?></li>

<li>Origin: <?php echo $results['appendix']['airports'][0]['name']; ?></li>
<li>IATA Code: <?php echo $results['appendix']['airports'][0]['iata']; ?></li>
<li>ICAO Code: <?php echo $results['appendix']['airports'][0]['icao']; ?></li>
<li>Terminal: <?php echo $results['flightStatuses'][0]['airportResources']['departureTerminal']; ?></li>
<li>Gate: <?php echo $results['flightStatuses'][0]['airportResources']['departureGate']; ?></li>

<li>Destination: <?php echo $results['appendix']['airports'][1]['name']; ?></li>
<li>IATA Code: <?php echo $results['appendix']['airports'][1]['iata']; ?></li>
<li>ICAO Code: <?php echo $results['appendix']['airports'][1]['icao']; ?></li>
<li>Terminal: <?php echo $results['flightStatuses'][0]['airportResources']['arrivalTerminal']; ?></li>
<li>Gate: <?php echo $results['flightStatuses'][0]['airportResources']['arrivalGate']; ?></li>

<li>Aircraft: <?php echo $results['appendix']['equipments'][0]['name']; ?></li>
<li>Tail Number: <?php echo $results['flightStatuses'][0]['flightEquipment']['tailNumber']; ?></li>


<button onclick="window.location.href='https://api.flightstats.com/flex/weather/rest/v1/json/all/<?php echo $results['appendix']['airports'][0]['iata']?>?appId=<?php echo $appId?>&appKey=<?php echo $appKey?>'"> <?php echo $results['appendix']['airports'][0]['name']; ?>  Weather</button>
<button onclick="window.location.href='https://api.flightstats.com/flex/weather/rest/v1/json/all/<?php echo $results['appendix']['airports'][1]['icao']?>?appId=<?php echo $appId?>&appKey=<?php echo $appKey?>'"> <?php echo $results['appendix']['airports'][1]['name']; ?>  Weather</button>

https://aviationweather.gov/adds/tafs/?station_ids=KJFK&std_trans=translated&submit_both=Get+TAFs+and+METARs
<br>
<br>


var_dump ($results['flightStatuses'][0]['flightEquipment']);

</ul>

<?php
$content = <<<EOT
<main>

<h1>Flight tracker</h1>


<form 
 method="POST">
  
  <input type="hidden" name="subject" value="New submission!">
 
  
  <div>
    <label for="Airline(2 letter code)">Airline</label>
    <input id="carrier" type="text" name="Airline" value="Example: AA">
  </div>

  <div>
    <label for="flight">Flight</label>
    <input id="flight" type="text" name="flight" value="Example: 100"> 
  </div>

  <div>
    <label for="year">Year</label>
    <input id="year" type="year" name="year" value="Example: 2018">
  </div>
  <div>
    <label for="month">Month</label>
    <input id="month" type="text" name="month" value="Example: 06">
  </div>
  <div>
    <label for="day">Day</label>
    <input id="day" type="text" name="day" value="Example: 11">
  </div>

  <div>
    <input type="submit" value="Send">
  </div>

</form>
</main>
EOT;

echo $content;


/*$appId = "1abe5fb1";
$appKey = "1906baca833f85417361ef6a3aaf8e50";


$flightStatsWebsite = "https://api.flightstats.com/flex";
$flightStatus = "/flightstatus/rest/v2/json/flight/status/";
$carrier = "carrier";
$flight = "flight";
$year = "year";
$month = "month";
$day = "day";

$input = $flightStatsWebsite.$flightStatus.$carrier/$flight/dep/$year/$month/$day;


$results=json_decode (file_get_contents($input),1);
*/
?>