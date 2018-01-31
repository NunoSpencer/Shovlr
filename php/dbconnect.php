  /*
      php code to connect to the database...
      this file is included on "submitquery.php" so querying requests can be processed to database
  */
  
  
  
  <?php
      $con = mysql_connect("localhost", "root", "");
      $db = mysql_select_db("shovlrdb");

      if($con)
      {
        echo("Connection sucessfully!");        
      }else
      {
        die("Error connecting to Database!");
      }
  ?>
