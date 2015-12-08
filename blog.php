<?php
  // database variables
  $hostname = "mysql.eecs.ku.edu";
  $sqluser = "jamiller";
  $sqlpass = "Zv35vr6C";
  $dbname = "jamiller";

  session_start();
  $error = '';
 
  // Connect to database
  $conn = mysql_connect($hostname, $sqluser, $sqlpass);
  Mysql_select_db($dbname);

  $this_id = isset($_GET['article_id']) ? $_GET['article_id'] : '1';
  
  $query = "SELECT TITLE, USERNAME, TEXT, ARTICLE_ID FROM ARTICLE";
  $panel_articles = mysql_query($query, $conn);
?>

<html>
<?php include("menu.php"); ?>
<link rel="stylesheet" type="text/css" href="blog.css" />

<ul id="panel">
<?php while($article = mysql_fetch_assoc($panel_articles)) { ?>
  <li>
  <?php $article_link="article.php?article_id=".$article['ARTICLE_ID']; ?>
  <a href=<?=$article_link?> id="link">
    <h1 id="title"><?php echo($article['TITLE']) ?></h1>
    <h3 id="author">by <?php echo($article['USERNAME']) ?></h3>
    </br>
    <p id="snippet"><?php echo($article['TEXT']) ?></p>
 </a>
 </li>
<?php }
if($_SESSION['user']) { ?>
  <li>
  <?php $article_link="article.php?new=0"; ?>
  <a href=<?=$article_link?> id="link">
    <h1 id="title">+ Add New Article</h1>
  </a>
  </li>
<?php } ?>
</ul>

</html>
