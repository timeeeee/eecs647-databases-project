<?php session_start(); ?>
<html>
<?php include("menu.php"); ?>
<h1>GOTTA GO FAST home</h1>
<div id="welcome">
  <?php
     if (isset($_SESSION['user'])) {
     echo("Welcome, " . $_SESSION['user']);
     }
     ?>
</div>
</html>
