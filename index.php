<?php
define('TITLE', 'Welcome to Cupcake Love!');
include('templates/header.php');
include('templates/menu.php');
include('scripts/dbc_vars.php');

print "<h1><?php print TITLE ?></h1>
      <img class=\"mainFig\" src=\"http://kieroncodes.com/cmsproject/pics/baker_boxing.jpg\" alt=\"Baker boxing up some treats!\">";
print "<div id=\"home_message\"><p>";

$dbc = mysqli_connect($host, $user_name, $password, $database);
$query = "SELECT message FROM site_content WHERE file_name = 'index.php'";
$message = mysqli_fetch_row(mysqli_query($dbc, $query));
$message = $message[0];

print $message;

if (isset($_SESSION['username'])){
if (($_SESSION['username'] == 'admin' || $_SESSION['username'] == 'publisher')
    && (isset($_GET['admin'])) && ($_GET['admin'] == 'yes')) {

      print "<br><form class=\"admin_forms\" action=\"scripts/update_message.php\" method=\"post\">"
            ."<label for=\"message\">Update Message: </label>"
            ."<textarea name=\"message\" id=\"message\" rows=\"8\" cols=\"40\" maxlength=\"3000\" required>$message</textarea>"
            ."<input type=\"hidden\" name=\"file_name\" value=\"index.php\">"
            ."<input type=\"submit\" name=\"submit\" value=\"Submit\">"
            ."</form>";

      if ($_SESSION['username'] == 'admin') {
        print "<form class=\"admin_forms\" action=\"scripts/update_message.php\" method=\"post\">"
              ."<input type=\"hidden\" name=\"message\" value=\"\">"
              ."<input type=\"hidden\" name=\"file_name\" value=\"index.php\">"
              ."<input type=\"submit\" name=\"delete_message\" value=\"Delete\">"
              ."</form>";
      }
    }

}

print "</p></div>";



include('templates/footer.html');
?>
