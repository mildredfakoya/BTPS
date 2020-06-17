<?php
require_once "includes/studentheader.php";
$inputkey = "marketdayanyigba";
$blocksize = 256;
#for the logged in user
$firstname =$row['firstname'];
$lastname =$row['lastname'];
$email =$row['email'];
$firstn =new AES($firstname, $inputkey, $blocksize);
$dec =$firstn->decrypt();
$lastn =new AES($lastname, $inputkey, $blocksize);
$decl =$lastn->decrypt();
$fullname = $dec." ".$decl;
$emailn =new AES($email, $inputkey, $blocksize);
$decemail =$emailn->decrypt();


$sqlfoodmenu ="SELECT * FROM ihs_menu_uploads ORDER BY created_at DESC LIMIT 3";
$stmtfoodmenu = $user_home->runQuery($sqlfoodmenu);
$stmtfoodmenu->execute();

$sqlnewsletter ="SELECT * FROM ihs_newsletter_uploads ORDER BY created_at DESC LIMIT 3";
$stmtnewsletter = $user_home->runQuery($sqlnewsletter);
$stmtnewsletter->execute();

$sqltimetable ="SELECT * FROM ihs_timetable_uploads ORDER BY created_at DESC LIMIT 3";
$stmttimetable = $user_home->runQuery($sqltimetable);
$stmttimetable->execute();



if(isset($_GET['msg']))
	 {

					 echo "<div class='alert alert-success'>
			 <button class='close' data-dismiss='alert'>&times;</button>
			 <strong>Your email was sent</strong>
		 </div>";
		 header('refresh:3; studenthome.php');

	 }


?>

		<div class="headeranimated">
		  <h1 style="color:#ffffff">Welcome!!  <?php echo $dec." ". $decl?></h1>
		</div>

		<div class="row">
		  <div class="col-3 col-s-3 menu">
				<h2 class ="aside" style ="background-color:red">Food Menu</h2>
				  <?php
					foreach($stmtfoodmenu as $row1){
          echo "<ul>";
					echo "<li><a style = 'color:#000000' target = '_blank' href='".$row1["file"]."'>". "Click me for"."</a>"."  ". $row1["month"]."'s  menu"."</li>";
					echo "</ul>";
          }
					?>

					<h2 class ="aside" style ="background-color:green">Time table</h2>
						<?php
						foreach($stmttimetable as $rowtime){
						echo "<ul>";
						echo "<li><a style = 'color:#000000' target = '_blank' href='".$rowtime["file"]."'>". "Click me for"."</a>"."  ". $rowtime["grade"]."'s  timetable"."</li>";
						echo "</ul>";
						}
						?>
<!---
					<div class ="aside">
						<h2 class ="aside" style ="background-color:brown">Assessment / Examination</h2>
					<a class = "aside" href = "assessments.php" style ="color:white">Click me for assessment information</a>
				</div>--->
		  </div>

		  <div class="col-6 col-s-9">
				<div class ="container">
		 	<h2 class="form-signin-heading">Send Email</h2><hr />
			<p>You can only send emails to teachers on the list. To prevent abuse and unwanted security issues, your registered email is the only email you can send email messages from.
				 Select a name of a teacher on the list to send email to the teacher.You can only attach one file per email. Please give a descriptive subject to your email.</br>
			 <strong class ="error">Note: Please do not send emails for fun, send emails only if you have an official reason to do so.</strong></p>
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
																				 $sqlemail = "SELECT * FROM ihs_users where role ='Teacher'";
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

		  <div class="col-3 col-s-12">
		    <div class="aside">
		      <h2>News Letter</h2>
					<?php
					foreach($stmtnewsletter as $row2){
					echo "<ul type ='none'>";
					echo "<li><a style = 'color:#000000' target = '_blank' href='".$row2["file"]."'>". "Click me for"."</a>"."  ". $row2["monthnews"]."'s  newsletter"."</li>";
					echo "</ul>";
					}
					?>
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
			$user_home->redirect('studenthome.php?msg');
      unlink($path);
		}







 require_once 'includes/studentfooter.php';?>
