<?php
    /*
            Database query to SEARCH pending shovel requests... 

            -when user clicks "SEARCH" button (shovel.html front-end) results are returned - if any - depending on 
            input criteria (for instance, if user chooses a city, pending requests are returned based on the city chosen 
            by the user. 

            - "city" is required field -"area size" and "plow truck" are optional.

            - if user inputs more than 1  criteria (ex. "city" + "area size") the result is returned based on those 
            criteria together (i.e. displays pending requests based on "city" and "area size")
            
    */

    //test that search info was sent from front-end to database
    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {
        //connect to database
        $db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

        //save search info to variables
        $city = $_POST["CityList"];
        $areasize = $_POST["AreaSizeList"];
        //$plowtruck = $_POST["PlowTruckList"];

        //SQL query
        $searchQuery = "SELECT LName, FName, Phone, AreaSize, Street, City, Zip, Stat, RequestID, RequestDate, RequestTime
                        FROM requests
                        WHERE City='$city'
                        AND Stat ='pending' ";
                    
        //search results query (match search info with database records)
        $searchQueryResults = mysqli_query($db_connection, $searchQuery);
        
        //display results as on a table
        echo "<table border = '1'>";
        echo "<tr> <td>Last Name</td> <td>First Name</td> <td>Phone</td> <td> Area Size</td> <td>Street</td> <td>City</td> <td>ZIP</td> <td>Status</td> <td>Date</td> <td>Time</td> </tr>";


        if(mysqli_num_rows($searchQueryResults) > 0)
        {
            while($row=mysqli_fetch_array($searchQueryResults))
            {
                echo "<tr>  <td>{$row ['LName']}    </td> 
                            <td>{$row ['FName']}    </td> 
                            <td>{$row ['Phone']}    </td> 
                            <td>{$row ['AreaSize']} </td> 
                            <td>{$row ['Street']}   </td> 
                            <td>{$row ['City']}     </td> 
                            <td>{$row ['Zip']}      </td> 
                            <td>{$row ['Stat']}          </td> 
                            <td>{$row ['RequestDate']}     </td>
                            <td>{$row ['RequestTime']}     </td></tr>";
                
                //echo "<br>";
            }
        }else if(mysqli_num_rows($searchQueryResults) == null)
        {
            echo "No requests found for " + $city;
        }
        

    }


?>