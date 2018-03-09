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

    
    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {
        //connect to database
        $db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');

        //save input info to variables
        $city = $_POST["City"];                     //city input info from front-end
        $plowtruck = $_POST["PlowTruckList"];       //plowtruck info from front-end
        $plowtruckChoice = "";                      //if plowtruck is selected from front-end, save value into this variable
        
        
        if ($plowtruck != 'choice')                 //test that a plowtruck selection was chosen
        {
            $plowtruckChoice = "AND PlowTruck = '$plowtruck'";
        }

        //SQL queries
        $queryCity= "SELECT LName, FName, Phone, AreaSize, PlowTruck, Street, City, Zip, Stat, RequestID, RequestDate, RequestTime
                            FROM requests
                            WHERE City='$city'
                            AND Stat ='pending'
                            $plowtruckChoice";                     

        //search results for city
        $cityResults = mysqli_query($db_connection, $queryCity);

        if(empty($_POST["City"]))                           //if no city selected from drop-down list
        {
            echo "a city is required!";
        }
        else if(mysqli_num_rows($cityResults) > 0) 
        {
            $rowcount = mysqli_num_rows($cityResults);      //number of results, if any..                                      

            printf("%d pending request(s) found for %s requiring plow truck!\n", $rowcount, $city);
            echo "\n";

            //diplay table headings 
            echo "<table border = '1'>";
            echo "<tr> <td> Last Name </td> <td> First Name </td> <td> Phone </td> <td> Area Size </td> <td> PlowTruck </td> <td> Street </td> <td> City </td> <td> ZIP </td> <td> Status </td> <td> Date </td> <td> Time </td> </tr>";

            //display results on the table
            while($row=mysqli_fetch_array($cityResults))
            {
                echo "<tr>  <td>{$row ['LName']}    </td> 
                            <td>{$row ['FName']}    </td> 
                            <td>{$row ['Phone']}    </td> 
                            <td>{$row ['AreaSize']} </td>
                            <td>{$row ['PlowTruck']} </td>  
                            <td>{$row ['Street']}   </td> 
                            <td>{$row ['City']}     </td> 
                            <td>{$row ['Zip']}      </td> 
                            <td>{$row ['Stat']}          </td> 
                            <td>{$row ['RequestDate']}     </td>
                            <td>{$row ['RequestTime']}     </td></tr>";
            }
        }else /*if(!(mysqli_num_rows($cityResults)))    */                     //else if no results at all
        {
            printf("There are currently no pending requests for %s! \n", $city);
        }
            
    }        
    
?>