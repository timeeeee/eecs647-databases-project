<?php
  if (isset($_SESSION['user'])) {
    $login_or_logout_label = "Logout";
    $login_or_logout_url = "logout.php";
  } else {
    $login_or_logout_label = "Login";
    $login_or_logout_url = "login.php";
  }
?>

<link rel="stylesheet" type="text/css" href="menu.css" />
<ul id="menu">
  <li><a href="home.php">Team Name</a></li>
  <li><a href="riders.php">Riders</a></li>
  <li><a href="blog.php">Blog</a></li>
  <li><a href="sponsors.php">Sponsors</a></li>
  <li><a href="events.php">Events</a></li>
  <li id="login"><a href="<?= $login_or_logout_url ?>"><?= $login_or_logout_label?></a></li>
</ul>
