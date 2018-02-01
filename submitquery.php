/*
    Database query to submit requests for snow shoveling... 
    when user clicks SUBMIT button, the info from request.html form will be submitted to the database (on "Requests" table) 
*/


/* VERSION 1
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

        if(mysqli_query("INSERT INTO requests VALUES ('$RequesterLName', '$RequesterFName', '$RequesterPhone', '$AreaSizeSqFT', '$Street', '$City','$ZIP', '$Status')"))
            echo "Request was submitted sucessfully";
        else
            echo "Failed to querying into database!";
?>
*/


//VERSION 2

<?php
        //connect to database
        $db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

        $FName = $_REQUEST['FName'];
        $LName = $_REQUEST['LName'];
        $Phone = $_REQUEST['Phone'];
        $AreaSize = $_REQUEST['AreaSize'];
        $Street = $_REQUEST['Street'];
        $City = $_REQUEST['City'];
        $Zip = $_REQUEST['Zip'];
        
        $submitQuery = mysqli_query($db_connection, "INSERT INTO requests VALUES ('$RequesterLName', '$RequesterFName', '$RequesterPhone', '$AreaSizeSqFT', '$Street', '$City','$zip')");

?>