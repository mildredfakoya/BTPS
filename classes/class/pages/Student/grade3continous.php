<?php
include_once "includes/studentheader.php";

# The original page before form processing;
$email = $row['email'];
$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("grade_3", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>

<div class ="jumbotron">
<div class ="header" style ="background-color:#ff0000"><h3>Welcome to Grade 3 Graded Assessment page</h3>
<p>All assessment listed here are access controlled. Your teacher will give you the access code.<br/>Once a correct access code is entered, your question form will be displayed at the top of this page.</p></div>


<!---For Assignments and Projects--->

<h5 class ="header">Continous Assessment</h5>

  <?php
    $targetclass = "grade_3";
    $sqlclass="SELECT * FROM btps_new_assessment WHERE target_class= :class and assessment_type = 'continous_assessment' and approval_status ='Approved'" ;
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
      echo "<form method ='post' action ='grade3continousform.php' id ='getassignment' novalidate = 'novalidate'>";
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
      echo "<input type='hidden'  name ='subject' value ='".$rowclass['assessment_id']."'>";
      echo "<input type='hidden'  name ='subject' value ='".$rowclass['subject']."'>";
      echo "<input type='submit' class ='btn btn-primary' name ='getass' value ='Get'>";
      echo "</div>";
      echo "</div>";
      echo "</form>";
      echo "<div class ='textspacer'></div>";
    }
  }

  $sqlcheck= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_3 WHERE email = :email";
  $stmtcheck = $user_home->runQuery($sqlcheck);
  $stmtcheck->bindValue(':email', $email);
  $stmtcheck->execute();
//  $rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
echo "<div class ='spacer'></div>";
echo "<div class ='header' style = 'background-color:green'><p>You made submissions for the following assessments";
echo "<ul>";
foreach($stmtcheck as $get){
echo "<li>".$get['assessment_id']."</li>";
}
echo "</div>";

?>



</div>

<?php
include_once "includes/studentfooter.php";
}

?>
