<?php

//connect to database
$db_connection = mysqli_connect('localhost', 'root', 'nopass123', 'shovlrdb');

$clockworkAPIkey = 'b524a50d77e6017daf822b93efad9fa553438a53';

$user = $_REQUEST['userType'];
$id = $_REQUEST['requestID'];
setcookie("cancelID", $id);

$requestIdQuery = "SELECT * FROM requests WHERE RequestID = '$id'";
$requesterInfo = mysqli_query($db_connection, $requestIdQuery)or die("Failed to query database!");

$requestIdQueryShovel = "SELECT * FROM requests WHERE RequestID = '$id' AND Stat = 'accepted'";
$requesterInfoShovel = mysqli_query($db_connection, $requestIdQueryShovel)or die("Failed to query database!");

displayHTML();
if($user == "requester")
{

	if($requesterInfo)
	{
		displayTable($requesterInfo);
		echo"<form id='CancelRequestFormRequester' action='requestercancelquery.php' method='post'>
        
				<button id='cancelRequestButton' class='btn btn-primary col-lg-offset-10' title=''>Submit</button>
				<input type='button' class='btn btn-primary' onclick='javascript:history.back()'title='Cancel request' value='Cancel' />
      
    		</form>
        </body>
        </html>";
    }
	else
	{
		echo "Failed to querying into database!";
	}
}
else
{

	if($requesterInfoShovel)
	{
		displayTable($requesterInfoShovel);
		echo"<form id='CancelRequestFormRequester' action='shovelercancelquery.php' method='post'>
				<button id='cancelRequestButton' class='btn btn-primary col-lg-offset-10' title=''>Submit</button>
				<input type='button' class='btn btn-primary' onclick='javascript:history.back()'title='Cancel request' value='Cancel' />
    		</form>
        </body>
        </html>";
	}
	else
	{
		echo "Failed to querying into database!";
	}
	
}

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
      <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> 
      <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
      <title> SNOW REMOVAL Requests </title>
      </head>
      <body>
      <div class='bg'></div>
      <div class='main title bar'>
      <h1>Cancel Request For: </h1>
      </div>
      </div>";
}

function displayTable($requesterInfo)
{
	echo "<table class='table table-striped'>";
    	//echo "<tr> <td>Last Name</td> <td>First Name</td> <td>Area Size</td> <td> PlowTruck </td> <td>Street</td> <td>City</td> <td>ZIP</td> <td>Date</td> <td>Time</td> </tr>";

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
            </tr>
            </thread>";
        //display each row (pending request) on the table
        while($row = mysqli_fetch_assoc($requesterInfo))
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
                    </tr></tbody>";
            $phone = $row['Phone']; 
			setcookie("cancelPhoneCookie", $phone); 
        }

        echo "</table>";
                
}

?>