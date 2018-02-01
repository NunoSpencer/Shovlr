/*
    Database query to submit requests for snow shoveling... 
    when user clicks SUBMIT button, the info from request.html form will be submitted to the database (on "Requests" table) 
*/

//VERSION 2

<?php
        //connect to database
        $db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

        $LName = $_REQUEST['LName'];
        $FName = $_REQUEST['FName'];
        $Phone = $_REQUEST['Phone'];
        $AreaSize = $_REQUEST['AreaSize'];
        $Street = $_REQUEST['Street'];
        $City = $_REQUEST['City'];
        $Zip = $_REQUEST['Zip'];
        
        $submitQuery = mysqli_query($db_connection, "INSERT INTO requests VALUES ('$LName', '$FName', '$Phone', '$AreaSize', '$Street', '$City','$Zip')");

        if($submitQuery)
        {
            echo "Request submitted sucessfully!";
        }else
            echo "Failed to querying into database!";
?>