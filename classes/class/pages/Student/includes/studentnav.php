<?php
ob_start();
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
$firstname =$row['firstname'];
$lastname =$row['lastname'];
$email = $row['email'];
$firstn =new AES($firstname, $inputkey, $blocksize);
$dec =$firstn->decrypt();
$lastn =new AES($lastname, $inputkey, $blocksize);
$decl =$lastn->decrypt();

$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
?>

<body>
<!--<img class="img-responsive" src="../../../../images/logo.png" alt="Logo" id ="logo" galleryimg="no">-->
<h1 style ="text-align:center">Bonne Terre Preparatory School</h1>
<h4 style ="text-align:center"><i>Committed to providing a sound education</i></h4>
<nav class="navbar navbar-dark bg-dark">
<!-- Brand -->
<a class="navbar-brand" href="studenthome.php">BTPS .::. STUDENT</a>
<!-- Toggler/collapsibe Button-->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
</button>
<!-- Navbar links -->
 <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <?php
    	   $decide = in_array("pre_k", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
    	  echo $decide;
           ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Pre-K</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" target= "_blank" href="prek.php"> Pre-K Home Page</a>
        <a class="dropdown-item" target= "_blank"  href="http://www.blackboard.com/coursesites/?sig=tXyaRrp9qHhYKUVuZstx7emxPJM%3D&courseId=_905235_1&timestamp=1599231140&inviteId=BB%253FBB_23LzHX6bGZvGouI2M9yB%2Fb3TNIRK8jYPhrDVplLtgrMtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>

      </div>
    </li>

    <?php
       $decide = in_array("grade_k", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
      echo $decide;
         ?>
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade-K</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" target= "_blank" href="gradek.php">Grade K Home Page</a>
      <a class="dropdown-item" target= "_blank"  href="http://www.blackboard.com/coursesites/?sig=0DyAy7pbqtC5xFiKzPrQtAPFleg%3D&courseId=_905236_1&timestamp=1599231063&inviteId=BB%253FBB_xjs4KjtxZMUKDJyw8tDVn7H3PyRSgJ7j6YY%252BboQSwvwtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
      <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/89411201821">Join Zoom Class</a>
    </div>
  </li>

  <?php
     $decide = in_array("grade_1", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
    echo $decide;
       ?>
  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 1</a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="grade1.php"> Grade one Home Page</a>
    <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=NU4egjD0ManOxrHwgd8Rw%2BNalRU%3D&courseId=_905237_1&timestamp=1599229806&inviteId=BB%253FBB_0RAaBJIQQ9cZeJeIvMigcoU5VZzl%252BSKldJ3B%252BnU9e84tUG%252B4ivX5IA%253D%253D">Blackboard</a>
    <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/84861399368">Join Zoom Class</a>
  </div>
</li>

<?php
   $decide = in_array("grade_2", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 2</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade2.php">Grade two Home Page</a>
  <!--<a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>-->
  <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=wiwJGJ%2BewzackZcJ71FkU7N2CNc%3D&courseId=_797059_1&timestamp=1599227347&inviteId=BB%253FBB_qs%2FmKAWONPeBMazi65eANgW6Oy0el%2FQxL2ForN8720stUG%252B4ivX5IA%253D%253D">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/81949720715">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_3", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 3</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade3.php">Grade three Home Page</a>
  <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=YzRchIeL9LYJNkn50jU3eQ%2FsoeE%3D&courseId=_797060_1&timestamp=1599227762&inviteId=BB%253FBB_j2VFeZQam2t38ArLwXTnrsUno9zTQpePlLtwrRW%252B1JUtUG%252B4ivX5IA%253D%253D">Blackboard</a>
  <!--<a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>-->
  <a class="dropdown-item" target= "_blank" href="  https://us02web.zoom.us/j/83372807857">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_4", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 4</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade4.php">Grade four Home Page</a>
  <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=FCpxuwP7o8rxmAt90pGzXl%2BIzTI%3D&courseId=_797061_1&timestamp=1599227950&inviteId=BB%253FBB_i%252Bx55KLOcLz8exwnj%252Bo9J0%252BdYsh30cWNzcKBa3gF17otUG%252B4ivX5IA%253D%253D">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/81117345716">Join Zoom Class</a>
</div>
</li>


<?php
   $decide = in_array("grade_5", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 5</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade5.php">Grade five Home Page</a>
  <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=hF2dujsBtLpsjKDoNJMG94vLMDU%3D&courseId=_797062_1&timestamp=1599228038&inviteId=BB%253FBB_iPtmJpdgcUp%252B2gDLjyJHxkakoIZf1adpj4%2FRY11sat0tUG%252B4ivX5IA%253D%253D">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/89034591111">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_6", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 6</a>
<div class="dropdown-menu">
    <a class="dropdown-item" href="grade6.php">Grade six Home Page</a>
    <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=HaLL9rFxej53%2BJuCSzmcpouMJtU%3D&courseId=_797063_1&timestamp=1599228104&inviteId=BB%253FBB_09GKL%252Bd22N3zKG%252B4BUJGwgn0u%252BrwRIalOsMok82obTMtUG%252B4ivX5IA%253D%253D">Blackboard</a>
    <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/81417192976">Join Zoom Class</a>
</div>
</li>


<?php
   $decide = in_array("grade_7", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 7</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade7.php">Grade seven Home Page</a>
  <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=4KLitDVjZFFqpjBxu2taMXJwZtc%3D&courseId=_797064_1&timestamp=1599228160&inviteId=BB%253FBB_66zgpPwVbYAGfysBAkDJVsL%252Bf6yVBqOonYfJtJ0h1ogtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/86789487703">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_8", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 8</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade8.php">Grade eight Home Page</a>
  <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=Xe1Ib6JEJsYkJvtKP4uDI8FQs6Y%3D&courseId=_797058_1&timestamp=1599228208&inviteId=BB%253FBB_HPQJJtzWXp20IDajHI6fzytwJp0ymsQ2JDoPMhXF0A4tUG%252B4ivX5IA%253D%253D">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/86394784275">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_9", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 9</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade9.php">Grade nine Home Page</a>
  <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=IjBdie3ajDWUoK3GgMMyjPH8nio%3D&courseId=_797065_1&timestamp=1599228430&inviteId=BB%253FBB_AVGF2L7X4bl1uzatbqma6I0KqULHKY9OuwXZOrDwTBotUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/85766438467">Join Zoom Class</a>
</li>

<?php
   $decide = in_array("grade_10", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 10</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade10.php">Grade ten Home Page</a>
  <a class="dropdown-item" target= "_blank" href="http://www.blackboard.com/coursesites/?sig=bmf4CT1H1ooaL0wHGJToeULmHEg%3D&courseId=_797066_1&timestamp=1599228506&inviteId=BB%253FBB_Xt7yALYIvwFt%2FZnwrvShEGPXSVFEDI2JM2TUWKHIkQAtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/87538373793">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_11", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 11</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade11.php">Grade eleven Home Page</a>
  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=mwLIcO5lsH3W5ViAIbYE3KUC%2F%2FQ%3D&courseId=_797067_1&timestamp=1599228566&inviteId=BB%253FBB_Kx%252Bi70DERUZ2ompKgmm0avSbWcR0s5IuJ6VF8u%252ByM7MtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/87538373793">Join Zoom Class</a>
</div>
</li>

        <li class ="nav-item"><a href="../../logout.php" class ="nav-link"><?php echo "[".$dec. ' ' . $decl. " Logout]";?></a></li>
      </ul>
   </div>

</nav>
