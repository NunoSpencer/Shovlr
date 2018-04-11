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
    //$acceptedQuery = "SELECT * FROM requests WHERE Stat= 'accepted'";
                                 
    $deleteQuery = "DELETE FROM requests WHERE RequestDate < (CURDATE() - INTERVAL 2 DAY)";
    mysqli_query($db_connection, $deleteQuery) or die("Failed to querying into database for delete!");


    //query to display ALL pending results
    $result = mysqli_query($db_connection, $selectQuery) or die("Failed to querying into database!");
    
    //$acceptedErrorQuery = mysqli_query($db_connection, $requestsAcceptedQuery) or die("Failed to querying into database Error!");
 
    $rowcount = mysqli_num_rows($result);

    //counts #of pending requests
    $counter = 0;



    echo "
      <html>
      <head>

        <meta charset='utf-8>
        <meta name='description' content='Snow Removal Service'>
        <meta name='author' content='SitePoint'>

        <link rel='stylesheet' type='text/css' href='bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='custom.css'>
      
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script> 
        <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>

        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script> 
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> 
        <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
        <script src='acceptscript.js' type='text/javascript'></script>

        <style>
          #map {
          height: 400px;
          width: 100%;
          }
        </style>
        
        <title> SNOW REMOVAL Requests </title>
      </head>

      <body>
        <div class='bg'></div>
        <div class='main-title-bar'>

          <h1 id='headertitle' class=''><strong>Snow Removal Service - Pending Requests</strong></h1>

          <form action='searchrequests.php' method='post'>
            *City:
            <select id='City' name='City' >
              <option value=''>- choose a city -</option>
              <option value='Barrington'> Barrington </option>
              <option value='Bristol'> Bristol </option>
              <option value='Burriville'> Burriville </option>
              <option value='Central Falls'> Central Falls </option>
              <option value='Charlestown'> Charlestown </option>
              <option value='Coventry'> Coventry </option>
              <option value='Cranston'> Cranston </option>
              <option value='Cumberland'> Cumberland </option>
              <option value='East Greenwich'> East Greenwich </option>
              <option value='East Providence'> East Providence </option>
              <option value='Exeter'> Exeter </option>
              <option value='Foster'> Foster </option>
              <option value='Glocester'> Glocester </option>
              <option value='Hopkinton'> Hopkinton </option>
              <option value='Jamestown'> Jamestown </option>
              <option value='Johnston'> Johnston </option>
              <option value='Lincoln'> Lincoln </option>
              <option value='Little Compton'> Little Compton </option>
              <option value='Middletown'> Middletown </option>
              <option value='Narragansett'> Narragansett </option>
              <option value='Newport'> Newport </option>
              <option value='New Shoreham'> New Shoreham </option>
              <option value='North Kingstown'> North Kingstown </option>
              <option value='North Providence'> North Providence </option>
              <option value='North Smithfield'> North Smithfield </option>
              <option value='Pawtucket'> Pawtucket </option>
              <option value='Providence'> Providence </option>
              <option value='Richmond'> Richmond </option>
              <option value='Scituate'> Scituate </option>
              <option value='Smithfield'> Smithfield </option>
              <option value='South Kingstown'> South Kingstown </option>
              <option value='Tiverton'> Tiverton </option>
              <option value='Warren'> Warren </option>
              <option value='Warwick'> Warwick </option>
              <option value='Westerly' > Westerly </option>
              <option value='West Greenwich'> West Greenwich </option>
              <option value='West Warwick'> West Warwick </option>
              <option value='Woonsocket'> Woonsocket </option>
            </select>
          
            Area size (in sq ft):
            <select id='AreaSizeList' name='AreaSizeList'>
              <option value='choice'> - choose area size (sq. ft)- </option>
              <option value='<5'> less than 5 </option>
              <option value='[5-15]'> 5 - 15 </option>
              <option value='[16-25]'> 16 - 25 </option>
              <option value='[26-50]'> 26 - 50 </option>
              <option value='[51-80]'> 51 - 80 </option>
              <option value='[81-120]'> 81 - 120 </option>
              <option value='[121-150]'> 121 - 150 </option>
              <option value='>150'> greater than 150 </option>
            </select>
          
            Plow truck?
            <select id='PlowTruckList' name='PlowTruckList'>
              <option value='choice'> - choose an option - </option>
              <option value='no'> no </option>
              <option value='yes'> yes </option>
            </select>
          
            <button id='SearchButton' title='Search requests'>Search</button>
          </form> 
     
      </div>
  
    <form id='AcceptRequestForm' action='accept.php' method='post'>";
    
      
      if($rowcount == 0)
      {
        echo "There are no pending requests at this time. Try again later.";
      }else 
      {
        printf("Pending request(s): %d \n", $rowcount);
      }
    
      //display table headings
      echo "<table border = '1'>";
      echo "<tr> <td>Last Name</td> <td>First Name</td> <td>Area Size</td> <td> PlowTruck </td> <td>Street</td> <td>City</td> <td>ZIP</td> <td>Date</td> <td>Time</td> </tr>";

      //display each row (pending request) on the table
      while($row = mysqli_fetch_assoc($result))
      { 
        $street = $row['Street'];

        echo "<tr> <td>{$row ['LName']}    </td> 
                    <td>{$row ['FName']}    </td>  
                    <td>{$row ['AreaSize']} </td> 
                    <td>{$row ['PlowTruck']} </td>
                    <td>{$row ['Street']}   </td> 
                    <td>{$row ['City']}     </td> 
                    <td>{$row ['Zip']}      </td>  
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

<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 60%;
       }
    </style>
    <script src='displaymap.js' type='text/javascript'></script>
  </head>
  <body>
    <!-- <h3>(Shows pending requests on map)</h3>  -->
    <?php 
        //do the query to extract only street info
        // json_encode($row['Street'], true);
        // echo '<div id="data">' . $row['Street'] .'</div>';
    ?>
    
    <div id="map"></div>
  
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlTpfm9Ccq9oNF4QXusYYl92F0z5xDO1Y&callback=loadMap">
    </script>
  </body>

</html>
      