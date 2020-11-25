<?php
ob_start();
include('dbc_vars.php');
ini_set('session.serialize_handler', 'PHP');
session_start();
$_SESSION = [];
session_destroy();
if ($dbc = mysqli_connect($host, $user_name, $password, $database)){
  $query = "DROP TABLE cart";
  mysqli_query($dbc, $query);
  mysqli_close($dbc);
  header('Location: ../index.php');
  ob_end_flush();
} else {
  print "<p class=\"error\">Cannot connect to database.</p>";
}

 ?>
