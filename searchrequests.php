<?php
    /*
            Database query to SEARCH pending shovel requests... 

            -when user clicks "SEARCH" button (shovel.html front-end) results are returned - if any - depending on 
            input criteria (for instance, if user chooses a city, pending requests are returned based on the city chosen 
            by the user. 

            - "city", "area size" and "plow truck" are optional.

            - if user inputs more than 1  criteria (ex. "city" + "area size") the result is returned based on those 
            criteria together (i.e. displays pending requests based on "city" and "area size")
            
    */

    
    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {
        //connect to database
        $db_connection = mysqli_connect('localhost', 'root', 'nopass123', 'shovlrdb');

        //deletes every two days not based on time
        //$deleteQuery = "DELETE FROM requests WHERE RequestDate < (CURDATE() - INTERVAL 2 DAY)";
        //mysqli_query($db_connection, $deleteQuery) or die("Failed to querying into database for delete!");

        //save input info to variables
        
        $city = "";
        $plowtruck = "";
        $areaSize = "";

        // This will evaluate to TRUE so the text will be printed.
        if (isset($_POST["City"])) {
          $city = $_POST["City"];
        }

        if (isset($_POST["PlowTruckList"])) {
          $plowtruck = $_POST["PlowTruckList"];
        }

        if (isset($_POST["AreaSizeList"])) {
          $areaSize = $_POST["AreaSizeList"];
        }

        

                             //city input from front-end
              //plowtruck input from front-end
                 //areaSize input from front-end
        
        //extra search criteria (plowtruck and areasize)must be part of query save as strings 
        $cityChoice = "";
        $plowtruckChoice = "";                      //if plowtruck is selected from front-end
        $areaSizeChoice = "";

        if($city != "")
        {
          $cityChoice = "AND City = '$city'";
        }                       //if areasize is selected from front-end
        
        if ($plowtruck != "choice")                 //test that a plowtruck selection was chosen
        {
            $plowtruckChoice = "AND PlowTruck = '$plowtruck'";
        }
        if ($areaSize != "choice")                 //test that a plowtruck selection was chosen
        {
            $areaSizeChoice = "AND AreaSize = '$areaSize'";
        }

        //SQL queries
        $queryCity= "SELECT *
                            FROM requests
                            WHERE Stat ='pending'
                            $cityChoice
                            $plowtruckChoice
                            $areaSizeChoice";                     

        //search results for city
        $cityResults = mysqli_query($db_connection, $queryCity);

        if($cityResults) 
        {
            $rowcount = mysqli_num_rows($cityResults);      //number of results, if any..                                      

            echo "\n";

            displayHTML();

             
            displaySearch($city, $plowtruck, $areaSize, $rowcount);
            
            //diplay table headings 
            echo "<table class='table table-striped'>";
            //echo "<tr> <td>Last Name</td> <td>First Name</td> <td>Area Size</td> <td> PlowTruck </td> <td>Street</td> <td>City</td> <td>ZIP</td> <td>Date</td> <td>Time</td> <td>Wage Per Hour</td> <td>Do By Date</td> <td>Do By Time</td> <td></td>  </tr>";
            echo "<thead>
                    <tr>
                      <th scope='col'>Last Name</th>
                      <th scope='col'>First Name</th>
                      <th scope='col'>Area Size</th>
                      <th scope='col'>Plow Truck</th>
                      <th scope='col'>Street</th>
                      <th scope='col'>City</th>
                      <th scope='col'>Zip</th>
                      <th scope='col'>Date</th>
                      <th scope='col'>Time</th>
                      <th scope='col'>Price for Driveway</th>
                      <th scope='col'>Do by Date</th>
                      <th scope='col'>Do by Time</th>
                      <th scope='col'></th>
                    </tr>
                  </thead>";

            //display results on the table
            while($row=mysqli_fetch_array($cityResults))
            {
                echo "<tbody><tr> <td>{$row ['LName']}    </td> 
                       <td>{$row ['FName']}    </td>  
                       <td>{$row ['AreaSize']} </td> 
                       <td>{$row ['PlowTruck']} </td>
                       <td>{$row ['Street']}   </td> 
                       <td>{$row ['City']}     </td> 
                       <td>{$row ['Zip']}      </td>  
                       <td>{$row ['RequestDate']}     </td>
                       <td>{$row ['RequestTime']}     </td>
                       <td>{$row ['price']}     </td>
                       <td>{$row ['doByDate']}     </td>
                       <td>{$row ['doByTime']}     </td>
                       <td><button class='btn btn-primary' name='id' title='Accept snow removal request' value='".$row["RequestID"]."'>Accept</button></td>
                    </tr></tbody>"; 
            }

            echo"</table>
                 </form>
                 </body>
                 </html>";

        }
            
    }        
    
    //message displaying what the user searched for and the the results
    function displaySearch($city, $plowtruck, $areaSize, $rowcount)
    {
      if($city != "" || $plowtruck != "choice" || $areaSize != "choice")
      {

        if ($city != ""){
          $city = " found for ".$city;
          }
              
        if($plowtruck != "choice"){
          if($plowtruck == "no"){
            $plowtruck = " not requiring a plow truck";
          }else{
            $plowtruck = " requiring a plowtruck";
          }
          }else{
            $plowtruck = "";
          }

          if($areaSize != "choice"){
            $areaSize = " with the area size ".$areaSize;
          }else{
            $areaSize = "";
          }
            
          printf("%d pending request(s)%s%s%s!\n", $rowcount, $city, $plowtruck, $areaSize);
        }
        else{

          if($rowcount == 0)
           {
            printf ("There are no pending requests at this time. Try again later.");
           }else{
            printf("%d pending request(s)!\n", $rowcount);
            }
        }
    }

    //html page
    function displayHTML()
    {
       echo "
            <html>
            <head>
            <meta charset='utf-8>
            <meta name='description' content='Provide Snow Removal Service'>
            <meta name='author' content='SitePoint'>

            <link rel='stylesheet' type='text/css' href='bootstrap.min.css'>
            <link rel='stylesheet' type='text/css' href='custom.css'>
                      
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script> 
            <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script> 
            <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
            <script src='acceptscript.js' type='text/javascript'></script>
              
            <title></title>
            
            </head>
                    
            <body>
                    
              <div class='bg'></div>
              <div class='text-center'>

                <h1 id='headertitle' class=''><strong>Snow Removal Service - Pending Requests</strong></h1>

              </div>
              
               <form action='searchrequests.php' method='post'>
        <div class = 'form-row container'>
          <div class = 'form-group col-md-3'>
            <select id='City' name='City' class = 'form-control'>
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
          </div>

          <div class = 'form-group col-md-3'>
            <select id='AreaSizeList' name='AreaSizeList' class = 'form-control'>
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
          </div>
          
          <div class = 'form-group col-md-4'>
            <select id='PlowTruckList' name='PlowTruckList' class = 'form-control'>
              <option value='choice'> - choose an option for a plowtruck - </option>
              <option value='no'> no </option>
              <option value='yes'> yes </option>
            </select>
          </div>
          <div class = 'form-group col-md-1'>
            <button id='SearchButton' class='btn btn-primary'  title='Press Search with no fields to view all requests'>Search</button>
          </div>
          </div>
        </div> 
      </form> 
             
            
          
            <form id='AcceptRequestForm' action='accept.php' method='post'>";
    }

?>