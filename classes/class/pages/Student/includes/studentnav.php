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
<img class="img-responsive" src="../../../../images/logo.png" alt="Logo" id ="logo" galleryimg="no">
<nav class="navbar navbar-dark bg-dark">
<!-- Brand -->
<a class="navbar-brand" href="teacherhome.php">BTPS .::. STUDENT</a>
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
      <a class="dropdown-item" href="#">Grades</a>
      <a class="dropdown-item" href="#">Videos</a>
      </div>
    </li>

    <?php
       $decide = in_array("grade_k", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
      echo $decide;
         ?>
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade-K</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Grades</a>
      <a class="dropdown-item" href="#">Videos</a>
    </div>
  </li>

  <?php
     $decide = in_array("grade_1", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
    echo $decide;
       ?>
  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 1</a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Grades</a>
    <a class="dropdown-item" href="#">Videos</a>
  </div>
</li>

<?php
   $decide = in_array("grade_2", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 2</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=xIKx9P289UKRwEPKTi7llNB8O6c%3D&courseId=_797059_1&timestamp=1587324171&inviteId=BB%253FBB_qs%2FmKAWONPeBMazi65eANgW6Oy0el%2FQxL2ForN8720stUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>

<?php
   $decide = in_array("grade_3", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 3</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=BFCmKZHY83gM683K5BTY9yBBpYE%3D&courseId=_797060_1&timestamp=1587324325&inviteId=BB%253FBB_j2VFeZQam2t38ArLwXTnrsUno9zTQpePlLtwrRW%252B1JUtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>

<?php
   $decide = in_array("grade_4", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 4</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=zFN8apC2K%2BpWZ5K4IpMpJqp8Cf8%3D&courseId=_797061_1&timestamp=1587324389&inviteId=BB%253FBB_i%252Bx55KLOcLz8exwnj%252Bo9J0%252BdYsh30cWNzcKBa3gF17otUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>


<?php
   $decide = in_array("grade_5", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 5</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=KWVgiXQL%2BBkvNB015TAglS6i%2B7k%3D&courseId=_797062_1&timestamp=1587324421&inviteId=BB%253FBB_dNgvtbgCTqZZqanbyPn0Lc90YZkhXx5%2FGEpNWBi1414tUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>

<?php
   $decide = in_array("grade_6", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 6</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=Mva%2FgjuV4B%2BJhfuwQ%2FbEVZyypxk%3D&courseId=_797063_1&timestamp=1587324456&inviteId=BB%253FBB_09GKL%252Bd22N3zKG%252B4BUJGwgn0u%252BrwRIalOsMok82obTMtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>


<?php
   $decide = in_array("grade_7", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 7</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=vsd%2BFuK5AdCNdfiVC5A8DZmm4%2BU%3D&courseId=_797064_1&timestamp=1587324492&inviteId=BB%253FBB_66zgpPwVbYAGfysBAkDJVsL%252Bf6yVBqOonYfJtJ0h1ogtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>

<?php
   $decide = in_array("grade_8", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 8</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=78lE3vqvcyFPyxqqnAMjqL39R68%3D&courseId=_797058_1&timestamp=1587324284&inviteId=BB%253FBB_HPQJJtzWXp20IDajHI6fzytwJp0ymsQ2JDoPMhXF0A4tUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>

<?php
   $decide = in_array("grade_9", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 9</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=ZXxI%2FS9KL8v0LOm%2FkslSInAw6BQ%3D&courseId=_797065_1&timestamp=1587324707&inviteId=BB%253FBB_adhrd2hji00R%2FF6ZcMlXo69OWbRZR6xGcYfQFhqyR54tUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</li>

<?php
   $decide = in_array("grade_10", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 10</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="http://www.blackboard.com/coursesites/?sig=mCFO7FA30KPagdiVK0JogQqulMo%3D&courseId=_797066_1&timestamp=1587324767&inviteId=BB%253FBB_Xt7yALYIvwFt%2FZnwrvShEGPXSVFEDI2JM2TUWKHIkQAtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>

<?php
   $decide = in_array("grade_11", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 11</a>
<div class="dropdown-menu">
  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=LyhS%2BHZF2WfQxE6aosnjexhp9UM%3D&courseId=_797067_1&timestamp=1587324818&inviteId=BB%253FBB_Kx%252Bi70DERUZ2ompKgmm0avSbWcR0s5IuJ6VF8u%252ByM7MtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>
  <a class="dropdown-item" href="#">Grades</a>
  <a class="dropdown-item" href="#">Videos</a>
</div>
</li>

        <li class ="nav-item"><a href="../../logout.php" class ="nav-link"><?php echo "[".$dec. ' ' . $decl. " Logout]";?></a></li>
      </ul>
   </div>

</nav>
