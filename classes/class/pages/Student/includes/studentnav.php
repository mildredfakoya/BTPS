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
        <a class="dropdown-item" target= "_blank" href="prek.php"> Student Home Page</a>
        <a class="dropdown-item" target= "_blank"  href="http://www.blackboard.com/coursesites/?sig=WgS4LqZMI1zdrzpeMCnN8J2bMaw%3D&courseId=_905235_1&timestamp=1588537959&inviteId=BB%253FBB_23LzHX6bGZvGouI2M9yB%2Fb3TNIRK8jYPhrDVplLtgrMtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>

      </div>
    </li>

    <?php
       $decide = in_array("grade_k", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
      echo $decide;
         ?>
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade-K</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" target= "_blank" href="gradek.php"> Student Home Page</a>
      <a class="dropdown-item" target= "_blank"  href="http://www.blackboard.com/coursesites/?sig=WiQ2I84y1UkQhCUC%2BdzHrgtB14U%3D&courseId=_905236_1&timestamp=1588538246&inviteId=BB%253FBB_xjs4KjtxZMUKDJyw8tDVn7H3PyRSgJ7j6YY%252BboQSwvwtUG%252B4ivX5IA%253D%253D">Virtual Classroom</a>

    </div>
  </li>

  <?php
     $decide = in_array("grade_1", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
    echo $decide;
       ?>
  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 1</a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="grade1.php"> Student Home Page</a>
    <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>
    <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/87114057766">Join Zoom Class</a>
  </div>
</li>

<?php
   $decide = in_array("grade_2", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 2</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade2.php">Student Home Page</a>
  <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/82052708190">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_3", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 3</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade3.php"> Student Home Page</a>
  <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/84702993730">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_4", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 4</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade4.php"> Student Home Page</a>
  <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/85675057132">Join Zoom Class</a>
</div>
</li>


<?php
   $decide = in_array("grade_5", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 5</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade5.php"> Student Home Page</a>
  <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/87063460642">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_6", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 6</a>
<div class="dropdown-menu">
    <a class="dropdown-item" href="grade6.php"> Student Home Page</a>
    <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>
    <a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/81104844111">Join Zoom Class</a>
</div>
</li>


<?php
   $decide = in_array("grade_7", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 7</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade7.php"> Student Home Page</a>
  <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Virtual Classroom</a>

</div>
</li>

<?php
   $decide = in_array("grade_8", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 8</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade8.php">Student Home Page</a>
  <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Blackboard</a>
  <a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/85617723160">Join Zoom Class</a>
</div>
</li>

<?php
   $decide = in_array("grade_9", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 9</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade9.php"> Student Home Page</a>
  <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Virtual Classroom</a>

</li>

<?php
   $decide = in_array("grade_10", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 10</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade10.php"> Student Home Page</a>
  <a class="dropdown-item" target= "_blank" href="https://blackboard.coursesites.com/">Virtual Classroom</a>

</div>
</li>

<?php
   $decide = in_array("grade_11", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  echo $decide;
     ?>
<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 11</a>
<div class="dropdown-menu">
  <a class="dropdown-item" href="grade11.php"> Student Home Page</a>
  <a class="dropdown-item" target = "_blank" href="https://blackboard.coursesites.com/">Virtual Classroom</a>

</div>
</li>

        <li class ="nav-item"><a href="../../logout.php" class ="nav-link"><?php echo "[".$dec. ' ' . $decl. " Logout]";?></a></li>
      </ul>
   </div>

</nav>
