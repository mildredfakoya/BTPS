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
<a class="navbar-brand" href="adminhome.php">BTPS .::. Administration</a>
<!-- Toggler/collapsibe Button-->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
</button>
<!-- Navbar links -->
 <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <?php
         $decide = in_array("classrooms", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
        echo $decide;
      ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Blackboard Classrooms</a>
      <div class="dropdown-menu">
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=WgS4LqZMI1zdrzpeMCnN8J2bMaw%3D&courseId=_905235_1&timestamp=1588537959&inviteId=BB%253FBB_23LzHX6bGZvGouI2M9yB%2Fb3TNIRK8jYPhrDVplLtgrMtUG%252B4ivX5IA%253D%253D">Pre K</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=WiQ2I84y1UkQhCUC%2BdzHrgtB14U%3D&courseId=_905236_1&timestamp=1588538246&inviteId=BB%253FBB_xjs4KjtxZMUKDJyw8tDVn7H3PyRSgJ7j6YY%252BboQSwvwtUG%252B4ivX5IA%253D%253D">Grade K</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=o7GkPUfsTfJ2m%2FdTt%2BYjM5SJrUg%3D&courseId=_905237_1&timestamp=1588538350&inviteId=BB%253FBB_0RAaBJIQQ9cZeJeIvMigcoU5VZzl%252BSKldJ3B%252BnU9e84tUG%252B4ivX5IA%253D%253D">Grade 1</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=xIKx9P289UKRwEPKTi7llNB8O6c%3D&courseId=_797059_1&timestamp=1587324171&inviteId=BB%253FBB_qs%2FmKAWONPeBMazi65eANgW6Oy0el%2FQxL2ForN8720stUG%252B4ivX5IA%253D%253D">Grade 2</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=BFCmKZHY83gM683K5BTY9yBBpYE%3D&courseId=_797060_1&timestamp=1587324325&inviteId=BB%253FBB_j2VFeZQam2t38ArLwXTnrsUno9zTQpePlLtwrRW%252B1JUtUG%252B4ivX5IA%253D%253D">Grade 3</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=zFN8apC2K%2BpWZ5K4IpMpJqp8Cf8%3D&courseId=_797061_1&timestamp=1587324389&inviteId=BB%253FBB_i%252Bx55KLOcLz8exwnj%252Bo9J0%252BdYsh30cWNzcKBa3gF17otUG%252B4ivX5IA%253D%253D">Grade 4</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=KWVgiXQL%2BBkvNB015TAglS6i%2B7k%3D&courseId=_797062_1&timestamp=1587324421&inviteId=BB%253FBB_dNgvtbgCTqZZqanbyPn0Lc90YZkhXx5%2FGEpNWBi1414tUG%252B4ivX5IA%253D%253D">Grade 5</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=Mva%2FgjuV4B%2BJhfuwQ%2FbEVZyypxk%3D&courseId=_797063_1&timestamp=1587324456&inviteId=BB%253FBB_09GKL%252Bd22N3zKG%252B4BUJGwgn0u%252BrwRIalOsMok82obTMtUG%252B4ivX5IA%253D%253D">Grade 6</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=vsd%2BFuK5AdCNdfiVC5A8DZmm4%2BU%3D&courseId=_797064_1&timestamp=1587324492&inviteId=BB%253FBB_66zgpPwVbYAGfysBAkDJVsL%252Bf6yVBqOonYfJtJ0h1ogtUG%252B4ivX5IA%253D%253D">Grade 7</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=78lE3vqvcyFPyxqqnAMjqL39R68%3D&courseId=_797058_1&timestamp=1587324284&inviteId=BB%253FBB_HPQJJtzWXp20IDajHI6fzytwJp0ymsQ2JDoPMhXF0A4tUG%252B4ivX5IA%253D%253D">Grade 8</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=ZXxI%2FS9KL8v0LOm%2FkslSInAw6BQ%3D&courseId=_797065_1&timestamp=1587324707&inviteId=BB%253FBB_adhrd2hji00R%2FF6ZcMlXo69OWbRZR6xGcYfQFhqyR54tUG%252B4ivX5IA%253D%253D">Grade 9</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=mCFO7FA30KPagdiVK0JogQqulMo%3D&courseId=_797066_1&timestamp=1587324767&inviteId=BB%253FBB_Xt7yALYIvwFt%2FZnwrvShEGPXSVFEDI2JM2TUWKHIkQAtUG%252B4ivX5IA%253D%253D">Grade 10</a>
      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=LyhS%2BHZF2WfQxE6aosnjexhp9UM%3D&courseId=_797067_1&timestamp=1587324818&inviteId=BB%253FBB_Kx%252Bi70DERUZ2ompKgmm0avSbWcR0s5IuJ6VF8u%252ByM7MtUG%252B4ivX5IA%253D%253D">Grade 11</a>
      </div>
    </li>

      <?php
    	   $decide = in_array("users_account", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
    	  echo $decide;
      ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Users & Accounts</a>
      <div class="dropdown-menu">
    <a class="dropdown-item" href="signup.php">Create New User</a>
		<a class="dropdown-item" href="manageusers.php">Manage Existing User</a>
    <a class="dropdown-item" href="users.php">View all users</a>

    </div>
    </li>

    <?php
  	   $decide = in_array("records", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  	  echo $decide;
    ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Records</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="getstudents.php">Student's Records</a>
        <a class="dropdown-item" href="#">Teacher's records</a>
      </div>
    </li>

    <?php
  	   $decide = in_array("exams", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  	  echo $decide;
    ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Exams and Promotions</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Review an Assessment</a>
        <a class="dropdown-item" href="#">Create SBA information</a>
        <a class="dropdown-item" href="#">Create Exam</a>
        <a class="dropdown-item" href="#">Create / Review / Approve Grades</a>
        <a class="dropdown-item" href="#">Promote Students</a>
        <a class="dropdown-item" href="#">Mock Examinations</a>

      </div>
    </li>

    <?php
  	   $decide = in_array("information", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  	  echo $decide;
    ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Create Information</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="information.php">Create Visitor's Information</a>
        <a class="dropdown-item" href="#">Create Admissions Information</a>
        <a class="dropdown-item" href="createsubjects.php">Create subject</a>
        <a class="dropdown-item" href="#">Create Grade sheet</a>
        <a class="dropdown-item" href="#">Create Grading Scheme</a>
        <a class="dropdown-item" href="#">Create Teachers Guidelines</a>
        <a class="dropdown-item" href="#">Create Students and Parents Brochure</a>
        <a class="dropdown-item" href="#">Create event sign-up sheet</a>
      </div>
    </li>

    <?php
  	   $decide = in_array("finance", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  	  echo $decide;
    ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Bills & Finance</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Prepare Tuition</a>
        <a class="dropdown-item" href="#">Prepare Extracurricular fees</a>
        <a class="dropdown-item" href="#">Prepare food bill</a>

      </div>
    </li>

    <?php
  	   $decide = in_array("deletes", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  	  echo $decide;
    ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Delete a file</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="deletetimetable.php">Delete timetable</a>
        <a class="dropdown-item" href="deletefoodmenu.php">Delete food menu</a>
        <a class="dropdown-item" href="deleteteachers.php">Delete teachers uploads</a>
        <a class="dropdown-item" href="deletenewsletter.php">Delete newsletter</a>
          <a class="dropdown-item" href="deleteinformation.php">Delete Visitor's information</a>
      </div>
    </li>

    <?php
  	   $decide = in_array("updates", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
  	  echo $decide;
    ?>
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Update a file</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="updateinfo.php">Update Visitors Information</a>
      </div>
    </li>

        <li class ="nav-item"><a href="../../logout.php" class ="nav-link"><?php echo "[".$dec. ' ' . $decl. " Logout]";?></a></li>
      </ul>
    </div>

</nav>
