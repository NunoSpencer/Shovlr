<?php
    /*
            Database query to display pending shovel requests... 
            when user clicks "SHOVEL" button, a link with the number of requests is shown...
            clicking the link will display a table all pending requests...
    */

    //connect to database (could also use "require (dbconnect.php);" so we don't have to code this everytime we need a connection")
    $db_connection = mysqli_connect('localhost','root', 'shovlrdb');

    //query to retrieve all pending requests
    $selectQuery = "SELECT * FROM requests WHERE Status='pending'";

    //query to display results
    $result = mysqli_query($db_connection, $selectQuery) or die("Failed to querying into database!");

    //variable to count #of pending requests
    $counter = 0;

    //display table headings
    echo "<table border = '1'>";
    echo "<tr> <td>Last Name</td> <td>First Name</td> <td>Phone</td> <td> Area Size</td> <td>Street</td> <td>City</td> <td>ZIP</td> <td>Status</td> <td>Date</td> <td>Time</td> </tr>";

        //display each row (pending request) on the table
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr> <td>{$row ['LName']}    </td> 
                       <td>{$row ['FName']}    </td> 
                       <td>{$row ['Phone']}    </td> 
                       <td>{$row ['AreaSize']} </td> 
                       <td>{$row ['Street']}   </td> 
                       <td>{$row ['City']}     </td> 
                       <td>{$row ['Zip']}      </td> 
                       <td>{$row ['Status']}          </td> 
                       <td>{$row ['RequestDate']}     </td>
                       <td>{$row ['RequestTime']}     </td></tr>";
            
            $counter++;
        }
    
    echo"</table>";

?>