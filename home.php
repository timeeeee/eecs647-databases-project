<?php 
  $res = session_start();

  $hostname = "mysql.eecs.ku.edu";
  $sqluser = "jamiller";
  $sqlpass = "Zv35vr6C";
  $dbname = "jamiller";
  
  $conn = mysql_connect($hostname, $sqluser, $sqlpass) or die("could not connect");
  mysql_select_db($dbname) or die("could not select");
  ?>
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
	  <div id="blog">
	  <h2>Blog</h2>
        <?php
		  $query = "SELECT TITLE, TEXT, ARTICLE_ID FROM ARTICLE";
		  $articles = mysql_query($query, $conn);
		  while ($article = mysql_fetch_row($articles)) {
            echo("<div class='article'>");
			$link = "article.php?article_id=" . $article[2];
			echo("<a href='" . $link . "'>" . $article[0] . "</a>");
			echo("</div>");
          }
          ?>
      </div>
	  <div id="sponsors">
	  <h2>Sponsors</h2>
	    <?php
          $query = "SELECT IMAGEPATH, LINK FROM SPONSORS";
          $query_result = mysql_query($query, $conn);
           while ($row = mysql_fetch_row($query_result)) {
    	    echo("<div class='sponsor'>");
    		echo("<a href='" . $row[1] . "'>");
            echo("<img src='images/" . $row[0] . "'/>");
    		echo("</a>");
		   }
        ?>
	  </div>
	</div>
  </body>
</html>
