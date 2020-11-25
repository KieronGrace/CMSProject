<?php
define('TITLE', 'Register');
include('scripts/dbc_vars.php');
include('templates/header.php');
include('templates/menu.php');

print"<h2>Register for Cupcake Love</h2>";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if ($dbc = mysqli_connect($host, $user_name, $password, $database)) {

    $post_username = mysqli_real_escape_string($dbc, trim(strip_tags(strtolower($_POST['username']))));
    $post_password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password'])));
    $post_email = mysqli_real_escape_string($dbc, trim(strip_tags(strtolower($_POST['email']))));

    $check_user_exist = "SELECT * FROM users WHERE username = \"$post_username\"";
    $check_user_res = mysqli_query($dbc, $check_user_exist);

    if (mysqli_num_rows($check_user_res) == 0) {
      $query = "INSERT INTO users (username, password, user_email) VALUES (\"$post_username\", \"$post_password\", \"$post_email\")";
      if (mysqli_query($dbc, $query)){
      print "<p>Registration Successful!</p>";
      print "<p>Please <a href=\"http://kieroncodes.com/cmsproject/scripts/login.php\">login</a>.</p>";
      } else {
        "<p class=\"error\">Error: Something went wrong. Please <a href=\"register.php\">try again</a>.</p>";
      }
    } else {
      print "<p class=\"error\">This username is already registered.</p>";
      print "<p><a href=\"http://kieroncodes.com/cmsproject/scripts/login.php\">Login</a> or <a href=\"register.php\">try again</a>.</p>";
    }
  }

} else {

  //print form
  print "<form class=\"admin_forms\" action=\"register.php\" method=\"post\">
        <label for=\"username\">Username: </label><input type=\"text\" id=\"username\" name=\"username\" size=\"20\" required>
        <label for=\"password\">Password: </label><input type=\"password\" id=\"password\" name=\"password\" size=\"20\" required>
        <label for=\"email\">Email Address: </label><input type=\"email\" id=\"email\" name=\"email\" size=\"20\" required>
        <input type=\"submit\" name=\"submit\" value=\"Register\">
        </form>";
}




include('templates/footer.html');
  ?>
