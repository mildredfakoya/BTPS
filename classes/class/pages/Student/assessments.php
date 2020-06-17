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
    $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
    $stmtclass = $user_home->runQuery($sqlclass);
    $stmtclass->bindValue(':class', $targetclass);
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
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
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
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
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
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
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
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
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
 $decide = in_array("grade_4", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_4";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
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
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
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
 $decide = in_array("grade_6", $permissions)?'<li>':'<li class="hidden">';
 echo $decide;
 $targetclass = "grade_6";
 $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
 $stmtclass = $user_home->runQuery($sqlclass);
 $stmtclass->bindValue(':class', $targetclass);
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
