<?php session_start(); ?>
<html>
  <link rel="stylesheet" type="text/css" href="events.css">
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
    ?>
  <body>
    <?php include("menu.php"); ?>
	<div id="banner"></div>
    <div>
      <h1 id="textbanner">Upcoming Events</h1>
	  <div id="content">
	    <div id="col">
	      <div id="event">Here is an event.</div>
	      <div id="event">Next event in this schedule.</div>
  	    </div>
	    <div id="col">
	      <div id="event">Here is another event.</div>
	    </div>
	    <div id="col">
	      <div id="event">Here is yet another event.</div>
	    </div>
      </div>
	  <div id="sponsorbanner">
	    <?php while ($row = mysql_fetch_row($query_result)) {
          echo("<div id='sponsorlogo'>");
          echo("<img id='logo' src='images/" . $row[1] . "'/>");
          echo("</div>");
        } ?>
      </div>
  </body>
</html>
