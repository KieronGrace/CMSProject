<?php
define('TITLE', 'Confirm');
include('dbc_vars.php');
include('../templates/header.php');
include('../templates/menu.php');

if ($dbc = mysqli_connect($host, $user_name, $password, $database)){
  $message = mysqli_real_escape_string($dbc, trim($_POST['message']));
  $file_name = mysqli_real_escape_string($dbc, trim($_POST['file_name']));

  $query = "UPDATE site_content SET message = \"$message\" WHERE file_name = \"$file_name\"";

  mysqli_query($dbc, $query);
  mysqli_close($dbc);

  header("Location: ../index.php");

} else {
  print "<p class=\"error\">Unable to connect to database.<p>";
}


include('../templates/footer.html')
 ?>
