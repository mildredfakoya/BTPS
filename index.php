<?php
require 'header.php';
require 'helper.php';
$user_helper = new helper();
?>
<div class ="jumbotron">
<p>We welcome you to BONNE TERRE PREPARATORY SCHOOL LTD which was established in September 1992. This school provides education for children of ages 2 1/2 years to 16 years.<br/>
Students of ages 2 1/2 to 4 attend Pre- Kindergarten. The elementary section is from Kindergarten (4 turning 5 no later than February) to Grade 6.<br/>
The high school section is from 11+ years old. Our high school which commenced Sept. 2007 presently comprises Grades 7 to 11 (Forms 1 – 5).</br>
Students of Grade 2 & Grade 4 write the Minimum Standards Test set by the Ministry of Education. Grade 6 students write the Common Entrance Examination for entry into secondary school. High school students will take the CSEC Examinations.
<h1>We are committed not only to academic achievement but also to physical & emotional development</h1>
</p>


<div class ='outer'>
<div class ='heading'><h3 style='color:#0000ff'>Third term 2020 Welcome address</h3></div>
<div class ='container'><video width="1100" height="500" controls autoplay>
  <source src="images/welcome.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
  </video>
</div></div>

<div id="demo" class="carousel slide outer" data-ride="carousel">
<div class ='heading'><h3 style='color:#0000ff'>Image Gallery</h3></div>
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
</body>
</html>
