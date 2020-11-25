<?php
define('TITLE', 'Cupcake Love - Product Detail');
include('../templates/header.php');
include('../templates/menu.php');
include('dbc_vars.php');
//check to see if logged in
if (!empty($_SESSION)){

  //check if form was submitted
  if (isset($_POST['product'])) {

    //connect to database
    if ($dbc = mysqli_connect($host, $user_name, $password, $database)){

      //retrieve posted data
      $product = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['product'])));
      $quantity = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['qty'])));


      //check if the product is already in the cart
      $check_prod_exist = "SELECT * FROM cart WHERE prod_id='$product'";
      $check_prod_res = mysqli_query($dbc, $check_prod_exist);

      if ((mysqli_num_rows($check_prod_res) == 0) && ($quantity > 0)){

        //if it's not in the cart add it as new
        //get product data from product list
        $query = "SELECT * FROM products WHERE prod_id='$product'";
        $row = mysqli_fetch_array(mysqli_query($dbc, $query));
        $product_name = $row['product_name'];
        $image_file = $row['image_file'];
        $price = $row['price'];

        $query = "INSERT INTO cart (prod_id, product_name, image_file, price, qty)
                  VALUES ('$product','$product_name', '$image_file','$price' ,$quantity)";
        mysqli_query($dbc, $query);

      } else if ((mysqli_num_rows($check_prod_res) == 1) && ($quantity > 0)){

        //if it is in the cart, && qty > 0 update quantity to match
        $query = "UPDATE cart SET qty = $quantity WHERE prod_id = \"$product\"";
        mysqli_query($dbc, $query);

      } else if ((mysqli_num_rows($check_prod_res) == 1) && ($quantity <= 0 )) {

        //if it's in the cart and the quantity is less than or equal to 0 remove item
        $query = "DELETE FROM cart WHERE prod_id = $product";
        mysqli_query($dbc, $query);
      }

      mysqli_close($dbc);
      ob_end_clean();
      header('Location: ../cart.php');
      exit();

    } else {

      print "<p class=\"error\">Unable to connect to database.<p>";

    }

  } else {
    ob_end_clean();
    header('Location: ../shop.php');
    exit();
  }

} else {
  ob_end_clean();
  header('Location: login.php');
  exit();
}

include('../templates/footer.html');
?>
