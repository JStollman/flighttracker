<?php

require '../core/About/src/Validation/Validate.php';

$valid = new About\Validation\Validate();

$args = [
  'carrier'=>FILTER_SANITIZE_STRING,
  'flightNumber'=>FILTER_SANITIZE_STRING,
  'year'=>FILTER_SANITIZE_STRING,
  'month'=>FILTER_SANITIZE_STRING,
  'day'=>FILTER_SANITIZE_STRING,
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)) {
  

  $valid->validation = [
    'carrier'=>[[
      'rule'=>'carrier',
      'message'=>'Please enter a 2-letter Airline Code'
    ],[
      'rule'=>'notEmpty',
      'message'=>'Please enter an valid 2-letter Airline Code'
    ]],
    'flight'=>[[
      'rule'=>'notEmpty',
      'message'=>'Please enter a Flight Number'
    ]],
    'year'=>[[
      'rule'=>'notEmpty',
      'message'=>'Please enter a year'
    ]],
    'month'=>[[
      'rule'=>'notEmpty',
      'message'=>'Please enter a month'
    ]],
    'day'=>[[
      'rule'=>'notEmpty',
      'message'=>'Please enter a day'
    ]]
    ];
  
    $valid->check($input);

    if (empty($valid->errors)) {


      require '../vendor/autoload.php';
      require '../../config.php';
      
      
      

     header('LOCATION: thanks.html');
    }else{
      $message = "<div class=\"message-error\">The form has errors!</div>";
    }
}

$pageTitle = "Find a Flight"; 
$description = "Find a flight by flight number";
$message = (!empty($message)?$message:null); 

$content = <<<EOT
<main>

<h1>Flight tracker</h1>
{$message}

<form action="contact.php" method="POST">
  
  <input type="hidden" name="subject" value="New submission!">
 
  
  <div>
    <label for="Airline(2 letter code)">Airline</label>
    <input id="carrier" type="text" name="Airline" value="{$valid->userInput('carrier')}">
    <div class="message-error">
      {$valid->error('carrier')}
  </div>

  <div>
    <label for="flight">Flight</label>
    <input id="flight" type="text" name="flight" value="{$valid->userInput('flight')}"> 
    <div class="message-error">
      {$valid->error('flight')}
    </div>
  </div>

  <div>
    <label for="year">Year</label>
    <textarea id="year" name="year">{$valid->userInput('year')}</textarea>
    <div class="message-error">
      {$valid->error('year')}
    </div>
  </div>
  <div>
    <label for="month">Month</label>
    <textarea id="month" name="month">{$valid->userInput('month')}</textarea>
    <div class="message-error">
      {$valid->error('month')}
    </div>
  </div>
  <div>
    <label for="day">Day</label>
    <textarea id="day" name="day">{$valid->userInput('day')}</textarea>
    <div class="message-error">
      {$valid->error('day')}
    </div>
  </div>

  <div>
    <input type="submit" value="Send">
  </div>

</form>
</main>
EOT;

require '../core/layout.php';

$appId = "1abe5fb1";
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

?>


<?php


$apiKey = "30ce86-5475ee-c62573-da7f63-c51407";

$iataCode;

$flightTracker = 'http://aviation-edge.com/api/public/flights?key=';
$iataNumber = '&flight[iataNumber]=';
$IataAirlineCode = '&flight[iataCode]=';
$IataAirlineCode = '&departure[iataCode]=';
$IataAirlineCode = '&arrival[iataCode]=';

//needs backticks
$airportTimetablesDeparture = "http://aviation-edge.com/api/public/timetable?key=$apiKey&iataCode=JFK&type=departure";

//needs backticks
$airportTimetablesArrival= 'http://aviation-edge.com/api/public/timetable?key=api_key&iataCode=JFK&type=arrival';

$routes = 'http://aviation-edge.com/api/public/routes?key=api_key&limit=1000&offset=0';

//Backticks
$routeSpecificRoute= ' http://aviation-edge.com/api/public/routes?key=api_key&departureIata=OTP&departureIcao=LROP&airlineIata=0B&airlineIcao=BMS&flightNumber=101';

$nearbyService= 'http://aviation-edge.com/api/public/nearby?key=api_key&lat=-5.466667&lng=122.6333&distance=100';


$autocomplete = 'http://aviation-edge.com/api/public/autocomplete?key=api_key&query=amsterdam';






//static data

$airline = "https://aviation-edge.com/api/public/airlineDatabase?key=";
$airlineTest = "https://aviation-edge.com/api/public/airlineDatabase?key=$apiKey&codeIataAirline=AA&codeIso2Country=US";

$aiplanes = 'https://aviation-edge.com/api/public/airplaneDatabase?key=';

$airport = 'https://aviation-edge.com/api/public/airportDatabase?key=api_key';

$airlineBenchmark = 'https://aviation-edge.com/api/public/benchmarkAirlines?key=';

$airportBenchmark = 'https://aviation-edge.com/api/public/benchmarkAirports?key=';

$cityBenchmark = 'https://aviation-edge.com/api/public/benchmarkCities?key=';

$city = 'https://aviation-edge.com/api/public/cityDatabase?key=api_key';

$country = 'https://aviation-edge.com/api/public/countryDatabase?key=api_key';


//

//$alpha = "https://api.flightstats.com/flex/flightstatus/rest/v2/json/airport/tracks/ttn/dep?appId=1abe5fb1&appKey=1906baca833f85417361ef6a3aaf8e50%09&includeFlightPlan=true&maxPositions=3&sourceType=all";


$appId = "1abe5fb1";
$appKey = "1906baca833f85417361ef6a3aaf8e50";

$placehoder = "https://api.flightstats.com/flex/weather/rest/v1/json/all/mdw?appId=$appId &appKey=$appKey";


$airport = "mdw";
$alpha = "https://api.flightstats.com/flex/flightstatus/rest/v2/json/airport/tracks/$airport/dep?appId=1abe5fb1&appKey=1906baca833f85417361ef6a3aaf8e50%09&includeFlightPlan=true&maxPositions=3&sourceType=all";

$results=json_decode (file_get_contents($alpha),1);
//$results=file_get_contents($alpha);
//var_dump($results['flightTracks']);
//var_dump($results['request']);
//var_dump($results);
//echo $results;

?>
<h1><?php //echo $results[0]['nameAirline']; ?></h1>
<?php foreach ($results['flightTracks'] as $flightTrack):?>
<div><?php echo $flightTrack['flightId'];?> </div>
<?php var_dump($flightTrack); endforeach; ?>


$flightStatsWebsite = "https://api.flightstats.com/flex"

//1

//A
//Flight Status
/flightstatus/rest/v2/json/flight/status/{...}


$carrier
$flight
$year
$month
$day

//arriving on date
$carrier/$flight/arr/$year/$month/$day




//departure on date
$carrier/$flight/arr/$year/$month/$day

//B
//Flight Track
/flightstatus/rest/v2/json/flight/track/{...}

///tracks arriving on date
s/{carrier}/$flight/arr/$year/$month/$day

//track by id
$flightId


//Airport Status
/flightstatus/rest/v2/json/airport/status/{...}

//arrivals
arr/{year}/{month}/{day}/{hourOfDay}

//departures
dep/{year}/{month}/{day}/{hourOfDay}

//Airport Track
/flightstatus/rest/v2/json/airport/tracks/{...}

//arrivals
{airport}/arr


//departurs
{airport}/dep


// Flight Status by route
/flightstatus/rest/v2/json/route/status/{...}

//departures
{departureAirport}/{arrivalAirport}/dep/{year}/{month}/{day} 

//arrivals
{departureAirport}/{arrivalAirport}/arr/{year}/{month}/{day}




//Flights nearby
/flightstatus/rest/v2/json/flightsNear/{...}


//Schedules API format
/schedules/rest/v1/json/{...}

//Ratings API
/ratings/rest/v1/json/{...}

//2
//Historical Flight Status
/flightstatus/historical/rest/v3/json/{...}

//3
//Schedules
/schedules/rest/v1/json/{...}

//4
//Connections
/connections/rest/v2/json/{...}


//5
//Airlines
/airlines/rest/v1/json/{...}

//6
//Airports
/airports/rest/v1/json/{...}

//7
//Equipment
/equipment/v1/json/{...}


//8
//Alerts
/alerts/rest/v1/json/{...}

//9
//Delay Index
/delayindex/rest/v1/json/{...}

//10
//Ratings
/ratings/rest/v1/json/{...}

//11
//Weather
/weather/rest/v1/json/{...}

//12
//Flight Information Display System (FIDS)
/fids/rest/v1/json/{airport}/{departures|arrivals}
