<?php
	include_once(__DIR__."/Clockwork.php");
	include_once(__DIR__."/ClockworkException.php");

	$db_connection = mysqli_connect('localhost', 'root', 'nopass123', 'shovlrdb');

	$id = $_COOKIE['cancelID'];

	$clockworkAPIkey = 'b524a50d77e6017daf822b93efad9fa553438a53';

	$selectQuery = "SELECT * FROM requestsaccepted WHERE acceptID = '$id'";
	$select = mysqli_query($db_connection, $selectQuery)or die("Failed to query database pending! Delete");

	$rowcount = mysqli_num_rows($select);

	$deletequery = "DELETE FROM requestsaccepted WHERE acceptID = '$id'";
	$delete = mysqli_query($db_connection, $deletequery)or die("Failed to query database pending! Delete"); 

	$pendingquery = "UPDATE requests SET Stat = 'pending' WHERE RequestID = '$id' ";
	$pending = mysqli_query($db_connection, $pendingquery)or die("Failed to query database pending! Pending");
	
	if($rowcount != 0)
	{	
		if($delete)
		{	
			if($pending)
			{
				if(isset($_COOKIE['cancelPhoneCookie']))
				{	head();
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
							echo 'SMS ID: ' . $result['id'].'<br>';
						}else 
						{
							echo 'Message failed - Error: ' . $result['error_message'];
						}
					}catch (mediaburst\ClockworkSMS\ClockworkException $e)
					{
						echo 'Exception sending SMS: ' . $e->getMessage();
					}
					
				}

					echo "Changed the request back to pending.<br> Deleted from accepted requests.";
					foot();
			}
			else
			{
				echo "Failed to querying into database!";
			}
		}
		else
		{
			echo "Failed to querying into database! delete";
		}
	}
	else
	{	head();
		echo "The request you tried to cancel has not been accepted by anyone yet.<br> If you are a requester trying to cancel your request please re-visit the cancel a request page and select \"Requester\" for the user type. ";
		foot();
	}

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