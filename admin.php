<?php
  define('TITLE', 'Admin Menu');
  include('templates/header.php');
  include('templates/menu.php');

if($_SESSION['username'] == 'admin'){
 print "<h2>Administrator Menu</h2>

<ul id=\"admin_menu\">
  <li><a href=\"modify_product.php\">Add/Modify Product</a></li>
  <li><a href=\"modify_users.php\">Add/Modify Users</a></li>
  <li><a href=\"index.php?admin=yes\">Modify Home Message</a></li>
  <li><a href=\"about_us.php?admin=yes\">Modify About Us</a></li>
</ul>";
} elseif ($_SESSION['username'] == 'publisher') {
 print "<h2>Publisher Menu</h2>

<ul id=\"admin_menu\">
  <li><a href=\"modify_product.php\">Add/Modify Product</a></li>
  <li><a href=\"index.php?admin=yes\">Modify Home Message</a></li>
  <li><a href=\"about_us.php?admin=yes\">Modify About Us</a></li>
</ul>";
} else {

  header('Location: index.php');
}

  include('templates/footer.html');
  ?>
