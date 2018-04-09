<?php
	include_once(__DIR__."/Clockwork.php");
	include_once(__DIR__."/ClockworkException.php");

	$db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

	$id = $_COOKIE['cancelID'];

	$clockworkAPIkey = 'b524a50d77e6017daf822b93efad9fa553438a53';

	$pendingquery = "UPDATE requests SET Stat = 'pending' WHERE RequestID = '$id' ";
	$pending = mysqli_query($db_connection, $pendingquery)or die("Failed to query database pending!"); 
		
	if($pendingquery)
	{
		if(isset($_COOKIE['cancelPhoneCookie']))
		{
			try
			{
			// Create a Clockwork object using your API key
				$clockwork = new mediaburst\ClockworkSMS\Clockwork( $clockworkAPIkey );

				// Setup and send a message
				//$message = array( 'to' => '14016993406', 'message' => 'This is a test message from Shovlr!' ); //test sending sms to my phone works
				$message = array( 'to' => $_COOKIE['cancelPhoneCookie'], 'message' => 'Hi from Shovlr! <br> We apologized but the shoveler who acccepted your request has chosen to cancel the request. Your request has been automatically added back to the listings.');
				$result = $clockwork->send( $message );

				// Check if the send was successful
				if($result['success']) 
				{
					echo 'A text message has been sent to requester\'s phone and notified them of the cancellation. <br>';
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
		}

			echo "Changed the request back to pending.";
	}
	else
	{
		echo "Failed to querying into database!";
	}
?>