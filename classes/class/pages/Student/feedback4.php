<?php include "includes/studentheader.php";
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

# For Assignments
$releaseassignments = "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_4 WHERE email = :email";
$stmtreleaseassignment = $user_home->runQuery($releaseassignments);
$stmtreleaseassignment->bindValue(':email', $email);
$stmtreleaseassignment->execute();
foreach($stmtreleaseassignment as $getid){
  echo "<form method = 'post'>";
  echo "<input type ='text' name ='subject' value = '".$getid['subject']."'>";
  echo "<input type = 'hidden' name ='assessment_id' value = ".$getid['assessment_id'].">";
  echo "<input type = 'submit' value = ".$getid['assessment_id']." name = 'feedbackexam' class ='btn btn-primary'>";
  echo "</form>";
}

if(isset($_POST['feedbackexam'])){
  $assessmentid= !empty($_POST['assessment_id']) ? $helper->test_input($_POST['assessment_id']) : null;
  #for multichoice Questions
  $sqlmulti= "SELECT * FROM btps_multichoice WHERE assessment_id = :id ORDER BY id";
  $stmtmulti = $user_home->runQuery($sqlmulti);
  $stmtmulti->bindValue(':id', $assessmentid);
  $stmtmulti->execute();
  foreach($stmtmulti as $rowmulti){
  ?>

  <div class ="jumbotron">
  <div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowmulti['question_text']) ?></strong></p>
  <b>Option 1: </b><?php echo $rowmulti['option1'] ?><br/><br/>
  <b>Option 2: </b><?php echo $rowmulti['option2'] ?><br/><br/>
  <b>Option 3: </b><?php echo $rowmulti['option3'] ?><br/><br/>
  <b>Option 4: </b><?php echo $rowmulti['option4'] ?><br/><br/>
  <b>Correct Answer:</b><?php echo htmlspecialchars_decode($rowmulti['answer']) ?><br/><br/>
  <b>Feedback:</b><?php echo htmlspecialchars_decode($rowmulti['feedback']) ?><br/><br/>
</div>
<?php
}




}



# For Continous assessment



# For Exam




include "includes/studentfooter.php";
}
?>
