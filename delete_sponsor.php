<?php
  session_start();
  if (!isset($_SESSION['user'])) header("location: sponsors.php");

  // set up database connection
  $hostname = "mysql.eecs.ku.edu";
  $sqluser = "jamiller";
  $sqlpass = "Zv35vr6C";
  $dbname = "jamiller";

  $conn = mysql_connect($hostname, $sqluser, $sqlpass)
	  or die("Can't connect to database: " . mysql_error());
  mysql_select_db($dbname) or die("can't select database");

  $name = $_GET['name'];

  // Get path
  $query = "SELECT IMAGEPATH FROM SPONSORS WHERE NAME='" . $name . "'";
  $query_result = mysql_query($query, $conn);
  $path = mysql_fetch_row($query_result)[0];
    
  $query = "DELETE FROM SPONSORS WHERE NAME='" . $_GET['name'] . "'";
  $query_result = mysql_query($query, $conn);

  // delete the image itself
  $target = "images/" . $path;
  unlink($target);

  header("location: sponsors.php");
?>
