<?php
define('TITLE', 'Modify Users');
include('scripts/dbc_vars.php');
include('templates/header.php');
include('templates/menu.php');

print "<h2>Modify User</h2>";
print "<p>Note: Usernames cannot be updated using this form.</p>";
if(isset($_SESSION['username']) && ($_SESSION['username'] == 'admin')) {

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($dbc = mysqli_connect($host, $user_name, $password, $database)) {

      $post_username = mysqli_real_escape_string($dbc, trim(strip_tags(strtolower($_POST['username']))));
      $post_password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password'])));
      $post_email = mysqli_real_escape_string($dbc, trim(strip_tags(strtolower($_POST['email']))));

      $check_user_exist = "SELECT * FROM users WHERE username = '$post_username'";
      $check_user_res = mysqli_query($dbc, $check_user_exist);

      if (mysqli_num_rows($check_user_res)) {

        if(isset($_POST['delete_user'])) {

          $query = "DELETE FROM users WHERE username = \"$post_username\"";
          mysqli_query($dbc, $query);
          print "<p>User Deletion Successful!</p>";

        } else {

          $query = "UPDATE users SET password = \"$post_password\", user_email = \"$post_email\" WHERE username = \"$post_username\"";

          if (mysqli_query($dbc, $query)){

          print "<p>Update Successful!</p>";

          } else {

            "<p class=\"error\">Error: Something went wrong. Please <a href=\"register.php\">try again</a>.</p>";

          }

        }

      } else {

        print "<p class=\"error\">User Not Found.</p>";

      }

    }

  } else {

    //print form
    print "<form class=\"admin_forms\" action=\"modify_users.php\" method=\"post\">
          <label for=\"username\">Username: </label><input type=\"text\" id=\"username\" name=\"username\" size=\"20\" required>
          <label for=\"password\">Password: </label><input type=\"password\" id=\"password\" name=\"password\" size=\"20\" required>
          <label for=\"email\">Email Address: </label><input type=\"email\" id=\"email\" name=\"email\" size=\"20\" required>
          <label for=\"delete_user\">Delete User: </label><input type=\"checkbox\" id\"delete_user\" name=\"delete_user\">
          <input type=\"submit\" name=\"submit\" value=\"Submit\">
          </form>";

  }

} else {

  print "<p class=\"error\">You must be an Administrator to view this page.<p>";

}




include('templates/footer.html');
  ?>
