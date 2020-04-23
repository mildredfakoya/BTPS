<?php
require_once 'includes/teacherinit.php';
require_once 'includes/teacherhead.php';
require_once 'includes/teachernav.php';
 if(isset($_GET['error']))
		{

            echo "<div class='alert alert-success'>
				<strong>Email not Found! please enter the correct email address</strong>
			</div>";

		}

		if(isset($_GET['error1']))
		{

           echo  "<div class='alert alert-success'>
				<strong>Please Fill in an Email Address</strong>
			</div>";

		}
?>

<div class="jumbotron">
<h1 style='text-align:center'>Welcome Teacher</h1>



            <div id="wrapper2">

            <div id="tabContainer">
            <div id="tabs">
                <ul>
                    <li id="tabHeader_1">Virtual Classroom</li>
                    <li id="tabHeader_2">Upload a file / Video</li>
                    <li id="tabHeader_3">View Uploads</li>
                    <li id="tabHeader_4">Create News</li>
                    <li id="tabHeader_5">Update News</li>
                    <li id="tabHeader_6">Delete Upload</li>
                </ul>
            </div>
            <div id="tabscontent">

            <nav class="tabpage" id="tabpage_1">
            <?php
            $email = $row['email'];
            $sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
      			$stmtid = $user_home->runQuery($sqlid);
      			$stmtid->bindValue(':email', $email);
      			$stmtid->execute();
      			$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
      			$list = $rowid['permissions'];
      			$permissions = explode(" ", $list);
            ?>
            <ul type ="none">
            <?php
            $decide = in_array("grade_2_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
              echo $decide;
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 2 Virtual Classroom</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=xIKx9P289UKRwEPKTi7llNB8O6c%3D&courseId=_797059_1&timestamp=1587324171&inviteId=BB%253FBB_qs%2FmKAWONPeBMazi65eANgW6Oy0el%2FQxL2ForN8720stUG%252B4ivX5IA%253D%253D">Grade 2</a>
          </div>
          </li>

        <?php $decide = in_array("grade_3_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 3 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=BFCmKZHY83gM683K5BTY9yBBpYE%3D&courseId=_797060_1&timestamp=1587324325&inviteId=BB%253FBB_j2VFeZQam2t38ArLwXTnrsUno9zTQpePlLtwrRW%252B1JUtUG%252B4ivX5IA%253D%253D">Grade 3</a>
        </div>
        </li>

        <?php $decide = in_array("grade_4_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 4 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="">Grade 4</a>
        </div>
        </li>

        <?php $decide = in_array("grade_5_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 5 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="">Grade 5</a>
        </div>
        </li>

        <?php $decide = in_array("grade_6_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 6 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="">Grade 6</a>
        </div>
        </li>

        <?php $decide = in_array("grade_7_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 7 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="">Grade 7</a>
        </div>
        </li>

        <?php $decide = in_array("grade_8_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 8 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="">Grade 8</a>
        </div>
        </li>

        <?php $decide = in_array("grade_9_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 9 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="">Grade 9</a>
        </div>
        </li>

        <?php $decide = in_array("grade_10_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 10 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="">Grade 10</a>
        </div>
        </li>

        <?php $decide = in_array("grade_11_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 11 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="">Grade 11</a>
        </div>
        </li>




        </ul>


            </nav>


            <nav class="tabpage" id="tabpage_2">
                <?php include "upload_videos.php" ?>
            </nav>

            <nav class="tabpage" id="tabpage_3">
           <?php include "uploadedfiles.php" ?>
            </nav>

            <nav class="tabpage" id="tabpage_4">
           <?php include "createnews.php" ?>
            </nav>

            <nav class="tabpage" id="tabpage_5">
           <?php include "updatenews.php" ?>
            </nav>

            <nav class="tabpage" id="tabpage_5">
           <?php include "deleteupload.php" ?>
            </nav>




</div></div></div>

</div>



<?php



require_once 'includes/teacherfooter.php'; ?>
