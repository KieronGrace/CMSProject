<?php
include('../templates/header.php');
//check to see if data was sent
if ($dbc = mysqli_connect($host, $user_name, $password, $database)){
  $query = "DELETE FROM cart";
  mysqli_query($dbc, $query);
  mysqli_close($dbc);
  header('Location: ../cart.php');
  ob_end_flush();
} else {
  print "<p class=\"error\">Cannot connect to database.</p>";
}

header('Location: ../cart.php');
?>
