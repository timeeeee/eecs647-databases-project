<?php
  session_start();

  // database variables
  $hostname = "mysql.eecs.ku.edu";
  $sqluser = "jamiller";
  $sqlpass = "Zv35vr6C";
  $dbname = "jamiller";

  $error = '';

  if (isset($_SESSION['user'])) {
    // User already logged in.
    header("location: home.php");
  } elseif (isset($_POST['login'])) {
    // This form was just submitted. Make sure username and password were provided
    if (empty($_POST['username']) || empty($_POST['password'])) {
      $error = "Invalid username or password.";
    } else {
      // Connect to database
      $conn = mysql_connect($hostname, $sqluser, $sqlpass);
      Mysql_select_db($dbname);

      // Check for username/password pair
      $username = mysql_real_escape_string($_POST['username']);
      $password = mysql_real_escape_string($_POST['password']);
      $hash_type = "sha256";
      $password_hash = hash($hash_type, $password);
      
      $query = "SELECT USERNAME FROM USERS WHERE ";
      $query = $query . "USERNAME='$username' AND PASSWORDHASH='$password_hash'";
      $query_result = mysql_query($query, $conn);
      $num_results = mysql_num_rows($query_result);
      if ($num_results == 1) { // successful login
        $_SESSION['user'] = $username;
		session_write_close();
        header("location: home.php");
      } else {
      $error = "Invalid username or password.";
      }
    }
  } elseif (isset($_POST['register'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
      $error = "Invalid username or password.";
    } else {
      // Check if this username is already used!

      // Connect to database
      $conn = mysql_connect($hostname, $sqluser, $sqlpass);
      Mysql_select_db($dbname);

      $username = mysql_real_escape_string($_POST['username']);
      $password = mysql_real_escape_string($_POST['password']);
      $hash_type = "sha256";
      $password_hash = hash($hash_type, $password);

      $query = "SELECT USERNAME FROM USERS WHERE ";
      $query = $query . "USERNAME='$username'";
      $query_result = mysql_query($query, $conn);
      $num_results = mysql_num_rows($query_result);
      if ($num_results == 1) {
        // user already exists
        $error = "Username '$username' already exists.";
      } else {
        // add user to the database
        $query = "INSERT INTO USERS VALUES ";
        $query = $query . "('$username', '$password_hash', 0)";
        mysql_query($query, $conn);

        // Log user in
        $_SESSION['user'] = $username;
        session_write_close();
        header("location: home.php");
      }
    }
  }
    
?>

<html>
<?php include("menu.php"); ?>
<div style="background-color:#FFFFFF; color:#99456F; width:100%; height:4%;">
  <h1>Login</h1>
  <form action="" method="post">
	<label>Username:</label>
	<input id="username" name="username" type="text" autofocus/>
	<br/>
	<label>Password:</label>
	<input id="password" name="password" type="password" />
	<br/>
	<input name="login" type="submit" value="Login" />
	<input name="register" type="submit" value="Register" />
	<span><?php echo($error); ?></span>
  </form>
</div>

</html>
