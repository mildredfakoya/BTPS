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




    if(isset($_GET['msg']))
    	 {

    					 echo "<div class='alert alert-success'>
    			 <button class='close' data-dismiss='alert'>&times;</button>
    			 <strong>Your email was sent</strong>
    		 </div>";
    		 header('refresh:3; teacherhome.php');

    	 }

?>


		<div class="headeranimated">
		  <h1>Welcome!!  <?php echo $dec." ". $decl?></h1>
      <?php $fullname = $dec." ".$decl;?>
		</div>

		<div class="row">
		  <div class="col-6 col-s-3 menu">
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
                      <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Pre K Virtual Classroom</a>
                      <div class="dropdown-menu">
                      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=tXyaRrp9qHhYKUVuZstx7emxPJM%3D&courseId=_905235_1&timestamp=1599231140&inviteId=BB%253FBB_23LzHX6bGZvGouI2M9yB%2Fb3TNIRK8jYPhrDVplLtgrMtUG%252B4ivX5IA%253D%253D">Pre K</a>
                      <a class="dropdown-item" target = "_blank" href="chatroompk.php">Chat Room and Discussion Forum</a>
                    </div>
                    </li>


                    <?php
                    $decide = in_array("grade_k_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                      echo $decide;
                    ?>
                    <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade K Virtual Classroom</a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=0DyAy7pbqtC5xFiKzPrQtAPFleg%3D&courseId=_905236_1&timestamp=1599231063&inviteId=BB%253FBB_xjs4KjtxZMUKDJyw8tDVn7H3PyRSgJ7j6YY%252BboQSwvwtUG%252B4ivX5IA%253D%253D">Grade K</a>
                    <a class="dropdown-item" target = "_blank" href="chatroomk.php">Chat Room and Discussion Forum</a>
                  </div>
                  </li>


                  <?php
                  $decide = in_array("grade_1_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                    echo $decide;
                  ?>
                  <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 1 Virtual Classroom</a>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=NU4egjD0ManOxrHwgd8Rw%2BNalRU%3D&courseId=_905237_1&timestamp=1599229806&inviteId=BB%253FBB_0RAaBJIQQ9cZeJeIvMigcoU5VZzl%252BSKldJ3B%252BnU9e84tUG%252B4ivX5IA%253D%253D">Grade 1 - Blackboard</a>
                  <!--<a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/87114057766">Start Grade 1 - Zoom Class</a>-->
                  <a class="dropdown-item" target = "_blank" href="chatroom1.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                    <?php
                    $decide = in_array("grade_2_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                      echo $decide;
                    ?>
                    <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 2 Virtual Classroom</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=wiwJGJ%2BewzackZcJ71FkU7N2CNc%3D&courseId=_797059_1&timestamp=1599227347&inviteId=BB%253FBB_qs%2FmKAWONPeBMazi65eANgW6Oy0el%2FQxL2ForN8720stUG%252B4ivX5IA%253D%253D">Grade 2 - Blackboard</a>
                      <!--<a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/82052708190">Start Grade 2 - Zoom Class</a>-->
                      <a class="dropdown-item" target = "_blank" href="chatroom2.php">Chat Room and Discussion Forum</a>
                    </div>
                  </li>

                <?php $decide = in_array("grade_3_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 3 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=YzRchIeL9LYJNkn50jU3eQ%2FsoeE%3D&courseId=_797060_1&timestamp=1599227762&inviteId=BB%253FBB_j2VFeZQam2t38ArLwXTnrsUno9zTQpePlLtwrRW%252B1JUtUG%252B4ivX5IA%253D%253D">Grade 3 - Blackboard</a>
                  <!--<a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/84702993730">Start Grade 3 - Zoom Class</a>-->
                  <a class="dropdown-item" target = "_blank" href="chatroom3.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                <?php $decide = in_array("grade_4_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 4 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=FCpxuwP7o8rxmAt90pGzXl%2BIzTI%3D&courseId=_797061_1&timestamp=1599227950&inviteId=BB%253FBB_i%252Bx55KLOcLz8exwnj%252Bo9J0%252BdYsh30cWNzcKBa3gF17otUG%252B4ivX5IA%253D%253D">Grade 4 - Blackboard</a>
                  <!--<a class="dropdown-item" target= "_blank"  href="https://us02web.zoom.us/j/85675057132">Start Grade 4 - Zoom Class</a>-->
                  <a class="dropdown-item" target = "_blank" href="chatroom4.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                <?php $decide = in_array("grade_5_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 5 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=hF2dujsBtLpsjKDoNJMG94vLMDU%3D&courseId=_797062_1&timestamp=1599228038&inviteId=BB%253FBB_iPtmJpdgcUp%252B2gDLjyJHxkakoIZf1adpj4%2FRY11sat0tUG%252B4ivX5IA%253D%253D">Grade 5 - Blackboard</a>
                  <!--<a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/87063460642">Start Grade 5 - Zoom Class</a>-->
                  <a class="dropdown-item" target = "_blank" href="chatroom5.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                <?php $decide = in_array("grade_6_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 6 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=HaLL9rFxej53%2BJuCSzmcpouMJtU%3D&courseId=_797063_1&timestamp=1599228104&inviteId=BB%253FBB_09GKL%252Bd22N3zKG%252B4BUJGwgn0u%252BrwRIalOsMok82obTMtUG%252B4ivX5IA%253D%253D">Grade 6 - Blackboard</a>
                  <!--<a class="dropdown-item" target= "_blank" href="https://us02web.zoom.us/j/81104844111">Start Grade 6 - Zoom Class</a>-->
                  <a class="dropdown-item" target = "_blank" href="chatroom6.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                <?php $decide = in_array("grade_7_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 7 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=4KLitDVjZFFqpjBxu2taMXJwZtc%3D&courseId=_797064_1&timestamp=1599228160&inviteId=BB%253FBB_66zgpPwVbYAGfysBAkDJVsL%252Bf6yVBqOonYfJtJ0h1ogtUG%252B4ivX5IA%253D%253D">Grade 7</a>
                  <a class="dropdown-item" target = "_blank" href="chatroom7.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                <?php $decide = in_array("grade_8_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 8 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=Xe1Ib6JEJsYkJvtKP4uDI8FQs6Y%3D&courseId=_797058_1&timestamp=1599228208&inviteId=BB%253FBB_HPQJJtzWXp20IDajHI6fzytwJp0ymsQ2JDoPMhXF0A4tUG%252B4ivX5IA%253D%253D">Grade 8 - Blackboard</a>
                  <!--<a class="dropdown-item" target= "_blank" href=" https://us02web.zoom.us/j/85617723160">Start Grade 8 - Zoom Class</a>-->
                  <a class="dropdown-item" target = "_blank" href="chatroom8.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                <?php $decide = in_array("grade_9_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 9 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=IjBdie3ajDWUoK3GgMMyjPH8nio%3D&courseId=_797065_1&timestamp=1599228430&inviteId=BB%253FBB_AVGF2L7X4bl1uzatbqma6I0KqULHKY9OuwXZOrDwTBotUG%252B4ivX5IA%253D%253D">Grade 9</a>
                  <a class="dropdown-item" target = "_blank" href="chatroom9.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                <?php $decide = in_array("grade_10_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 10 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=bmf4CT1H1ooaL0wHGJToeULmHEg%3D&courseId=_797066_1&timestamp=1599228506&inviteId=BB%253FBB_Xt7yALYIvwFt%2FZnwrvShEGPXSVFEDI2JM2TUWKHIkQAtUG%252B4ivX5IA%253D%253D">Grade 10</a>
                  <a class="dropdown-item" target = "_blank" href="chatroom10.php">Chat Room and Discussion Forum</a>
                </div>
                </li>

                <?php $decide = in_array("grade_11_teacher", $permissions)?'<li class="nav-item dropdown">':'<li class="nav-item dropdown hidden">';
                  echo $decide;
                ?>
                <a class="nav-link dropdown-toggle" style ="color:White; font-size:large" href="#" id="navbardrop" data-toggle="dropdown">Grade 11 Virtual Classroom</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" target = "_blank" href="http://www.blackboard.com/coursesites/?sig=mwLIcO5lsH3W5ViAIbYE3KUC%2F%2FQ%3D&courseId=_797067_1&timestamp=1599228566&inviteId=BB%253FBB_Kx%252Bi70DERUZ2ompKgmm0avSbWcR0s5IuJ6VF8u%252ByM7MtUG%252B4ivX5IA%253D%253D">Grade 11</a>
                  <a class="dropdown-item" target = "_blank" href="chatroom11.php">Chat Room and Discussion Forum</a>
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
		  </div>

		  <div class="col-6 col-s-9">
			<div class ="container">
		 	<h2 class="form-signin-heading">Send Email</h2><hr />
				<form  id ="formnews" method="post" enctype="multipart/form-data">
        <div class ="row">
					<div class ="col-5">From:</div>
					<div class ="col-7 columnspacer"><input type ="text" name ="from" value ="<?php echo $decemail?>" readonly/></div>
					</div>

         <div class ="textspacer"></div>
					<div class ="row">
						<div class ="col-5">To:</div>
						<div class ="col-7 columnspacer">

						<select name ="to">
						 <option selected disabled>[Select email]</option>
																				 <?php
																				 $sqlemail = "SELECT * FROM ihs_users where role ='Teacher' OR role ='Student'";
																				 $stmtemail = $user_home->runQuery($sqlemail);
																				 $stmtemail->execute();
																				 while ($rowemail = $stmtemail->fetch(PDO::FETCH_ASSOC)) {
																					 $optionemail =$rowemail['email'];
																					 $optionemailn =new AES($optionemail, $inputkey, $blocksize);
																					 $optionemaildec =$optionemailn->decrypt();
																					 $optionfirstname =$rowemail['firstname'];
																					 $optionfirstn=new AES($optionfirstname, $inputkey, $blocksize);
																					 $optionfirstdec =$optionfirstn->decrypt();
																					 $optionlastname =$rowemail['lastname'];
																					 $optionlastn=new AES($optionlastname, $inputkey, $blocksize);
																					 $optionlastdec =$optionlastn->decrypt();
																						 echo "<option value='" . $optionemaildec . "'>" . $optionfirstdec . " ". $optionlastdec."</option>";
																				 }
																				 ?>
									</select>



						</div>
						</div>


						<div class ="textspacer"></div>
					 	<div class ="row">
					 		<div class ="col-5">Subject:</div>
					 		<div class ="col-7 columnspacer"><input type="text" class="input-block-level" placeholder="Subject" name="subject" required /></div>
					 		</div>


					<div class ="textspacer"></div>
					<div class ="row">
					<div class ="col-5">Message:</div>
					<div class ="col-7 columnspacer"><textarea  class="input-block-level" name ="message" rows = 20 cols =50></textarea></div>
					</div>

					<div class ="textspacer"></div>
					<div class ="row">
					<div class ="col-5">Attach files</div>
					<div class ="col-7 columnspacer"><input type="file" class="input-block-level" name="file" accept =".doc, .docx, .pdf, .jpg, .jpeg, .png"></div>
					</div>



			<hr />
				<button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Send</button>

			</form>
		</div>
		  </div>

		</div>
<?php



if(isset($_POST['btn-submit']))
{
    $from =!empty($_POST['from']) ? $helper->test_input($_POST['from']) : null;
    $to =!empty($_POST['to']) ? $helper->test_input($_POST['to']) : null;
	  $message =!empty($_POST['message']) ? $helper->test_input($_POST['message']) : null;
		$subject =!empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
    $file =!empty($_POST['file']) ? $helper->test_input($_POST['file']) : null;

		$path = '../../attachments/'.$_FILES['file']['name'];

		move_uploaded_file($_FILES['file']['tmp_name'], $path);

	  	$user_home->send_mail2($to, $from, $subject, $message, $fullname, $path);
			$user_home->redirect('teacherhome.php?msg');
      unlink($path);
		}


require_once 'includes/teacherfooter.php'; ?>
