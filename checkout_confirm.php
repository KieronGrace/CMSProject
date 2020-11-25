<?php
define('TITLE', 'Checkout Confirmation');
include('templates/header.php');
include('templates/menu.php');
include('scripts/dbc_vars.php');

if ($dbc = mysqli_connect($host, $user_name, $password, $database)){
  $query = "DELETE FROM cart";
  mysqli_query($dbc, $query);
  mysqli_close($dbc);
}

$name = $_SESSION['username'];

print "<h1>".TITLE."</h1>";
print "<p>Thank you, {$name} your order has been placed.</p>
      <p><a href=\"index.php\">Click here</a> to go home.</p>
      <p><a href=\"shop.php\">Click here</a> to go to the shop.</p>
      <p><a href=\"scripts/logout.php\">Click here</a> to go to logout.</p>
      </p>";


include('templates/footer.html');
?>
