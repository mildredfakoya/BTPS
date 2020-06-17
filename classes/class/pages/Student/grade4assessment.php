<?php
include_once "includes/studentheader.php";

#for processing Assignments
if(isset($_POST['getass'])){
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  date_default_timezone_set('America/dominica');
  $datecreated = date("y-m-d h:i:sa");
  $assessmentid= !empty($_POST['assessmentidass']) ? $helper->test_input($_POST['assessmentidass']) : null;
  $subject= !empty($_POST['subjectass']) ? $helper->test_input($_POST['subjectass']) : null;
  $accesscode=!empty($_POST['accesscodeass']) ? $helper->test_input($_POST['accesscodeass']) : null;
  if(!empty($assessmentid) && !empty($subject)&&!empty($accesscode) ){
    $sqlaccess="SELECT * FROM btps_new_assessment WHERE assessment_id= :assessmentid" ;
    $stmtaccess = $user_home->runQuery($sqlaccess);
    $stmtaccess->bindValue(':assessmentid', $assessmentid);
    $stmtaccess->execute();
    $rowaccess = $stmtaccess->fetch(PDO::FETCH_ASSOC);
    if($rowaccess['access_code'] == $accesscode){
     include "grade4assignmentform.php";
    }else{
      echo "The access code you entered is not correct. Please enter the correct access code and try again";
    }
  }
  else{
      echo "Please fill in all required fields";
  }
}

# for form processing of projects
if(isset($_POST['getpro'])){
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  date_default_timezone_set('America/dominica');
  $datecreated = date("y-m-d h:i:sa");
  $assessmentid= !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
  $subject= !empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
  $accesscode=!empty($_POST['accesscode']) ? $helper->test_input($_POST['accesscode']) : null;
  if(!empty($assessmentid) && !empty($subject)&&!empty($accesscode) ){
    $sqlaccess="SELECT * FROM btps_new_assessment WHERE assessment_id= :assessmentid" ;
    $stmtaccess = $user_home->runQuery($sqlaccess);
    $stmtaccess->bindValue(':assessmentid', $assessmentid);
    $stmtaccess->execute();
    $rowaccess = $stmtaccess->fetch(PDO::FETCH_ASSOC);
    if($rowaccess['access_code'] == $accesscode){
     include "grade4projectform.php";
    }else{
      echo "The access code you entered is not correct. Please enter the correct access code and try again";
    }
  }
  else{
      echo "Please fill in all required fields";
  }
}

#for continousassessment form Processing

if(isset($_POST['getcont'])){
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  date_default_timezone_set('America/dominica');
  $datecreated = date("y-m-d h:i:sa");
  $assessmentid= !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
  $subject= !empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
  $accesscode=!empty($_POST['accesscode']) ? $helper->test_input($_POST['accesscode']) : null;
  if(!empty($assessmentid) && !empty($subject)&&!empty($accesscode) ){
    $sqlaccess="SELECT * FROM btps_new_assessment WHERE assessment_id= :assessmentid" ;
    $stmtaccess = $user_home->runQuery($sqlaccess);
    $stmtaccess->bindValue(':assessmentid', $assessmentid);
    $stmtaccess->execute();
    $rowaccess = $stmtaccess->fetch(PDO::FETCH_ASSOC);
    if($rowaccess['access_code'] == $accesscode){
     include "grade4continousassessment.php";
    }else{
      echo "The access code you entered is not correct. Please enter the correct access code and try again";
    }
  }
  else{
      echo "Please fill in all required fields";
  }
}

# for exam form processing
if(isset($_POST['getexam'])){
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  date_default_timezone_set('America/dominica');
  $datecreated = date("y-m-d h:i:sa");
  $assessmentid= !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
  $subject= !empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
  $accesscode=!empty($_POST['accesscode']) ? $helper->test_input($_POST['accesscode']) : null;
  if(!empty($assessmentid) && !empty($subject)&&!empty($accesscode) ){
    $sqlaccess="SELECT * FROM btps_new_assessment WHERE assessment_id= :assessmentid" ;
    $stmtaccess = $user_home->runQuery($sqlaccess);
    $stmtaccess->bindValue(':assessmentid', $assessmentid);
    $stmtaccess->execute();
    $rowaccess = $stmtaccess->fetch(PDO::FETCH_ASSOC);
    if($rowaccess['access_code'] == $accesscode){
     include "grade4examform.php";
    }else{
      echo "The access code you entered is not correct. Please enter the correct access code and try again";
    }
  }
  else{
      echo "Please fill in all required fields";
  }
}

# The original page before form processing;
$email = $row['email'];
$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("grade_4", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{

?>

<div class ="jumbotron">
<div class ="header" style ="background-color:#ff0000"><h3>Welcome to Grade 4 Graded Assessment page</h3>
<p>All assessment listed here are access controlled. Your teacher will give you the access code.<br/>Once a correct access code is entered, your question form will be displayed at the top of this page.</p></div>


<!---For Assignments and Projects--->
<div class ="row">
<div class = "col-4 container">
<h5 class ="header">Assignments</h5>

  <?php
    $targetclass = "grade_4";
    $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'assignment' and approval_status ='Approved'" ;
    $stmtclass = $user_home->runQuery($sqlclass);
    $stmtclass->bindValue(':class', $targetclass);
    $stmtclass->execute();
    #$rowclass = $stmtclass->fetch(PDO::FETCH_ASSOC);
    foreach($stmtclass as $rowclass){
      date_default_timezone_set('America/dominica');
      //check if the date for the assessment is past
      $today =strtotime("today");
      $enddate = $rowclass['intended_close_date'];
      $c = strtotime($rowclass['intended_close_date']);
    	$date = date('d-M-Y', $c);
    	$diffdate = $today - $c;


      if($diffdate <= 0){
      echo "<form method ='post' id ='getassignment' novalidate = 'novalidate'>";
      echo "<div class ='row'>";
      echo "<div class ='col-3'>";
      echo "<label>Assessment ID</label>";
      echo "<input type = 'text' name ='assessmentidass' readonly value = ".$rowclass['assessment_id'].">";
      echo "</div>";
      echo "<div class ='col-3 columnspacer'>";
      echo "<label>Subject</label>";
      echo "<input type = 'text' name ='subjectass' readonly value = '".$rowclass['subject']."'>";
      echo "</div>";
      echo "<div class ='col-3 columnspacer'>";
      echo "<label>Access Code</label>";
      echo "<input type = 'text' name ='accesscodeass'>";
      echo "</div>";
      echo "<div class ='col-3 columnspacer'>";
      echo "<label>Start assessment</label><br/>";
      echo "<input type='submit' class ='btn btn-primary' name ='getass' value ='Get'>";
      echo "</div>";
      echo "</div>";
      echo "</form>";
      echo "<div class ='textspacer'></div>";
    }
  }



?>



<h5 class ="headeranimated"> Projects </h5>
<?php
$sqlproject="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'project' and approval_status ='Approved'" ;
$stmtproject = $user_home->runQuery($sqlproject);
$stmtproject->bindValue(':class', $targetclass);
$stmtproject->execute();

foreach($stmtproject as $rowproject){
  date_default_timezone_set('America/dominica');
  //check if the date for the assessment is past
  $today =strtotime("today");
  $enddate = $rowproject['intended_close_date'];
  $c = strtotime($rowproject['intended_close_date']);
  $date = date('d-M-Y', $c);
  $diffdate = $today - $c;


  if($diffdate <= 0){
  echo "<form method ='post' id ='getproject' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowproject['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = '".$rowproject['subject']."' readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='getpro' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
}
}
?>
  </div>
<div class ="col-4 columnspacer container">
<h5 class ="header">Continous Assessment</h5>
<?php
$sqlcontinous="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'continous_assessment' and approval_status ='Approved'" ;
$stmtcontinous = $user_home->runQuery($sqlcontinous);
$stmtcontinous->bindValue(':class', $targetclass);
$stmtcontinous->execute();

foreach($stmtcontinous as $rowcontinous){
  date_default_timezone_set('America/dominica');
  //check if the date for the assessment is past
  $today =strtotime("today");
  $enddate = $rowcontinous['intended_close_date'];
  $c = strtotime($rowcontinous['intended_close_date']);
  $date = date('d-M-Y', $c);
  $diffdate = $today - $c;


  if($diffdate <= 0){
  echo "<form method ='post' id ='getcontinous' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowcontinous['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = '".$rowcontinous['subject']."' readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='getcont' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
}
}
?>
</div>
<div class ="col-4 columnspacer container">
<h5 class ="header">Examination</h5>
<?php

$sqlexam="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'exam' and approval_status ='Approved'" ;
$stmtexam = $user_home->runQuery($sqlexam);
$stmtexam->bindValue(':class', $targetclass);
$stmtexam->execute();
foreach($stmtexam as $rowexam){
  date_default_timezone_set('America/dominica');
  //check if the date for the assessment is past
  $today =strtotime("today");
  $enddate = $rowexam['intended_close_date'];
  $c = strtotime($rowexam['intended_close_date']);
  $date = date('d-M-Y', $c);
  $diffdate = $today - $c;


  if($diffdate <= 0){
  echo "<form method ='post' id ='getexam' novalidate = 'novalidate'>";
  echo "<div class ='row'>";
  echo "<div class ='col-3'>";
  echo "<label>Assessment ID</label>";
  echo "<input type = 'text' name ='assessmentid' value = ".$rowexam['assessment_id']." readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Subject</label>";
  echo "<input type = 'text' name ='subject' value = '".$rowexam['subject']."' readonly>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Access Code</label>";
  echo "<input type = 'text' name ='accesscode'>";
  echo "</div>";
  echo "<div class ='col-3 columnspacer'>";
  echo "<label>Start assessment</label><br/>";
  echo "<input type='submit' class ='btn btn-primary' name ='getexam' value ='Get'>";
  echo "</div>";
  echo "</div>";
  echo "<div class ='textspacer'></div>";
  echo "</form>";
}
}
?>
</div>
</div>
</div>

<?php
include_once "includes/studentfooter.php";
}
?>
