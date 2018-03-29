<?php
	$db_connection = mysqli_connect('localhost', 'root', 'nopass123', 'shovlrdb');

	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		
		$updateStat = "UPDATE requests SET Stat = 'accepted' WHERE RequestID = '$id'";


		if(mysqli_query($db_connection, $updateStat))
		{
   			echo "<!DOCTYPE html>
					<html>
					<head>
						<meta charset='utf-8'>
					    <meta name='description' content='Accept Snow Removal Service '>
					    <meta name='author' content='SitePoint'>

					    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
					    
					    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script> 
					    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>

						<script src='shovlrscript.js' type='text/javascript'></script>
						<script src='cancelButton.js' type='text/javascript'></script>
					<title>Shovlr</title>
					</head>
					<body>
						<h1 id='headertitle' class=''><strong>Accepting Request for:</strong></h1><br>
						    <h1 id='headertitle' class=''><strong>Include your information and click 'Let's Shovel' button</strong></h1><br>

						    

						<form id='AcceptRequestForm' action='acceptshovelquery.php' method='post'>
            				Your first name:
            				<input type='text' id='shovelerFName' name='shovelerFName' value=''><br>
            				Your last name:
				            <input type='text' id='shovelerLName' name='shovelerLName' value=''><br>
				            Your contact phone:
				            <input type='text' id='shovelerPhone' name='shovelerPhone' value=''><br>
        					<button class = 'shovelBTN' id='shovelBTN' title='Accept Request'>Let's Shovel</button>
        				</form>
        				<form id='cancelFrom' action='cancel.php' method='post'>
        					<button class = 'cancelBTN' id='cancelBTN' title='Cancel Request'>Cancel</button>
        					<input type='hidden' id = 'id' name='id' value='$id'/>
        				</form>
    					


					</body>
					</html>";
   		}
		else
		{
    		echo "Failed to querying into database!";
		}
	}
	else
	{
		echo "accept empty";
	}

	/*
<			
			
	*/

?>