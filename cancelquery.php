<?php

//connect to database
<<<<<<< HEAD
$db_connection = mysqli_connect('localhost', 'root', 'nopass123', 'shovlrdb');
=======
$db_connection = mysqli_connect('localhost', 'root', '', 'shovlrdb');
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db

$clockworkAPIkey = 'b524a50d77e6017daf822b93efad9fa553438a53';

$user = $_REQUEST['userType'];
$id = $_REQUEST['requestID'];
setcookie("cancelID", $id);

$requestIdQuery = "SELECT * FROM requests WHERE RequestID = '$id'";
$requesterInfo = mysqli_query($db_connection, $requestIdQuery)or die("Failed to query database!");

<<<<<<< HEAD
$requestIdQueryShovel = "SELECT * FROM requests WHERE RequestID = '$id' AND Stat = 'accepted'";
$requesterInfoShovel = mysqli_query($db_connection, $requestIdQueryShovel)or die("Failed to query database!");

=======
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db
displayHTML();
if($user == "requester")
{

	if($requesterInfo)
	{
		displayTable($requesterInfo);
		echo"<form id='CancelRequestFormRequester' action='requestercancelquery.php' method='post'>
<<<<<<< HEAD
        
				<button id='cancelRequestButton' class='btn btn-primary col-lg-offset-10' title=''>Submit</button>
				<input type='button' class='btn btn-primary' onclick='javascript:history.back()'title='Cancel request' value='Cancel' />
      
    		</form>
        </body>
        </html>";
=======
				<button id='cancelRequestButton' title=''>Submit</button>
				<input type='button' onclick='javascript:history.back()'title='Cancel request' value='Cancel' />
    		</form>";
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db
    }
	else
	{
		echo "Failed to querying into database!";
	}
}
else
{

<<<<<<< HEAD
	if($requesterInfoShovel)
	{
		displayTable($requesterInfoShovel);
		echo"<form id='CancelRequestFormRequester' action='shovelercancelquery.php' method='post'>
				<button id='cancelRequestButton' class='btn btn-primary col-lg-offset-10' title=''>Submit</button>
				<input type='button' class='btn btn-primary' onclick='javascript:history.back()'title='Cancel request' value='Cancel' />
    		</form>
        </body>
        </html>";
=======
	if($requesterInfo)
	{
		displayTable($requesterInfo);
		echo"<form id='CancelRequestFormRequester' action='shovelercancelquery.php' method='post'>
				<button id='cancelRequestButton' title=''>Submit</button>
				<input type='button' onclick='javascript:history.back()'title='Cancel request' value='Cancel' />
    		</form>";
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db
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
<<<<<<< HEAD
      <div class='main title bar'>
=======
      <div class='main-title-bar'>
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db
      <h1>Cancel Request For: </h1>
      </div>
      </div>";
}

function displayTable($requesterInfo)
{
<<<<<<< HEAD
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
=======
	echo "<table border = '1'>";
    	echo "<tr> <td>Last Name</td> <td>First Name</td> <td>Area Size</td> <td> PlowTruck </td> <td>Street</td> <td>City</td> <td>ZIP</td> <td>Date</td> <td>Time</td> </tr>";

        //display each row (pending request) on the table
        while($row = mysqli_fetch_assoc($requesterInfo))
        {
            echo "<tr> <td>{$row ['LName']}    </td> 
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db
                       <td>{$row ['FName']}    </td>  
                       <td>{$row ['AreaSize']} </td> 
                       <td>{$row ['PlowTruck']} </td>
                       <td>{$row ['Street']}   </td> 
                       <td>{$row ['City']}     </td> 
                       <td>{$row ['Zip']}      </td>  
                       <td>{$row ['RequestDate']}     </td>
                       <td>{$row ['RequestTime']}     </td>
<<<<<<< HEAD
                    </tr></tbody>";
=======
                    </tr>";
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db
            $phone = $row['Phone']; 
			setcookie("cancelPhoneCookie", $phone); 
        }

        echo "</table>";
<<<<<<< HEAD
                
=======
>>>>>>> b9cfe9374e6497b717a084cafe9d9c0d0abbe6db
}

?>