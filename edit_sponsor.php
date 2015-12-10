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
    $url = $_POST['url'];

    if (isset($_POST['save'])) {
	  // Create new
      $values = "('" . $name . "', '" . $path . "', '" . $url . "')";
      $query = "INSERT INTO SPONSORS VALUES " . $values;
	} else {
	  // Update existing sponsor
	  $old_name = $_POST['old_name'];
	  $query = "UPDATE SPONSORS SET NAME='" . $name . "', LINK='" . $url . "'";
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
  
    $query = "SELECT NAME, IMAGEPATH, LINK FROM SPONSORS ";
	$query = $query . "WHERE NAME='" . $_GET['name'] . "'";
    $query_result = mysql_query($query, $conn);
	if (mysql_num_rows($query_result) == 0)
	  header("location: sponsors.php");
    
	$row = mysql_fetch_row($query_result);
    $name = $row[0];
	$path = $row[1];
	$url = $row[2];

	$button_label = "update";
  } else {
    // creating a new one- label the button save instead of update
    $button_label = "save";
	$name = "";
    $url = "";
  }
  ?>

<html>
  <?php include("menu.php"); ?>
  <div id="main">
    <h1>Edit sponsor:</h1>
    <?php if (isset($path)) echo("<img src='images/" . $path . "'/>"); ?>
	<form action="" method="post" enctype="multipart/form-data">
	  <p>
        <label>Name:</label>
        <input type="text" size="40" name="name" value="<?=$name?>" />
      </p>

	  <p>
	    <label>Url:</label>
	    <input type="text" size="100" name="url" value="<?=$url?>" />
      </p>

	  <p>
        <label>Image:</label>
        <input type="file" accept="image/*" name="image" />
        <?php if (isset($name)) echo("<input type='hidden' name='old_name' " .
	                                 "value='" . $name . "' />"); ?>
      </p>
	  <input type="submit" name="<?=$button_label?>" value="<?=$button_label?>" />
    </form>
  </div>
</html>
