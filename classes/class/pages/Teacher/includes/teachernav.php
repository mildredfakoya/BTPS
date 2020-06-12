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
$emailn =new AES($email, $inputkey, $blocksize);
$decemail =$emailn->decrypt();

$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
?>

<body>
  <h1 style ="text-align:center">Bonne Terre Preparatory School</h1>
  <h4 style ="text-align:center"><i>Committed to providing a sound education</i></h4>
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
<a class="dropdown-item" href="grade2.php">Grade 2 Student Home Page</a>
</li>

<?php
   $decide = in_array("grade_3_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 3</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade3.php">Grade 3 Student Home Page</a>
</div>
</li>

<?php
   $decide = in_array("grade_4_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 4</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade4.php">Grade 4 Student Home Page</a>
</div>
</li>


<?php
   $decide = in_array("grade_5_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 5</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade5.php">Grade 5 Student Home Page</a>
</li>

<?php
   $decide = in_array("grade_6_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 6</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade6.php">Grade 6 Student Home Page</a>
</li>


<?php
   $decide = in_array("grade_7_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 7</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade7.php">Grade 7 Student Home Page</a>
</div>
</li>

<?php
   $decide = in_array("grade_8_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 8</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade8.php">Grade 8 Student Home Page</a>
</div>
</li>

<?php
   $decide = in_array("grade_9_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 9</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade9.php">Grade 9 Student Home Page</a>
</div>
</li>

<?php
   $decide = in_array("grade_10_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 10</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade10.php">Grade 10 Student Home Page</a>
</div>
</li>

<?php
   $decide = in_array("grade_11_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 11</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="grade11.php">Grade 11 Student Home Page</a>
</div>
</li>


<?php
   $decide = in_array("assessment", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Create and Review Assessment</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="createtopics.php">Update the topics students will be assessed On</a>
<a class="dropdown-item" href="myassessments.php">My assessments</a>
<a class="dropdown-item" href="createassessment.php">Create an assessment</a>
<a class="dropdown-item" href="getassessment.php">Review Questions / Add question(s) to an assessment</a>
<a class="dropdown-item" href="#">Change an assessment setting</a>
<a class="dropdown-item" href="#">Update an assessment question</a>
<a class="dropdown-item" href="deleteassessment.php">Delete an assessment</a>
<a class="dropdown-item" href="#">Submit an assessment for Approval</a>
<a class="dropdown-item" href="#">Grade an assessment</a>



</div>
</li>

        <li class ="nav-item"><a href="../../logout.php" class ="nav-link"><?php echo "[".$dec. ' ' . $decl. " Logout]";?></a></li>
      </ul>
   </div>

</nav>
