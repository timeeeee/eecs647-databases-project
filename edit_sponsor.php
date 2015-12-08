<?php
  session_start();
  if (!isset($_SESSION['user'])) header("location: sponsors.php");
  if (isset($_GET['name'])) {
    // Edit an existing article
    $hostname = "mysql.eecs.ku.edu";
    $sqluser = "jamiller";
    $sqlpass = "Zv35vr6C";
    $dbname = "jamiller";
  
    $conn = mysql_connect($hostname, $sqluser, $sqlpass)
	  or die("Can't connect to database: " . mysql_error());
    mysql_select_db($dbname) or die("can't select database");
  
    $query = "SELECT NAME, IMAGEPATH FROM SPONSORS ";
	$query = $query . "WHERE NAME='" . $_GET['name'] . "'";
    $query_result = mysql_query($query, $conn);
	if (mysql_num_rows($query_result) == 0)
	  header("location: sponsors.php");
    
	$row = mysql_fetch_row($query_result);
    $name = $row[0];
	$path = $row[1];
  }
  ?>

<html>
  <?php include("menu.php"); ?>
  <div id="main">
    <h1>Edit sponsor:</h1>
	<form>
	
	<?php
	  if (isset($_GET['name'])) {
	    // Edit an existing article
		echo("<p>edit existing article '" . $_GET['name'] . "'.</p>");
		echo("<p>" . $name . ", " . $path . "</p>");
      } else {
	    // Create a new article
		echo("<p>create a new article</p>");
     }
	 ?>
  </div>
</html>
	