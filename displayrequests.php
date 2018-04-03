<?php
    /*
            Database query to display pending shovel requests... 
            when user clicks "SHOVEL" button, a link with the number of requests is shown...
            clicking the link will display a table all pending requests...
    */

    //connect to database (could also use "require (dbconnect.php);" so we don't have to code this everytime we need a connection")
    $db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

    //query to retrieve all pending requests
    $selectQuery = "SELECT * FROM requests WHERE Stat='pending'";

    //query to display results
    $result = mysqli_query($db_connection, $selectQuery) or die("Failed to querying into database!");

    //variable to count #of pending requests
    $counter = 0;


    echo "
    <html>
    <head>
      <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script> 
      <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> 
      <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
      <script src='acceptscript.js' type='text/javascript'></script>
      <title> SNOW REMOVAL Requests </title>
    </head>
    <body>
    <form id='AcceptRequestForm' action='accept.php' method='post'>";
    

    //display table headings
    echo "<table border = '1'>";
    echo "<tr> <td>Last Name</td> <td>First Name</td> <td>Phone</td> <td> Area Size</td> <td> PlowTruck </td> <td>Street</td> <td>City</td> <td>ZIP</td> <td>Status</td> <td>Date</td> <td>Time</td> </tr>";

        //display each row (pending request) on the table
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr> <td>{$row ['LName']}    </td> 
                       <td>{$row ['FName']}    </td> 
                       <td>{$row ['Phone']}    </td> 
                       <td>{$row ['AreaSize']} </td> 
                       <td>{$row ['PlowTruck']} </td>
                       <td>{$row ['Street']}   </td> 
                       <td>{$row ['City']}     </td> 
                       <td>{$row ['Zip']}      </td> 
                       <td>{$row ['Stat']}          </td> 
                       <td>{$row ['RequestDate']}     </td>
                       <td>{$row ['RequestTime']}     </td>
                       <td><button class='acceptButton' name='id' title='Accept snow removal request' value='".$row["RequestID"]."'>Accept</button></td>
                    </tr>"; 
            $counter++;
        }
    
    echo"</table>
         </form>
         </body>
         </html>";

?>


