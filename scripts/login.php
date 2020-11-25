<?php
define('TITLE', 'Login');
include('../templates/header.php');
include('../templates/menu.php');
include('dbc_vars.php');


print "<h1>". TITLE ."</h1>";
print "<p>Please use the form below to login:</p>
        <p>Note: You cannot add items to your cart until you are logged in.</p>";

//check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //if already submitted handle the form
  //connect to database
  if ($dbc = mysqli_connect($host, $user_name, $password, $database)) {
    //retrieve user information
    $username = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['username'])));

    $query = "SELECT username, password, user_id FROM users WHERE username=\"$username\"";
    $r = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($r);

    //validate username
    if ($row) {
      //compare and validate passwords


      $post_password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password'])));
      $db_password = $row['password'];

      if ($post_password == $db_password) {
        //set session variable
        $_SESSION['username'] = $username;

        //create cart
        $query =
        "CREATE TABLE IF NOT EXISTS cart (
          cart_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
          prod_id int NOT NULL,
          product_name varchar(20) NOT NULL,
          image_file varchar(30) NOT NULL,
          price decimal(10,2) NOT NULL,
          qty int NOT NULL,
          last_update timestamp NOT NULL,
          CONSTRAINT fk_cart_prod_id FOREIGN KEY (prod_id) REFERENCES products(prod_id)
        )";

        mysqli_query($dbc, $query);

        //log login
        $user_id = $row['user_id'];
        $query = "INSERT INTO login_logs(user_id) VALUES (\"$user_id\")";
        mysqli_query($dbc, $query);

        //redirect to welcome page
        ob_end_clean();
        header('Location: ../welcome.php');
        exit();

      } else {

        //reject incorrect password
        print "<p class=\"error\">The password entered was incorrect. Please <a href=\"login.php\">try again</a>.</p>";

      }

    } else {

      //reject unknown username
      print "<p class=\"error\">The username you entered was not found. Please <a href=\"login.php\">try again</a>.</p>";

    }

    mysqli_close($dbc);

  } else {

    //handle connection error
    print "<p class=\"error\">Unable to connect to database.</p>";

  }


} else {

  //print login form
  print "<form class=\"admin_forms\" action=\"login.php\" method=\"post\">";
    print "<label for=\"username\">User Name: </label><input type=\"text\" id=\"username\" name=\"username\" size=\"20\">";
    print "<label for=\"password\">Password: </label><input type=\"password\" id=\"password\" name=\"password\" size=\"20\">";
    print "<input type=\"submit\" name=\"submit\" value=\"Log In\">";
  print "</form>";

}


include('../templates/footer.html')
?>
