<?php

	/*
		Database query to accept requests for snow shoveling... 
		when user clicks LET'S SHOVEL button on AcceptRequest.html, the info from the form will on that page will be submitted to the database ("requestsaccepted" table) 
		a sms text message containing shoveler information (name, phone) is sent to the requester so he/she may contact shoveler back to confirm
	*/

	//include 'Clockwork.php';
	//include($_SERVER['DOCUMENT_ROOT']."../Clockwork.php");
	//echo ($_SERVER['DOCUMENT_ROOT']);
	//require_once "../var/www/html/Shovlr/Clockwork.php";
	
	include_once(__DIR__."/Clockwork.php");
	include_once(__DIR__."/ClockworkException.php");

	$db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

	//sms text message API key from https://app5.clockworksms.com/
	$clockworkAPIkey = 'b524a50d77e6017daf822b93efad9fa553438a53';

	$shovelerFName = $_REQUEST['shovelerFName'];
	$shovelerLName = $_REQUEST['shovelerLName'];
	$shovelerPhone = $_REQUEST['shovelerPhone'];
	
	//acceptID = uniqid('ID');
	//acceptID = uniqid('SHV',rand(1,20));
	$acceptID = $_COOKIE['requestID'];

	//specify date & time
	date_default_timezone_set('EST');
	$acceptDate = date("Y-m-d");
	$acceptTime = date("g:i a", time());

	//send accept query to db
	$submitAcceptQuery = mysqli_query($db_connection, "INSERT INTO requestsaccepted (shovelerFName, shovelerLName, shovelerPhone, acceptID,  acceptDate, acceptTime, shovelStatus) VALUES 
		('$shovelerFName', '$shovelerLName', '$shovelerPhone', '$acceptID',  '$acceptDate', '$acceptTime', 'shovel in process')");

	
	if($submitAcceptQuery)
	{
		//test that requester phone is being passed to sms API
		//echo 'Sent to: ' . $_COOKIE['requesterPhoneCookie'] . '<br>';

		//once the shovler clicks "Let's shovel!" button, a sms text message is sent to requester phone 
		try
		{
			// Create a Clockwork object using your API key
			$clockwork = new mediaburst\ClockworkSMS\Clockwork( $clockworkAPIkey );

			// Setup and send a message
			//$message = array( 'to' => '14016993406', 'message' => 'This is a test message from Shovlr!' ); //test sending sms to my phone works
			$message = array( 'to' => $_COOKIE['requesterPhoneCookie'], 'message' => 'Hi from Shovlr! <br> ' . $shovelerFName . ' ' . $shovelerLName . ' has accepted your shovel request. Contact him/her: '. $shovelerPhone );
			$result = $clockwork->send( $message );

			// Check if the send was successful
			if($result['success']) 
			{
				echo 'A text message has been sent to requester phone and he/she should be contacting you soon. <br>';
				echo 'Your name: ' . $shovelerFName . ' ' . $shovelerLName . '<br>' ;
				echo 'Your phone: ' . $shovelerPhone . '<br>';
				echo 'Your Accept ID: '.$acceptID.' (Used to cancel the request)<br>';
				echo 'Thank you for using Shovlr! <br>';
				echo 'SMS ID: ' . $result['id'];
			}else 
			{
				echo 'Message failed - Error: ' . $result['error_message'];
			}
		}catch (mediaburst\ClockworkSMS\ClockworkException $e)
		{
			echo 'Exception sending SMS: ' . $e->getMessage();
		}
		
	}else
	{
		echo "Failed to query accept information into database!";
	}

?>



