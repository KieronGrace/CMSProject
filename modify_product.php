<?php
  define('TITLE', 'Admin - Add/Modify Prod');
  include('templates/header.php');
  include('templates/menu.php');
 ?>

 <h2>Add or Update a Product Listing:</h2>
 <p>Please Note: Product name cannot be updated through this form and is used only for product lookup.</p>
 <form class="admin_forms" action="scripts/modify_product_script.php" method="post">
   <label for="product_name">Product Name: </label> <input type="text" name="product_name" id="product_name" size="20" value="" required>
   <label for="image_file">Image File: </label><input type="text" name="image_file" id="image_file" size="20" value="" required>
   <label for="description">Description: </label>
   <textarea name="description" id="description" rows="8" cols="40" maxlength="300" required></textarea>
   <label for="price">Price: </label><input type="number" step="0.01" name="price" value="" min="0" required >
   <input type="submit" name="submit" value="Submit">
 </form>

<?php

if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){
  print "<h2>Delete a Product Listing</h2>"
        ."<form class=\"admin_forms\" action=\"scripts/delete_product_script.php\" method=\"post\">"
        ."<label for=\"product_name\">Product Name: </label> <input type=\"text\" name=\"product_name\" id=\"product_name\" size=\"20\" required>"
        ."<input type=\"submit\" name=\"delete\" value=\"Delete\">"
        ."</form>";
}

  include('templates/footer.html');
 ?>
