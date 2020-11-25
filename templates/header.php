<?php
  if(!isset($_SESSION)){
    ini_set('session.serialize_handler', 'PHP');
    session_start();
  }
  ob_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial=scale=1.0">
    <meta name="description" content="Page created by Kieron Roberson to fulfill
    requirements for Liberty University CSIS 410 class web development assignment 03">
    <title>
      <?php
      if (defined('TITLE')){
        print TITLE;
      } else {
        print 'Cupcake Love';
      }
      ?>
    </title>
    <link rel="stylesheet" href="http://kieroncodes.com/cmsproject/css/basic_styles.css">
    <link rel="stylesheet" href="http://kieroncodes.com/cmsproject/css/page_spec.css">
    <?php if (TITLE == "Shop Home") { print "<link rel=\"stylesheet\" href=\"http://kieroncodes.com/cmsproject/css/shop.css\">"; } ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <?php if (TITLE == "Checkout") { print "<link rel=\"stylesheet\" href=\"http://kieroncodes.com/cmsproject/css/checkout.css\">"; } ?>
  </head>
  <body>
    <header class="siteHeader">
        <h1 class="logo"><a href="http://kieroncodes.com/cmsproject/index.php">Cupcake Love</a></h1>
        <?php

        if (isset($_SESSION['username'])){
          print "<div id=\"loginBlock\">"
                ."<p id=\"userName\">".$_SESSION['username']."</p>
                  <p><a href=\"http://kieroncodes.com/cmsproject/scripts/logout.php\">log out</a></p>"
                ."<a href=\"http://kieroncodes.com/cmsproject/cart.php\"><i id=\"cartIcon\" class=\"fas fa-shopping-cart\"></i></a></div>";
        } else {
          print "<div id=\"loginBlock\"><p id=\"userName\"><a href=\"http://kieroncodes.com/cmsproject/scripts/login.php\">Login</a></p></div>";
        }
          ?>
