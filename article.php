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
  
  
  $query = "SELECT TITLE, USERNAME, TEXT FROM ARTICLE WHERE ";
  $query = $query . "ARTICLE_ID='$this_id'";
  $featured_article = mysql_query($query, $conn);
  
  $query = "SELECT TITLE, USERNAME, ARTICLE_ID FROM ARTICLE";
  $panel_articles = mysql_query($query, $conn);
  
  var_dump($panel_articles);
?>

<html>
<?php include("menu.php"); ?>
<div style="background-color:#FFFFFF; color:#99456F; width:100%; height:4%;">
<?php while($row = mysql_fetch_assoc($panel_articles)) {
	var_dump(1);
}
while($article = mysql_fetch_assoc($featured_article)) {
  if($_SESSION['user']) { ?>
    <form action="" method="GET">
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
    <form action="" method="GET">
	 <h1><?php echo($article['TITLE']) ?></h1>
	 <label>by <?php echo($article['USERNAME']) ?></label>
    <br/>
	 <p><?php echo($article['TEXT']) ?></p>
  <?php }
} ?>
</div>

</html>
