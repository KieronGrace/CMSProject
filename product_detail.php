<?php
include('scripts/dbc_vars.php');
define('TITLE', 'Cupcake Love - Product Detail');
include('templates/header.php');
include('templates/menu.php');

$var = $_GET['var'];

if ($dbc = mysqli_connect($host, $user_name, $password, $database)){

  $query = "SELECT * FROM products WHERE prod_id = $var";

  if ($r = mysqli_query($dbc, $query)) {

    $row = mysqli_fetch_array($r);

    //start order form
    print "<form id=\"addToCart\" action=\"scripts/add_to_cart.php\" method=\"post\"><h1>".$row['product_name']." Cupcake</h1>";
    // product image
    print "<p><img width=\"300\" class=\"product_image\" src=\"http://kieroncodes.com/cmsproject/pics/".$row['image_file']."\" alt=\""
    .$row['product_name']."\"></p>";

    print "<p id=\"price\"> ~ $".$row['price']." ~ </p>"
    ."<p>".$row['description']."</p>"
    ."<input type=\"hidden\" name=\"product\" value=\"".$row['prod_id']."\">"
    ."<p><label for=\"qty\">Quantity: </label><input type=\"number\" id=\"qty\" name=\"qty\" value=\"1\">"
    ."<p><input type=\"submit\" name=\"add_to_cart\" value=\"Add to Cart\"></p>"
    ."</form>";

   }

   mysqli_close($dbc);
  }




include('templates/footer.html');
?>
