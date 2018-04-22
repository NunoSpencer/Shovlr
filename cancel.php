<?php

$db_connection = mysqli_connect('localhost', 'root', 'nopass123', 'shovlrdb');

	if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			
			$updateStat = "UPDATE requests SET Stat = 'pending' WHERE RequestID = '$id'";

			if(mysqli_query($db_connection, $updateStat))
			{
	   			echo"Canceled request";
	   		}
			else
			{
	    		echo "Failed to querying into database!";
			}
		}
		else
		{
			echo "accept empty";
		}

?>