<?php
define('TITLE', 'Checkout');
include('scripts/dbc_vars.php');
include('templates/header.php');
include('templates/menu.php');

define('TAX_RATE', 0.085);


 if (!isset($_SESSION['username'])) {
   ob_end_clean();
   header('Location: scripts/login.php');
   exit();
 }
?>


<div class="col-25" id="cart_summary">
  <div class="container">
  <h3><i class="fa fa-shopping-cart"></i> Cart Summary: </h3>
  <div class="cart_sum_body">
    <?php
      if ($dbc = mysqli_connect($host, $user_name, $password, $database)){
        $check_cart_empty = "SELECT * FROM cart";
        $check_cart_res = mysqli_query($dbc, $check_cart_empty);

        if (mysqli_num_rows($check_cart_res) > 0){

          $query = 'SELECT * FROM cart';
          if ($r = mysqli_query($dbc, $query)) {

            $sub_total = 0;

            while ($row = mysqli_fetch_array($r)){

              $itemTotal = $row['qty'] * $row['price'];

              print "<span class=\"title\">".$row['product_name'].
                    "</span></span class=\"cost\">$ "
                    .number_format($itemTotal, 2)
                    ."</span>";

              $sub_total += $itemTotal;
            }
          }
        }
      }
     ?>
  </div>
  <div class="totals">
    <label for="subtotal">Sub-total: </label><span id="subtotal" class="price">$<?php print number_format($sub_total, 2) ?></span>
    <label for="tax">Tax: </label><span id="tax" class="price">$<?php $tax = $sub_total * TAX_RATE; print number_format($tax, 2); ?></span>
    <label for="total_cost">Total: </label><span id="total_cost" class="price">$<?php $total = $sub_total + $tax; print number_format($total, 2); ?></span>
</div>
</div>
</div>

<div class="row">
  <div class="col-75" id="main_container">

    <div class="container">
    <form class="checkout_form" action="checkout_confirm.php" method="post">

      <div class="row">
        <div class="col-50">
          <h3>Billing Address</h3>
            <label for="full_name">Full Name: </label>
            <input type="text" name="full_name" size="20" placeholder="John Doe" required/>
            <label for="email">Email Address: </label>
            <input type="email" name="email" size="20" placeholder="email@domain.com" required>
            <label for="address">Street Address: </label>
            <input type="text" name="address" size="40" placeholder="123 Imaginary Lane" required>
            <label for="city">City: </label>
            <input type="text" name="city" size="20" placeholder="Chicago" required>

          <div class="row">
            <div class="col-50">
              <label for="state">State: </label>
              <input type="text" name="state" size="2" placeholder="IL" required>
            </div>
            <div class="col-50">
              <label for="zip">Zip Code: </label>
              <input type="text" name="zip" size="10" placeholder="12345-1234" required>
            </div>
          </div>
        </div>

      <div class="col-50">
        <h3>Payment</h3>
        <label for="accepted_payment">Accepted Cards</label>
        <div class="icon-container">
          <i class="fab fa-cc-visa" style="color:navy;"> </i>
          <i class="fab fa-cc-amex" style="color:blue;"> </i>
          <i class="fab fa-cc-mastercard" style="color:red;"> </i>
          <i class="fab fa-cc-discover" style="color:orange;"> </i>
        </div>
        <label for="name_on_card">Name on Card: </label>
        <input type="text" name="name_on_card" placeholder="John Doe" size="20" required>
        <label for="card_number">Credit Card Number: </label>
        <input type="text" name="card_number" placeholder="111-222-333-444" size="20" required>
        <label for="exp_month">Expiration Month: </label>
        <input type="text" name="exp_month" placeholder="January" size="20" required>

        <div class="row">
          <div class="col-50">
            <label for="exp_year">Expiration Year: </label>
            <input type="text" name="exp_year" placeholder="2020" size="4" required>
          </div>
          <div class="col-50">
            <label for="cvv">CVV: </label>
            <input type="text" name="cvv" size="3" placeholder="123" required>
          </div>
        </div>
      </div>

      <input class="btn" type="submit" name="continue" value="Continue to Checkout">
    </form>
  </div>
</div>



</div>

<?php
include('templates/footer.html');
?>
