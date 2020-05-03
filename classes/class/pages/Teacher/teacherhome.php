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
              $decide = in_array("pre_k_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                echo $decide;
              ?>
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Pre K Virtual Classroom</a>
              <div class="dropdown-menu">
              <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=WgS4LqZMI1zdrzpeMCnN8J2bMaw%3D&courseId=_905235_1&timestamp=1588537959&inviteId=BB%253FBB_23LzHX6bGZvGouI2M9yB%2Fb3TNIRK8jYPhrDVplLtgrMtUG%252B4ivX5IA%253D%253D">Pre K</a>
            </div>
            </li>


            <?php
            $decide = in_array("garde_k_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
              echo $decide;
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade K Virtual Classroom</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=WiQ2I84y1UkQhCUC%2BdzHrgtB14U%3D&courseId=_905236_1&timestamp=1588538246&inviteId=BB%253FBB_xjs4KjtxZMUKDJyw8tDVn7H3PyRSgJ7j6YY%252BboQSwvwtUG%252B4ivX5IA%253D%253D">Grade K</a>
          </div>
          </li>


          <?php
          $decide = in_array("garde_1_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
            echo $decide;
          ?>
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 1 Virtual Classroom</a>
          <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=o7GkPUfsTfJ2m%2FdTt%2BYjM5SJrUg%3D&courseId=_905237_1&timestamp=1588538350&inviteId=BB%253FBB_0RAaBJIQQ9cZeJeIvMigcoU5VZzl%252BSKldJ3B%252BnU9e84tUG%252B4ivX5IA%253D%253D">Grade 1</a>
        </div>
        </li>

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
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=zFN8apC2K%2BpWZ5K4IpMpJqp8Cf8%3D&courseId=_797061_1&timestamp=1587324389&inviteId=BB%253FBB_i%252Bx55KLOcLz8exwnj%252Bo9J0%252BdYsh30cWNzcKBa3gF17otUG%252B4ivX5IA%253D%253D">Grade 4</a>
        </div>
        </li>

        <?php $decide = in_array("grade_5_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 5 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=KWVgiXQL%2BBkvNB015TAglS6i%2B7k%3D&courseId=_797062_1&timestamp=1587324421&inviteId=BB%253FBB_dNgvtbgCTqZZqanbyPn0Lc90YZkhXx5%2FGEpNWBi1414tUG%252B4ivX5IA%253D%253D">Grade 5</a>
        </div>
        </li>

        <?php $decide = in_array("grade_6_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 6 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=Mva%2FgjuV4B%2BJhfuwQ%2FbEVZyypxk%3D&courseId=_797063_1&timestamp=1587324456&inviteId=BB%253FBB_09GKL%252Bd22N3zKG%252B4BUJGwgn0u%252BrwRIalOsMok82obTMtUG%252B4ivX5IA%253D%253D">Grade 6</a>
        </div>
        </li>

        <?php $decide = in_array("grade_7_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 7 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=vsd%2BFuK5AdCNdfiVC5A8DZmm4%2BU%3D&courseId=_797064_1&timestamp=1587324492&inviteId=BB%253FBB_66zgpPwVbYAGfysBAkDJVsL%252Bf6yVBqOonYfJtJ0h1ogtUG%252B4ivX5IA%253D%253D">Grade 7</a>
        </div>
        </li>

        <?php $decide = in_array("grade_8_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 8 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=78lE3vqvcyFPyxqqnAMjqL39R68%3D&courseId=_797058_1&timestamp=1587324284&inviteId=BB%253FBB_HPQJJtzWXp20IDajHI6fzytwJp0ymsQ2JDoPMhXF0A4tUG%252B4ivX5IA%253D%253D">Grade 8</a>
        </div>
        </li>

        <?php $decide = in_array("grade_9_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 9 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=ZXxI%2FS9KL8v0LOm%2FkslSInAw6BQ%3D&courseId=_797065_1&timestamp=1587324707&inviteId=BB%253FBB_adhrd2hji00R%2FF6ZcMlXo69OWbRZR6xGcYfQFhqyR54tUG%252B4ivX5IA%253D%253D">Grade 9</a>
        </div>
        </li>

        <?php $decide = in_array("grade_10_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 10 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=mCFO7FA30KPagdiVK0JogQqulMo%3D&courseId=_797066_1&timestamp=1587324767&inviteId=BB%253FBB_Xt7yALYIvwFt%2FZnwrvShEGPXSVFEDI2JM2TUWKHIkQAtUG%252B4ivX5IA%253D%253D">Grade 10</a>
        </div>
        </li>

        <?php $decide = in_array("grade_11_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
          echo $decide;
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Grade 11 Virtual Classroom</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=LyhS%2BHZF2WfQxE6aosnjexhp9UM%3D&courseId=_797067_1&timestamp=1587324818&inviteId=BB%253FBB_Kx%252Bi70DERUZ2ompKgmm0avSbWcR0s5IuJ6VF8u%252ByM7MtUG%252B4ivX5IA%253D%253D">Grade 11</a>
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

            <nav class="tabpage" id="tabpage_6">
           <?php include "deleteupload.php" ?>
            </nav>




</div></div></div>

</div>



<?php



require_once 'includes/teacherfooter.php'; ?>
