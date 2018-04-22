<?php

	include_once(__DIR__."/Clockwork.php");
	include_once(__DIR__."/ClockworkException.php");
	
	$db_connection = mysqli_connect('localhost', 'root', 'nopass123', 'shovlrdb');

	$clockworkAPIkey = 'b524a50d77e6017daf822b93efad9fa553438a53';

	$id = $_COOKIE['cancelID'];

	$deletequery = "DELETE FROM requests WHERE RequestID = '$id'";
	$delete = mysqli_query($db_connection, $deletequery)or die("Failed to query database!");

	$phonequery = "SELECT * FROM requestsaccepted WHERE acceptID = '$id'";
	$phoneNum = mysqli_query($db_connection, $phonequery)or die("Failed to query database here!");

	
	$rowcount = mysqli_num_rows($phoneNum);

	//echo $rowcount;
	head();

	if($rowcount > 0)
	{

		$deleteShovlrquery = "DELETE FROM requestsaccepted WHERE acceptID = '$id'";
		$deleteShovlr = mysqli_query($db_connection, $deleteShovlrquery)or die("Failed to query database!");
		
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
				echo 'Exception sending SMS: ' . $e->getMessage().'<br>';
			}
			if($deleteShovlr)
			{
				echo "Removed Shoveler from database.<br>";
			}
			else
			{
				echo "Failed to querying into database!";
			}
	}

	if($delete)
	{
		echo "Your request has been removed from the listings.";
	}
	else
	{
		echo "Failed to querying into database!";
	}

	foot();

	function head()
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

		echo "<div class = 'text-center'><h3>Request canceled sucessfully!</h3></div><br>";
		echo '<div class="container">
			       <div class="row centered-form">
				        <div class="col-xs-8 col-sm-4 col-md-6 col-sm-offset-3">
				            <div class="panel panel-default">';
	}

	function foot()
	{
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
			        </div>
			     </form>                               			
				</body>
				</html>';
	}
?>