
<?php

        /*
            Database query to submit requests for snow shoveling... 
            when user clicks SUBMIT button, the info from request.html form will be submitted to the database ("requests" table) 
        */

        //connect to database
        $db_connection = mysqli_connect('localhost',  'shovlrdb');
     
        $LName = $_REQUEST['LName'];
        $FName = $_REQUEST['FName'];
        $Phone = $_REQUEST['Phone'];
        $AreaSize = $_REQUEST['AreaSize'];
        $Street = $_REQUEST['Street'];
        $City = $_REQUEST['City'];
        $Zip = $_REQUEST['Zip'];  
        
        //$RequestID = uniqid('ID');
        $RequestID = uniqid(rand(10,99), true);

        date_default_timezone_set('EST');

        $Date = date("Y-m-d");
        $Time = date("g:i a", time());


        
        //submit request query
        $submitQuery = mysqli_query($db_connection, "INSERT INTO requests (LName, FName, Phone, AreaSize, Street, City, Zip, Status, RequestID, RequestDate, RequestTime) VALUES 
            ('$LName', '$FName', '$Phone', '$AreaSize', '$Street', '$City','$Zip', 'pending', '$RequestID', '$Date', '$Time')");

        if($submitQuery)
        {
            echo "Request submitted sucessfully!";
        }else
            echo "Failed to querying into database!";
?>