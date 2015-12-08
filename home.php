<?php session_start(); ?>
<html>
  <link rel="stylesheet" type="text/css" href="home.css">
  <body>
    <?php include("menu.php"); ?>
	<div id="banner"></div>
    <?php
      if (isset($_SESSION['user'])) {
      echo("<div id='welcome'>");
      echo("Welcome, " . $_SESSION['user']);
      echo("</div>");
      }
      ?>
    <h1 id="home">GOTTA GO FAST</h1>
	<div id="content">
	  <div id="blog">blog text here</div>
	  <div id="sponsors">sponsors here</div>
	</div>
  </body>
</html>
