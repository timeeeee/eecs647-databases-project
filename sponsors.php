<?php session_start(); ?>
<html>
  <?php include("menu.php"); ?>
  <div>
	<h1>Sponsors</h1>
	<?php
      // database variables
      $hostname = "mysql.eecs.ku.edu";
      $sqluser = "jamiller";
      $sqlpass = "Zv35vr6C";
      $dbname = "jamiller";

      $conn = mysql_connect($hostname, $sqluser, $sqlpass);
      mysql_select_db($dbname);

      $query = "SELECT NAME, IMAGEPATH FROM SPONSORS";
      $query_result = mysql_query($query, $conn);
       while ($row = mysql_fetch_row($query_result)) {
        echo("<img src='images/" . $row[1] . "'/>");
        echo("<p>" . $row[0] . "</p>");
      }
    ?>
  </div>
</html>
          
