<?php
define('TITLE', 'Our Mission');
include('templates/header.php');
include('templates/menu.php');
?>
<div class="container">
  <h1><?php print TITLE ?></h1>
  <img class="secondaryFig" width="640" height="426" src="http://kieroncodes.com/cmsproject/pics/baby_feet.jpg" alt="Mother's hands holding baby's feet">
  <div id="home_message">
    <p>Our mission here at Cupcake Love is to be the hands and feet of Christ to our community in two ways: </p>
      <ol>
        <li>By providing a high quality product and great customer service.</li>
        <li>By partnering with local city pregnancy center to support local women through unplanned pregnancies.</li>
      </ol>
    <p>For more information on how to get involved with local city pregnancy center please visit the <a href="https://thepregnancycarecenter.org/support-the-center/">volunteer</a> page on their website.</p>
  </div>
</div>


<?php
include('templates/footer.html');
?>
