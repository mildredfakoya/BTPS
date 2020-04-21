<?php
require 'header.php';
require 'helper.php';
$user_helper = new helper();
?>
<div class ="container">
<div class="jumbotron">
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/image1.jpg" alt="image1" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="images/image2.jpg" alt="image2" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="images/image3.jpg" alt="image3" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="images/image4.jpg" alt="image4" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="images/image4.jpg" alt="image4" width="1100" height="500">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

  </div>
  </div>
</body>
</html>
