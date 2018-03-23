<?php
	$db_connection = mysqli_connect('localhost', '', '', 'shovlrdb');

	if(isset($_POST['Id']))
	{
		$id = $_POST['Id'];
		
		$updateStat = "UPDATE requests SET Stat = 'accepted' WHERE RequestID = '$id'";

		if(mysqli_query($db_connection, $updateStat))
		{
   			 echo "Update sucessful!";
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