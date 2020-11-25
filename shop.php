<?php
define('TITLE', 'Shop Home');
include('templates/header.php');
include('templates/menu.php');
include('scripts/dbc_vars.php');
?>

<h1>Cupcake Love Shop</h1>

<div id="productContainer">
  <?php

  if ($dbc = mysqli_connect($host, $user_name, $password, $database)){

    $query = 'SELECT * FROM products WHERE inactive = false';
    if ($r = mysqli_query($dbc, $query)) {

      while ($row = mysqli_fetch_array($r)){
        print "<div class=\"card\"><a href=\"product_detail.php?var=".$row['prod_id']."\">"
      // product image
       ."<img width=\"426\" src=\"http://kieroncodes.com/cmsproject/pics/".$row['image_file']."\" alt=\""
       .$row['product_name']."\" style=\"width:100%\">"
       //link to product detail page and product name and pricing
       ."<h2>".$row['product_name']."<br/> ~ $"
       .$row['price']." ~ </h2>"
      // ."<p>".$value['description']."</p>"
       //."<p><button>Add to Cart</button></p>"
       ."</a></div>";}

    }
}
   ?>
</div>

<?php
include('templates/footer.html');
?>
