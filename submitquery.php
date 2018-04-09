
<?php

/*
    Database query to submit requests for snow shoveling... 
    when user clicks SUBMIT button, the info from request.html form will be submitted to the database ("requests" table) 
*/

include_once(__DIR__."/Clockwork.php");
include_once(__DIR__."/ClockworkException.php");

//connect to database
$db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

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

//$RequestID = uniqid('ID');
//$RequestID = uniqid('SHV',rand(1,10));
$RequestID = 'id'.substr(md5(microtime()),rand(0,26),7);

date_default_timezone_set('EST');

$Date = date("Y-m-d");
$Time = date("g:i a", time());

//submit request query
$submitQuery = mysqli_query($db_connection, "INSERT INTO requests (LName, FName, Phone, AreaSize, PlowTruck, Street, City, Zip, Stat, RequestID, RequestDate, RequestTime) VALUES 
    ('$LName', '$FName', '$Phone', '$AreaSize', '$PlowTruck', '$Street', '$City','$Zip', 'pending', '$RequestID', '$Date', '$Time')");

if($submitQuery)
{
    echo "Request submitted sucessfully!<br>";
    echo "Please take note of your request ID in case you want to cancel your request.<br>";
    echo "Request ID: ".$RequestID."<br>";

    /*Code for sending the Requester the ID numebr to the phone.
    try
		{
			// Create a Clockwork object using your API key
			$clockwork = new mediaburst\ClockworkSMS\Clockwork( $clockworkAPIkey );

			// Setup and send a message
			//$message = array( 'to' => '14016993406', 'message' => 'This is a test message from Shovlr!' ); //test sending sms to my phone works
			$message = array( 'to' => $Phone, 'message' => 'Hi from Shovlr! <br> ' . $FName . ' ' . $LName . ' your request has been accepted.
			In case you want to cancel your request please use the request ID :	'. $RequestID);
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
		}*/


}else
    echo "Failed to querying into database!";
?>