
<?php

/*
    Database query to submit requests for snow shoveling... 
    when user clicks SUBMIT button, the info from request.html form will be submitted to the database ("requests" table) 
*/

include_once(__DIR__."/Clockwork.php");
include_once(__DIR__."/ClockworkException.php");

//connect to database
$db_connection = mysqli_connect('localhost', 'root', 'nopass123', 'shovlrdb');

$clockworkAPIkey = 'b524a50d77e6017daf822b93efad9fa553438a53';

$LName = $_REQUEST['LName'];
$FName = $_REQUEST['FName'];
$Phone = $_REQUEST['Phone'];
$AreaSize = $_REQUEST['AreaSizeList'];
$PlowTruck = $_REQUEST['PlowTruck'];
$StreetNumber = $_REQUEST['street_number']; 
$StreetRoute = $_REQUEST['route'];
$Street = $StreetNumber.' '.$StreetRoute;
$City = $_REQUEST['locality'];
$Zip = $_REQUEST['postal_code'];
$datepicker = $_REQUEST['datepicker'];
$timepicker = $_REQUEST['timepicker'];
$price = $_REQUEST['price'];
$price = "$" . $price;

//list($month, $day, $year) = split('[/]', $datepicker);
//$datepicker = $year.'-'.$month.'-'.$day;


//echo $datepicker." ".$timepicker." ".$price; 

$Phone = preg_replace('/\s+/', '', $Phone);
$Phone = str_replace('-', '', $Phone);
$Phone = "1".$Phone;

//$RequestID = uniqid('ID');
//$RequestID = uniqid('SHV',rand(1,10));
$RequestID = 'id'.substr(md5(microtime()),rand(0,26),7);

date_default_timezone_set('EST');

$Date = date("Y-m-d");
$Time = date("g:ia", time());

//echo $Date;

//submit request query
$submitQuery = mysqli_query($db_connection, "INSERT INTO requests (LName, FName, Phone, AreaSize, PlowTruck, Street, City, Zip, Stat, RequestID, RequestDate, RequestTime, doByDate, doByTime, price) VALUES 
    ('$LName', '$FName', '$Phone', '$AreaSize', '$PlowTruck', '$Street', '$City','$Zip', 'pending', '$RequestID', '$Date', '$Time', '$datepicker', '$timepicker', '$price')");

if($submitQuery)
{
	

	echo '<!DOCTYPE html>
			<html>
			<head>
				<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    			<link rel="stylesheet" type="text/css" href="custom.css">
    			<style>
			      body {background-color: whitesmoke;}
			      h1   {color: black;}
			      p    {color: red; font-style: italic;}
			    </style>
				<title></title>
			</head>
			<body>
			<div class="bg"></div>';

	echo "<div class = 'text-center'><h3>Request submitted sucessfully!</h3></div><br>";
	echo '<div class="container">
	        <div class="row centered-form">
		        <div class="col-xs-8 col-sm-4 col-md-6 col-sm-offset-3">
		            <div class="panel panel-default">';
    echo "Please take note of your request ID in case you want to cancel your request.<br>";
    echo "Request ID: ".$RequestID."<br>";

    /*Code for sending the Requester the ID numebr to the phone.*/
    try
		{
			// Create a Clockwork object using your API key
			$clockwork = new mediaburst\ClockworkSMS\Clockwork( $clockworkAPIkey );

			// Setup and send a message
			//$message = array( 'to' => '14016993406', 'message' => 'This is a test message from Shovlr!' ); //test sending sms to my phone works
			$message = array( 'to' => $Phone, 'message' => 'Hi from Shovlr! <br> ' . $FName . ' ' . $LName . ' your request for snow removal service has been submitted.
			To cancel the request, use the request ID :	'. $RequestID);
			$result = $clockwork->send( $message );

			// Check if the send was successful
			if($result['success']) 
			{
				echo 'A text message has been sent to your phone with your RequestID. <br>';
			}else 
			{
				echo 'Message failed - Error: ' . $result['error_message'];
			}
		}catch (mediaburst\ClockworkSMS\ClockworkException $e)
		{
			echo 'Exception sending SMS: ' . $e->getMessage();
		}

		echo '
		</div>
			</div>
				</div>
					</div><br>
		
				<form id="homeButton" action="index.html" method="post" role="form" >
                  <div class="row">
                    <div class="col-xs-4 col-sm-2 col-md-4 col-sm-offset-4">
                      <button id="homeButton" class="btn btn-primary btn-block"  title="Submit request">Return Home</button>
                    </div>
                 </form>
						</body>
							</html>';


}else
    echo "Failed to querying into database!";
?>