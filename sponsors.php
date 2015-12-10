<?php
  session_start();
  ?>
<html>
  <?php include("menu.php"); ?>
  <link rel="stylesheet" type="text/css" href="sponsors.css">
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

      $query = "SELECT NAME, IMAGEPATH, LINK FROM SPONSORS";
      $query_result = mysql_query($query, $conn);
       while ($row = mysql_fetch_row($query_result)) {
	    echo("<div class='sponsor'>");
		echo("<a href='" . $row[2] . "'>");
        echo("<img src='images/" . $row[1] . "'/>");
		echo("</a>");
        echo("<p>" . $row[0] . "</p>");

		if (isset($_SESSION['user'])) {
		  $edit_url = "edit_sponsor.php?name=" . $row[0];
		  $delete_url = "delete_sponsor.php?name=" . $row[0];
		  echo("<p><a href='" . $edit_url . "'>Edit</a></p>");
		  echo("<p><a href='" . $delete_url . "'>Delete</a></p>");
		}

   		echo("</div>");

	   }

      if (isset($_SESSION['user']))
        echo("<p><a href='edit_sponsor.php'>Add new</a></p>");
    ?>
  </div>
</html>
          
