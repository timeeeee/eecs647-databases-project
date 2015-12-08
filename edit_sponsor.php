<?php
  session_start();
  if (!isset($_SESSION['user'])) header("location: sponsors.php");
  $user = $_SESSION['user'];

  // set up database connection
  $hostname = "mysql.eecs.ku.edu";
  $sqluser = "jamiller";
  $sqlpass = "Zv35vr6C";
  $dbname = "jamiller";

  $conn = mysql_connect($hostname, $sqluser, $sqlpass)
	  or die("Can't connect to database: " . mysql_error());
  mysql_select_db($dbname) or die("can't select database");

  if (isset($_POST['save']) || isset($_POST['update'])) {
    $path = $_FILES['image']['name'];
	$name = $_POST['name'];

    if (isset($_POST['save'])) {
	  // Create new
      $values = "('" . $name . "', '" . $path . "', '" . $user . "')";
      $query = "INSERT INTO SPONSORS VALUES " . $values;
	} else {
	  // Update existing sponsor
	  $old_name = $_POST['old_name'];
	  $query = "UPDATE SPONSORS SET NAME='" . $name . "'";
      if ($path) $query = $query . ", IMAGEPATH='" . $path . "'";
	  $query = $query . " WHERE NAME='" . $old_name . "'";
    }

	mysql_query($query, $conn);
    if ($path) {
      move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $path);
	  $target = "images/" . $path;
      $chmod_result = chmod($target, 0644);
	}
	header("location: sponsors.php");
  }

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

	$button_label = "update";
  } else {
    // creating a new one- label the button save instead of update
    $button_label = "save";
	$name = "";
  }
  ?>

<html>
  <?php include("menu.php"); ?>
  <div id="main">
    <h1>Edit sponsor:</h1>
    <?php if (isset($path)) echo("<img src='images/" . $path . "'/>"); ?>
	<form action="" method="post" enctype="multipart/form-data">
	  <label>Name:</label>
      <input type="text" size="40" name="name" value="<?=$name?>" />
      <label>Image:</label>
      <input type="file" accept="image/*" name="image" />
      <?php if (isset($name)) echo("<input type='hidden' name='old_name' " .
	                               "value='" . $name . "' />"); ?>
	  <input type="submit" name="<?=$button_label?>" value="<?=$button_label?>" />
    </form>
  </div>
</html>
