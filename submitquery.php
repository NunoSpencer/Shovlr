/*
    Database query to submit requests for snow shoveling... 
    when user clicks SUBMIT button, the info from request.html form will be submitted to the database (on "Requests" table) 
*/

<?php
        include_once('dbconnect.php');

        $RequesterLName = $_POST["RequesterLName"];
        $RequesterFName = $_POST["RequesterFName"];
        $RequesterPhone = $_POST["RequesterPhone"];
        $AreaSizeSqFT = $_POST["AreaSizeSqFT"];
        $Street = $_POST["Street"];
        $City = $_POST["City"];
        $ZIP = $_POST["ZIP"];
        //$PlowTruck = $_POST["PlowTruck"]; //this comes from radio-button selection... gotta know how to pass the value from radio-button
        $Status = $_POST["pending"];

        if(mysql_query("INSERT INTO requests VALUES ('$RequesterLName', '$RequesterFName', '$RequesterPhone', '$AreaSizeSqFT', '$Street', '$City','$ZIP', '$Status')"))
            echo "Request was submitted sucessfully";
        else
            echo "Failed to querying into database!";
?>