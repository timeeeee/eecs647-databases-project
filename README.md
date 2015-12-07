===========================================
Cycling Team Website for EECS 647 Databases
===========================================

Jordan Miller, Tim Clark

menu.php
========

To include the menu in a page, add the line::

    <?php include("menu.php"); ?>


Logging in
==========

When a user logs in on login.html, a session is created for them, and the
'user' variable set.

On all pages, at the top of the page add the line::

    <?php session_start(); ?>

to get the users current session, if they have one. Now you can use::

    isset($_SESSION['user'])

to see if a user is logged in, and::

    <?php $_SESSION['user']; ?>

to insert their username into the page.