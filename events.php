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

	$query = "SELECT NAME_EVENT, TIME, DESCRIPTION FROM EVENT WHERE NAME_EVENT='Race'";
    $race_result = mysql_query($query, $conn);
	
	$query = "SELECT NAME_EVENT, TIME, DESCRIPTION FROM EVENT WHERE NAME_EVENT='Charity'";
    $charity_result = mysql_query($query, $conn);
	
	$query = "SELECT NAME_EVENT, TIME, DESCRIPTION FROM EVENT WHERE NAME_EVENT='Ride'";
    $ride_result = mysql_query($query, $conn);
	
    $query = "SELECT NAME, IMAGEPATH FROM SPONSORS";
    $sponsors_result = mysql_query($query, $conn);
    ?>
  <body>
    <?php include("menu.php"); ?>
	<div id="banner"></div>
    <div>
      <h1 id="textbanner">Upcoming Events</h1>
	  <div id="content">
	    <div id="col">
		  <?php while ($row = mysql_fetch_row($race_result)) {
            echo("<div id='event'>");
            echo("<h2>" . $row[0] . "</h2>");
			echo("<p>" . $row[1] . "</p>");
            echo("<p>" . $row[2] . "</p>");
            echo("</div>");
          } ?>
  	    </div>
	    <div id="col">
	      <?php while ($row = mysql_fetch_row($charity_result)) {
            echo("<div id='event'>");
            echo("<h2>" . $row[0] . "</h2>");
			echo("<p>" . $row[1] . "</p>");
            echo("<p>" . $row[2] . "</p>");
            echo("</div>");
          } ?>
	    </div>
	    <div id="col">
	      <?php while ($row = mysql_fetch_row($ride_result)) {
            echo("<div id='event'>");
            echo("<h2>" . $row[0] . "</h2>");
			echo("<p>" . $row[1] . "</p>");
            echo("<p>" . $row[2] . "</p>");
            echo("</div>");
          } ?>
	    </div>
      </div>
	  <div id="sponsorbanner">
	    <?php while ($row = mysql_fetch_row($sponsors_result)) {
          echo("<div id='sponsorlogo'>");
          echo("<img id='logo' src='images/" . $row[1] . "'/>");
          echo("</div>");
        } ?>
      </div>
  </body>
</html>
