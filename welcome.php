<?php
define('TITLE', 'Welcome!');
include('templates/header.php');
include('templates/menu.php');



print "<h1>".TITLE."</h1>";
print "<p>Welcome, {$_SESSION['username']} you have successfully signed in!</p>
      <p><a href=\"index.php\">Click here</a> to go home.</p>
      <p><a href=\"shop.php\">Click here</a> to go to the shop.</p>";


include('templates/footer.html');
?>
