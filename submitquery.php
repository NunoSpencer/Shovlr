
<?php

/*
    Database query to submit requests for snow shoveling... 
    when user clicks SUBMIT button, the info from request.html form will be submitted to the database ("requests" table) 
*/

//connect to database
$db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

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
    echo "Request submitted sucessfully!";
    //echo $AreaSize;

}else
    echo "Failed to querying into database!";
?>