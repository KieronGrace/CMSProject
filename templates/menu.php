      <nav class="nav">
        <ul>
          <li><a href="http://kieroncodes.com/cmsproject/about_us.php">About Us</a></li>
          <li><a href="http://kieroncodes.com/cmsproject/mission.php">Mission</a></li>
          <li><a href="http://kieroncodes.com/cmsproject/shop.php">Shop</a></li>
          <?php
          if (!isset($_SESSION['username'])) {
            print "<li><a href=\"http://kieroncodes.com/cmsproject/register.php\">Register</a></li>";
          }
          if (isset($_SESSION['username'])){
              if ($_SESSION['username'] == 'admin' || $_SESSION['username'] == 'publisher'){
              print "<li><a href=\"http://kieroncodes.com/cmsproject/admin.php\">Administrator Menu</a></li>";
            }
          }
          ?>
        </ul>
      </nav>
  </header>

  <main class="siteContent">
  <!-- BEGIN CHANGEABLE CONTENT.-->
