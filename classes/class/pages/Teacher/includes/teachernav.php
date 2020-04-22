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
<a class="navbar-brand" href="teacherhome.php">BTPS .::. TEACHER</a>
<!-- Toggler/collapsibe Button-->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
</button>
<!-- Navbar links -->
 <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <?php
    	   $decide = in_array("pre_k_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
    	  echo $decide;
           ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Pre-K</a>
      <div class="dropdown-menu">
      <a class="dropdown-item" href="prek.php">Pre-K Student Home page</a>
      </div>
    </li>

    <?php
       $decide = in_array("grade_k_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
      echo $decide;
         ?>
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade-K</a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="gradek.php">Grade K Student Home page</a>
    </div>
  </li>

  <?php
     $decide = in_array("grade_1_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
    echo $decide;
       ?>
  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 1</a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="grade1.php">Grade 1 Student Home Page</a>
  </div>
</li>

<?php
   $decide = in_array("grade_2_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 2</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 2 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a></div>
</li>

<?php
   $decide = in_array("grade_3_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 3</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 3 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>

<?php
   $decide = in_array("grade_4_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 4</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 4 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>


<?php
   $decide = in_array("grade_5_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 5</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 5 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>

<?php
   $decide = in_array("grade_6_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 6</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 6 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>


<?php
   $decide = in_array("grade_7_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 7</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 7 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>

<?php
   $decide = in_array("grade_8_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 8</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 8 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>

<?php
   $decide = in_array("grade_9_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 9</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 9 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>

<?php
   $decide = in_array("grade_10_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 10</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 10 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>

<?php
   $decide = in_array("grade_11_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 11</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Grade 11 Student Information</a>
  <a class="dropdown-item" href="#">Update Student Grades</a>
  <a class="dropdown-item" href="#">My Subjects</a>
</div>
</li>

        <li class ="nav-item"><a href="../../logout.php" class ="nav-link"><?php echo "[".$dec. ' ' . $decl. " Logout]";?></a></li>
      </ul>
   </div>

</nav>
