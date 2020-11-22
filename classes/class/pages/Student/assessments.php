<?php
include_once "includes/studentheader.php";
$email = $row['email'];
$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);

$list = $rowid['permissions'];
$permissions = explode(" ", $list);

#Get the current term
$sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
$stmtcurrent = $user_home->runQuery($sqlcurrent);
$stmtcurrent->execute();
$rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);
?>
<div class ="jumbotron">
  <div class = "container">
<h5 class ="header">Assignments</h5>
<ul type ="none">
  <p>If assessments are listed, enter the assessment access code to access the assessment</p>
  <!---for pre k--->
  <?php
     $decide = in_array("pre_k", $permissions)?'<li>':'<li class="hidden">';
     echo $decide;
     $targetclass = "pre_k";
    $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' AND term =:term AND academic_year = :year AND approval_status ='Approved'" ;
    $stmtclass = $user_home->runQuery($sqlclass);
    $stmtclass->bindValue(':class', $targetclass);
    $stmtclass->bindValue(':term', $rowcurrent['current_term']);
    $stmtclass->bindValue(':year', $rowcurrent['academic_year']);
    $stmtclass->execute();
    #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
    foreach($stmtclass as $rowclass){
      echo "<form method ='post' id ='getstudentassessment' novalidate = 'novalidate'>";
      echo "<div class ='row'>";
      echo "<div class ='col-3'>";
      echo "<label>Assessment ID</label>";
      echo "<input type = 'text' name ='assessmentid' value = ".$rowclass['assessment_id']." readonly>";
      echo "</div>";
      echo "<div class ='col-3 columnspacer'>";
      echo "<label>Subject</label>";
      echo "<input type = 'text' name ='subject' value = ".$rowclass['subject']." readonly>";
      echo "</div>";
      echo "<div class ='col-3 columnspacer'>";
      echo "<label>Access Code</label>";
      echo "<input type = 'text' name ='accesscode'>";
      echo "</div>";
      echo "<div class ='col-3 columnspacer'>";
      echo "<label>Start assessment</label><br/>";
      echo "<input type='submit' class ='btn btn-primary' name ='get' value ='Get'>";
      echo "</div>";
      echo "</div>";
      echo "<div class ='textspacer'></div>";
      echo "</form>";
    }
  ?>
</li>
 <!---For Grade K --->
<?php
 $decide = in_array("grade_k", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_k";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment'  AND term =:term AND academic_year = :year AND approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
 $stmtclass->bindValue(':term', $rowcurrent['current_term']);
 $stmtclass->bindValue(':year', $rowcurrent['academic_year']);
 $stmtclass->execute();
 #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
 foreach($stmtclass as $rowclass){
  echo "<form method ='post' id ='getstudentassessment' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowclass['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = ".$rowclass['subject']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='get' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
 }
 ?>
 </li>

 <!---For Grade 1 --->
 <?php
 $decide = in_array("grade_1", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_1";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment'  AND term =:term AND academic_year = :year AND approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
 $stmtclass->bindValue(':term', $rowcurrent['current_term']);
 $stmtclass->bindValue(':year', $rowcurrent['academic_year']);
 $stmtclass->execute();
 #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
 foreach($stmtclass as $rowclass){
  echo "<form method ='post' id ='getstudentassessment' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowclass['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = ".$rowclass['subject']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='get' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
 }
 ?>
 </li>

 <!---For Grade 2 --->
 <?php
 $decide = in_array("grade_2", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_2";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment'  AND term =:term AND academic_year = :year AND approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
 $stmtclass->bindValue(':term', $rowcurrent['current_term']);
 $stmtclass->bindValue(':year', $rowcurrent['academic_year']);
 $stmtclass->execute();
 #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
 foreach($stmtclass as $rowclass){
  echo "<form method ='post' id ='getstudentassessment' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowclass['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = ".$rowclass['subject']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='get' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
 }
 ?>
 </li>

 <!---For Grade 3 --->
 <?php
 $decide = in_array("grade_3", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_3";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment'  AND term =:term AND academic_year = :year AND  approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
 $stmtclass->bindValue(':term', $rowcurrent['current_term']);
 $stmtclass->bindValue(':year', $rowcurrent['academic_year']);
 $stmtclass->execute();
 #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
 foreach($stmtclass as $rowclass){
  echo "<form method ='post' id ='getstudentassessment' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowclass['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = ".$rowclass['subject']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='get' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
 }
 ?>
 </li>



 <!---For Grade 4 --->
 <?php
 $decide = in_array("grade_4", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_4";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment'  AND term =:term AND academic_year = :year AND approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
 $stmtclass->bindValue(':term', $rowcurrent['current_term']);
 $stmtclass->bindValue(':year', $rowcurrent['academic_year']);
 $stmtclass->execute();
 #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
 foreach($stmtclass as $rowclass){
  echo "<form method ='post' id ='getstudentassessment' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowclass['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = ".$rowclass['subject']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='get' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
 }
 ?>
 </li>


 <!---For Grade 5 --->
 <?php
 $decide = in_array("grade_5", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_5";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment'  AND term =:term AND academic_year = :year AND approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
 $stmtclass->bindValue(':term', $rowcurrent['current_term']);
 $stmtclass->bindValue(':year', $rowcurrent['academic_year']);
 $stmtclass->execute();
 #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
 foreach($stmtclass as $rowclass){
  echo "<form method ='post' id ='getstudentassessment' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowclass['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = ".$rowclass['subject']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='get' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
 }
 ?>
 </li>

 <!---For Grade 6 --->
 <?php
 $decide = in_array("grade_6", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_6";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment'  AND term =:term AND academic_year = :year AND approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
 $stmtclass->bindValue(':term', $rowcurrent['current_term']);
 $stmtclass->bindValue(':year', $rowcurrent['academic_year']);
 $stmtclass->execute();
 #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
 foreach($stmtclass as $rowclass){
  echo "<form method ='post' id ='getstudentassessment' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowclass['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = ".$rowclass['subject']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='get' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
 }
 ?>
 </li>
</ul>
  </div>

</div>

<?php
include_once "includes/studentfooter.php";

?>
