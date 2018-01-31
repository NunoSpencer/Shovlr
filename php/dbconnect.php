  /*
      php code to connect to the database...
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
