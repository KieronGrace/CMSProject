<?php
define('TITLE', 'Cupcake Love - My Cart');
include('templates/header.php');
include('templates/menu.php');
include('scripts/dbc_vars.php');
?>

  <h1>My Cart</h1>


  <div id="itemContainer">
  <h2>Items:</h2>
  <?php

  if (isset($_SESSION['username'])){

      if ($dbc = mysqli_connect($host, $user_name, $password, $database)){
        $check_cart_empty = "SELECT * FROM cart";
        $check_cart_res = mysqli_query($dbc, $check_cart_empty);

        if (mysqli_num_rows($check_cart_res) > 0){

          $query = 'SELECT * FROM cart';
          if ($r = mysqli_query($dbc, $query)) {

            $sub_total = 0;

            while ($row = mysqli_fetch_array($r)){

                //print image
                print "<div class=\"thumb\"><img width=\"300px\" class=\"cart_product_image\" src=\"http://kieroncodes.com/cmsproject/pics/".$row['image_file']."\" alt=\""
                      .$row['product_name']."\">";
                //print cost and Quantity
                print "<div class=\"product_cost\">Cost per item: $".number_format($row['price'], 2)."</div>"
                      ."<span class=\"qty\"><form action=\"scripts/add_to_cart.php\" method=\"post\">"
                      ."<input type=\"hidden\" name=\"product\" value=\"".$row['prod_id']."\">"
                      ."<label for=\"qty\">Quantity: <input type=\"number\" name=\"qty\" value=\"".$row['qty']."\" require>"
                      ."<input type=\"submit\" name=\"update_qty\" value=\"Update Quantity\"></form></span>";
                //total for item
                $itemTotal = $row['price'] * $row['qty'];
                print "<div class=\"product_total\">Item Total: $".number_format($itemTotal, 2)."</div>";
                print "</div>";

                $sub_total += $itemTotal;
              }
             }
              print "<div id=\"summary\"><p id=\"sub_total\">Sub-total: $".number_format($sub_total, 2)."</p>";

              //clear cart option
              print "<span id=\"clear_cart\"><form action=\"scripts/clear_cart.php\" method\"post\">
                    <input type=\"submit\" name=\"clear_cart\" value=\"Clear Cart\">
                    </form></span>";

              //checkout option
              print "<span id=\"checkout\"><form action=\"checkout.php\" method\"post\">
                    <input type=\"submit\"  name=\"checkout\" value=\"Checkout\">
                    </form></span></div>";
              } else {
                print "<p>Your Cart is empty</p></div>";
              }

        } else {
          print "<p class=\"error\">Unable to commect to database</p></div>";
        }

    }
  ?>
</div>
<?php
mysqli_close($dbc);
include('templates/footer.html');
?>
