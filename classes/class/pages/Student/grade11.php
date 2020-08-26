<?php
require_once 'includes/studentinit.php';
require_once 'includes/studenthead.php';
require_once 'includes/studentnav.php';
$email = $row['email'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];

$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("grade_11", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{


require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
$class = 'grade_11';
$grade='grade11';
$firstn =new AES($firstname, $inputkey, $blocksize);
$dec =$firstn->decrypt();
$lastn =new AES($lastname, $inputkey, $blocksize);
$decl =$lastn->decrypt();

$sql2a ="SELECT * FROM ihs_news WHERE class= :class OR class ='general' ORDER BY created_at DESC";
$stmt2a = $user_home->runQuery($sql2a);
$stmt2a->bindValue(':class', $class);
$stmt2a->execute();

$sqluploads ="SELECT * FROM ihs_video_uploads WHERE grade= :grade OR grade ='general' ORDER BY created_at DESC";
$stmtuploads = $user_home->runQuery($sqluploads);
$stmtuploads->bindValue(':grade', $grade);
$stmtuploads->execute();
?>
<div class ="row">
	<div class ="col-5 container">
		<div>
			<h5 class ="header">Click for: <a href ='grade11assignments.php'>Assignments & Projects</a></h5>
			<h5 class ="header">Click for: <a href ='grade11continous.php'>Continous Assessments</a></h5>
			<h5 class ="header">Click for: <a href ='grade11exams.php'>Examination</a></h5>
			<h5 class ="header">Click for: <a href ='feedback11.php'>Grades and Feed back</a></h5>
			<h5 class ="header">Click for: <a href ='studyguide11.php'>Study Guide</a></h5>
		</div>
<h5 class ="header">Class news</h5>
<?php

#get every news for the class of the email
foreach($stmt2a as $row1){
	$classfirstname =$row1['created_by_firstname'];
	$classlastname = $row1['created_by_lastname'];
	$classemail = $row1['email'];
	$encemail = new AES($classemail, $inputkey, $blocksize);
	$encfirst = new AES($classfirstname, $inputkey, $blocksize);
	$enclast = new AES($classlastname, $inputkey, $blocksize);
	$decfirst = $encfirst->decrypt();
	$decemail = $encemail->decrypt();
	$declast = $enclast->decrypt();
?>
<div class ="outer">
<div class ='heading'><h5>Class News <?php echo $row1['created_at']. "---". strtoupper($row1['topic'])?></h5></div>
<div class ='container'><p><?php echo $row1['details']?></p>
<p><?php echo $decfirst." ".$declast." "?></p>
<p><?php echo $decemail ?></p></div>
</div>
<?php
}
$sqltimetable ="SELECT * FROM ihs_timetable_uploads WHERE grade = 'grade11' ORDER BY created_at DESC LIMIT 1";
$stmttimetable = $user_home->runQuery($sqltimetable);
$stmttimetable->execute();
$rowtable = $stmttimetable->fetch(PDO::FETCH_ASSOC);
?>



</div>
<div class ='col-7 columnspacer'>
<h2 class ="headeranimated"><i>Welcome!! <?php echo $dec." ".$decl ?></i></h2>
<div class ="container">
<h5 class ="header">
	Click for <a target = '_blank' href='<?php echo $rowtable["file"]?>'> time table </a>
</h5>
</div>
<div class ="jumbotron">
<div class ="outer">
<div class ="heading">File / Video Uploads</div>
<div class ="container">
<?php
	echo "<table><thead><tr>";
	echo "<th>Date uploaded</th>
	    <th>Title</th>
			<th>Subject</th>
			<th>File / Video name</th>
			<th>Comments / Notes</th>
			<th>Uploaded by</th>

	</tr>";
	foreach($stmtuploads as $rowfile)
{
	$videofirstname =$rowfile['created_by_firstname'];
	$videolastname = $rowfile['created_by_lastname'];
	$encfirst = new AES($videofirstname, $inputkey, $blocksize);
	$enclast = new AES($videolastname, $inputkey, $blocksize);
	$decfirst = $encfirst->decrypt();
	$declast = $enclast->decrypt();
	echo "<tr>";
		echo "<td>".$rowfile['created_at']."</td>";
	echo "<td>".$rowfile['title']."</td>";
	echo "<td>".$rowfile['subject']."</td>";
	if($rowfile['image'] != null){
	echo "<td>"."<a target = '_blank' href='".$rowfile["image"]."'>". "Play / View file"."</a></td>";
	}
	else{
		echo "<td>-----</td>";
	}
	echo "<td>".$rowfile['report']."</td>";

	echo "<td>".$decfirst." ".$declast."</td></tr>";


}
echo "</table></div>";
?>
</div>
</div>

</div>
</div>
</div>

<?php }
include "includes/studentfooter.php";
?>
