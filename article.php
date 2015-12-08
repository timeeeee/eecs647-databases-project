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
  
  if(isset($_POST['article_title']) &&
     isset($_POST['article_body']) &&
     isset($_POST['save']))
  {
    $query = 'UPDATE ARTICLE SET TITLE="'.$_POST["article_title"];
    $query = $query.'", TEXT="'.$_POST["article_body"];
    $query = $query.'" WHERE ARTICLE_ID='.$this_id;
    mysql_query($query, $conn);
  }
  
  $query = "SELECT TITLE, USERNAME, TEXT FROM ARTICLE WHERE ";
  $query = $query . "ARTICLE_ID='$this_id'";
  $featured_article = mysql_query($query, $conn);
  
  $query = "SELECT TITLE, USERNAME, ARTICLE_ID FROM ARTICLE";
  $panel_articles = mysql_query($query, $conn);
?>

<html>
<?php include("menu.php"); ?>
<link rel="stylesheet" type="text/css" href="article.css" />

<ul id="sidepanel">
<?php while($row = mysql_fetch_assoc($panel_articles)) { ?>
  <li>
  <?php $article_link="article.php?article_id=".$row['ARTICLE_ID']; ?>
  <a href=<?=$article_link?> id="link">
  <label id="title"><?php echo($row['TITLE']) ?></label>
  </br>
  <label id="author"><?php echo($row['USERNAME']) ?><label>
  </a>
  </li>
<?php } ?>
</ul>

<div id="featuredarticle">
<?php while($article = mysql_fetch_assoc($featured_article)) {
  if($_SESSION['user']) { ?>
    <form action="" method="post">
	 <label>Title:</label>
    <input id="article_title" name="article_title" type="text" value="<?php echo($article['TITLE']) ?>">
	 <br/><br/>
	 <label>Article:</label>
	 <br/>
	 <textarea rows="20" cols="50" id="article_body" name="article_body" type="text"/><?php echo($article['TEXT']) ?></textarea>
	 <br/>
	 <input name="save" type="submit" value="Save" />
    </form>
  <?php } else { ?>
	 <h1><?php echo($article['TITLE']) ?></h1>
	 <label>by <?php echo($article['USERNAME']) ?></label>
    <br/>
	 <p><?php echo($article['TEXT']) ?></p>
  <?php }
} ?>
</div>

</html>
