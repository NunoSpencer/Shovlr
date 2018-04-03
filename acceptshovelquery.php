<?php

/*
    Database query to accept requests for snow shoveling... 
    when user clicks LET'S SHOVEL button on AcceptRequest.html, the info from the form will on that page will be submitted to the database ("requestsaccepted" table) 
*/

$db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

	$shovelerFName = $_REQUEST['shovelerFName'];
	$shovelerLName = $_REQUEST['shovelerLName'];
	$shovelerPhone = $_REQUEST['shovelerPhone'];
	
	//$RequestID = uniqid('ID');
	//$RequestID = uniqid('SHV',rand(1,20));
	$acceptID = 'id'.substr(md5(microtime()),rand(0,25),7);

	//specify date & time
	date_default_timezone_set('EST');
	$acceptDate = date("Y-m-d");
	$acceptTime = date("g:i a", time());

	//send accept query to db
	$submitAcceptQuery = mysqli_query($db_connection, "INSERT INTO requestsaccepted (shovelerFName, shovelerLName, shovelerPhone, acceptID, acceptDate, acceptTime, shovelStatus) VALUES 
		('$shovelerFName', '$shovelerLName', '$shovelerPhone', '$acceptID', '$acceptDate', '$acceptTime', 'shovel in process')");

	
	if($submitAcceptQuery)
	{
		echo "Request Accepted! The requesting person has been informed and will be contacting you soon!";
	}else
	{
		echo "Failed to querying into database!";
	}

	

?>



