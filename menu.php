<?php
  if (isset($_SESSION['user'])) {
    $login_or_logout_label = "Logout";
    $login_or_logout_url = "logout.html";
  } else {
    $login_or_logout_label = "Login";
    $login_or_logout_url = "login.html";
  }
?>

<link rel="stylesheet" type="text/css" href="menu.css" />
<ul id="menu">
  <li><a href="home.html">Team Name</a></li>
  <li><a href="riders.html">Riders</a></li>
  <li><a href="blog.html">Blog</a></li>
  <li><a href="sponsors.html">Sponsors</a></li>
  <li><a href="events.html">Events</a></li>
  <li id="login"><a href="<?= $login_or_logout_url ?>"><?= $login_or_logout_label?></a></li>
</ul>
