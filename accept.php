<?php
	
	$db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

	if(isset($_POST['id']))						
	{
		$id = $_POST['id'];		//get selected requester's requestID (via ajax acceptscript.js)
		setcookie("requestID", $id);

		//query to update request status from "pending" to "accepted" on "requests" table 
		$updateStatQuery = " UPDATE requests SET Stat = 'accepted' WHERE RequestID = '$id' ";

		//query to retrieve requester's info based on their request id re on "requests" table 
		$requesterInfoQuery = " SELECT `FName`, `LName` , `Phone`, `AreaSize`, `PlowTruck`, `Street`, `City`, `Zip` FROM `requests` WHERE `RequestID` = '$id' ";
		$requesterInfo = mysqli_query($db_connection, $requesterInfoQuery) ;

		//display info on the request that is being shoveled
		echo "<h1 id='headertitle' class=''><strong>Accepting Request for:</strong></h1><br>";

		while($row = mysqli_fetch_assoc($requesterInfo)) 
		{
			$lname = 	$row['LName']; 
			$fname = 	$row['FName']; 
			$phone = 	$row['Phone']; 
			setcookie("requesterPhoneCookie", $phone);
			$areasize = $row['AreaSize']; 
			$plowtruck =$row['PlowTruck']; 
			$street = 	$row['Street']; 
			$city = 	$row['City']; 
			$zip = 		$row['Zip']; 

			echo "Name: " . $fname . " " .$lname. "<br>";
			echo "Address: " . $street . ", " .$city. " RI " .$zip. " <br>";
			echo "Size of area to be shoveled: " . $areasize . " sq ft <br>";
			if($plowtruck == 'yes')
			{
				echo "Plowtruck REQUIRED." ;
				echo "<br>";
			}else
			{
				echo "Plowtruck NOT required." ;
				echo "<br>";
			}

			echo "RequestID: " . $id. "<br>";

			//echo '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=$street&key=AIzaSyA4xAv_tVh0Z2kV0J0R6UdDJeznP3ADigE"  allowfullscreen> </iframe>' ;
			echo '<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=' . urlencode($street) . '&key=AIzaSyA4xAv_tVh0Z2kV0J0R6UdDJeznP3ADigE"  allowfullscreen> </iframe>';
		}

		
			
		//update request status from "pending" to "accepted", shoveler inputs his/her info and a text message to requester 
		if(mysqli_query($db_connection, $updateStatQuery))
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
							<h1 id='headertitle' class=''><strong>Include your information and click 'Let's Shovel' button</strong></h1><br> 
						
							<form id='AcceptRequestForm' action='acceptshovelquery.php' method='post'>
								Your first name:
								<input type='text' id='shovelerFName' name='shovelerFName' value=''><br>
								Your last name:
								<input type='text' id='shovelerLName' name='shovelerLName' value=''><br>
								Your contact phone:
								<input type='text' id='shovelerPhone' name='shovelerPhone' value='' 
								pattern='^(1)(4)(0)(1)(\d{7})$'' title = 'Please Enter a number in the format 1401XXXXXXX'><br>
								<button class = 'shovelBTN' id='shovelBTN' title='Accept Request'>Let's Shovel !</button>
							</form>
							<form id='cancelFrom' action='cancel.php' method='post'>
								<button class = 'cancelBTN' id='cancelBTN' title='Cancel Request'>Cancel</button>
								<input type='hidden' id = 'id' name='id' value='$id'/>
							</form>
						</body>
					</html>";
		}

	}else
	{
		echo "debugging... no requestID information passed from displayrequests.php or searchrequests.php";
	}
	
?>