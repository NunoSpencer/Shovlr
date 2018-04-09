<?php

	include_once(__DIR__."/Clockwork.php");
	include_once(__DIR__."/ClockworkException.php");
	
	$db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

	$clockworkAPIkey = 'b524a50d77e6017daf822b93efad9fa553438a53';

	$id = $_COOKIE['cancelID'];

	$phonequery = "SELECT * FROM requestsaccepted WHERE acceptID = '$id'";
	$phoneNum = mysqli_query($db_connection, $phonequery)or die("Failed to query database here!");
	
	if($phoneNum)
	{
		while($row = mysqli_fetch_assoc($phoneNum))
        {
		   $phone = $row['shovelerPhone']; 
			setcookie("cancelPhoneCookie", $phone); 
        }

        try
			{
			// Create a Clockwork object using your API key
				$clockwork = new mediaburst\ClockworkSMS\Clockwork( $clockworkAPIkey );

				// Setup and send a message
				//$message = array( 'to' => '14016993406', 'message' => 'This is a test message from Shovlr!' ); //test sending sms to my phone works
				$message = array( 'to' => $_COOKIE['cancelPhoneCookie'], 'message' => 'Hi from Shovlr! <br> We apologized but the person who\'s request you acccepted decided to cancel the request.');
				$result = $clockwork->send( $message );

				// Check if the send was successful
				if($result['success']) 
				{
					echo 'A text message has been sent to shovelers\'s phone and notified them of the cancellation. <br>';
					echo 'Thank you for using Shovlr! <br>';
					echo 'SMS ID: ' . $result['id'] .'<br>';
				}else 
				{
					echo 'Message failed - Error: ' . $result['error_message'];
				}
			}catch (mediaburst\ClockworkSMS\ClockworkException $e)
			{
				echo 'Exception sending SMS: ' . $e->getMessage();
			}


		$deletequery = "DELETE FROM requests WHERE RequestID = '$id'";
		$delete = mysqli_query($db_connection, $deletequery)or die("Failed to query database!");

		if($delete)
		{
			echo "Your request has been removed from the listings.";
		}
		else
		{
			echo "Failed to querying into database! o rhere";
		}
	}
?>