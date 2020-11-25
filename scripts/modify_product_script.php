<?php
  define('TITLE', 'Confirm');
  include('dbc_vars.php');
  include('../templates/header.php');
  include('../templates/menu.php');

  if ($dbc = mysqli_connect($host, $user_name, $password, $database)){
    //retrieve form data
    $product_name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['product_name'])));
    $image_file = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['image_file'])));
    $description = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['description'])));
    $price = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['price'])));

    //check it the product exists
    $check_prod_exist = "SELECT * FROM products WHERE product_name='$product_name'";
    $check_prod_res = mysqli_query($dbc, $check_prod_exist);

    //if product does not exist, create it.
    if (mysqli_num_rows($check_prod_res) == 0) {
      $query = "INSERT INTO products (product_name, image_file, description, price)
                VALUES ('$product_name', '$image_file', '$description', '$price')";

      mysqli_query($dbc, $query);

      mysqli_close($dbc);

      print "<p>Product added successfully.<p>";

    } elseif (mysqli_num_rows($check_prod_res) == 1) {

      $query = "UPDATE products
                SET ('image_file' = '$image_file', 'description' = '$description', 'price' = '$price')
                WHERE 'product_name' = '$product_name'";

      mysqli_query($dbc, $query);

      mysqli_close($dbc);

      print "<p>Product updated successfully.<p>";
    }

  } else {

    print "<p class=\"error\">Unable to connect to database.<p>";

  }

  print "<p>Return to <a href=\"../admin.php\">Admin Menu</a></p>
        <p>Return to <a href=\"../modify_product.php\">Add/Modify Product</a></p>";

  include('../templates/footer.html')
 ?>
