<?php
define('TITLE', 'Confirm');
include('dbc_vars.php');
include('../templates/header.php');
include('../templates/menu.php');


  if ($dbc = mysqli_connect($host, $user_name, $password, $database)){
    //retrieve form data
    $product_name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['product_name'])));

    //check it the product exists
    $check_prod_exist = "SELECT * FROM products WHERE product_name='$product_name'";
    $check_prod_res = mysqli_query($dbc, $check_prod_exist);

    //if product does not exist, create it.
    if (mysqli_num_rows($check_prod_res) == 0) {

      print "<p class=\"error\">Product not found.<p>";

    } elseif (mysqli_num_rows($check_prod_res) == 1) {

      $query = "DELETE FROM products WHERE product_name='$product_name'";

      mysqli_query($dbc, $query);

      mysqli_close($dbc);

      print "<p>Product successfully deleted.<p>";
    }

  } else {

    print "<p class=\"error\">Unable to connect to database.<p>";

  }

  print "<p>Return to <a href=\"../admin.php\">Admin Menu</a></p>
        <p>Return to <a href=\"../modify_product.php\">Add/Modify Product</a></p>";
  include('../templates/footer.html');
 ?>
