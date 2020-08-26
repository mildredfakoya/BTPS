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

# For Exams
echo "<h5> Examinations </h5>";
$releaseassignments = "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_4 WHERE email = :email";
$stmtreleaseassignment = $user_home->runQuery($releaseassignments);
$stmtreleaseassignment->bindValue(':email', $email);
$stmtreleaseassignment->execute();
foreach($stmtreleaseassignment as $getid){
  echo "<form method = 'post'>";
  echo "<input type = 'hidden' name ='assessment_id' value = ".$getid['assessment_id'].">";
  echo "<input type = 'submit' value = ".$getid['assessment_id']." name = 'feedbackexam' class ='btn btn-primary'><br/><br/>";
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
  <b>Correct Answer: </b><?php echo htmlspecialchars_decode($rowmulti['answer']) ?><br/><br/>
  <b>Feedback: </b><?php echo htmlspecialchars_decode($rowmulti['feedback']) ?><br/><br/>
</div></div>
<?php
}

#for true or false
$sqlbool= "SELECT * FROM btps_boolean WHERE assessment_id = :id ORDER BY id";
$stmtbool = $user_home->runQuery($sqlbool);
$stmtbool->bindValue(':id', $assessmentid);
$stmtbool->execute();

foreach($stmtbool as $rowbool){
?>
<div class ="jumbotron">
<div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowbool['question_text']) ?></strong></p>
<b>Option 1: </b><?php echo $rowbool['option1'] ?><br/><br/>
<b>Option 2: </b><?php echo $rowbool['option2'] ?><br/><br/>
<b>Correct Answer: </b><?php echo htmlspecialchars_decode($rowbool['answer']) ?><br/><br/>
<b>Feedback: </b><?php echo htmlspecialchars_decode($rowbool['feedback']) ?><br/><br/>
</div></div>
<?php
}



$sqlessay= "SELECT * FROM btps_essay WHERE assessment_id = :id ORDER BY id";
$stmtessay = $user_home->runQuery($sqlessay);
$stmtessay->bindValue(':id', $assessmentid);
$stmtessay->execute();


foreach($stmtessay as $rowessay){
?>
<div class ="jumbotron">
<div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowessay['question_text']) ?></strong></p>
<b>Correct Answer: </b><?php echo htmlspecialchars_decode($rowessay['answer']) ?><br/><br/>
<b>Feedback: </b><?php echo htmlspecialchars_decode($rowessay['feedback']) ?><br/><br/>
</div></div>
<?php
}

#for fill in the blank Questions
$sqlblank= "SELECT * FROM btps_blank WHERE assessment_id = :id ORDER BY id";
$stmtblank = $user_home->runQuery($sqlblank);
$stmtblank->bindValue(':id', $assessmentid);
$stmtblank->execute();

foreach($stmtblank as $rowblank){
?>
<div class ="jumbotron">
<div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowblank['question_text']) ?></strong></p>
<b>Correct Answer: </b><?php echo htmlspecialchars_decode($rowblank['answer']) ?><br/><br/>
<b>Feedback: </b><?php echo htmlspecialchars_decode($rowblank['feedback']) ?><br/><br/>
</div></div>
<?php
}


}


# For Continous assessment
echo "<h5> Continous Assessment </h5>";
$releaseassignments = "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_4 WHERE email = :email";
$stmtreleaseassignment = $user_home->runQuery($releaseassignments);
$stmtreleaseassignment->bindValue(':email', $email);
$stmtreleaseassignment->execute();
foreach($stmtreleaseassignment as $getid){
  echo "<form method = 'post'>";
  echo "<input type = 'hidden' name ='assessment_id' value = ".$getid['assessment_id'].">";
  echo "<input type = 'submit' value = ".$getid['assessment_id']." name = 'feedbackcontinous' class ='btn btn-primary'><br/><br/>";
  echo "</form>";
}

if(isset($_POST['feedbackcontinous'])){
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
  <b>Correct Answer: </b><?php echo htmlspecialchars_decode($rowmulti['answer']) ?><br/><br/>
  <b>Feedback: </b><?php echo htmlspecialchars_decode($rowmulti['feedback']) ?><br/><br/>
</div></div>
<?php
}

#for true or false
$sqlbool= "SELECT * FROM btps_boolean WHERE assessment_id = :id ORDER BY id";
$stmtbool = $user_home->runQuery($sqlbool);
$stmtbool->bindValue(':id', $assessmentid);
$stmtbool->execute();

foreach($stmtbool as $rowbool){
?>
<div class ="jumbotron">
<div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowbool['question_text']) ?></strong></p>
<b>Option 1: </b><?php echo $rowbool['option1'] ?><br/><br/>
<b>Option 2: </b><?php echo $rowbool['option2'] ?><br/><br/>
<b>Correct Answer: </b><?php echo htmlspecialchars_decode($rowbool['answer']) ?><br/><br/>
<b>Feedback: </b><?php echo htmlspecialchars_decode($rowbool['feedback']) ?><br/><br/>
</div></div>
<?php
}



$sqlessay= "SELECT * FROM btps_essay WHERE assessment_id = :id ORDER BY id";
$stmtessay = $user_home->runQuery($sqlessay);
$stmtessay->bindValue(':id', $assessmentid);
$stmtessay->execute();


foreach($stmtessay as $rowessay){
?>
<div class ="jumbotron">
<div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowessay['question_text']) ?></strong></p>
<b>Correct Answer: </b><?php echo htmlspecialchars_decode($rowessay['answer']) ?><br/><br/>
<b>Feedback: </b><?php echo htmlspecialchars_decode($rowessay['feedback']) ?><br/><br/>
</div></div>
<?php
}

#for fill in the blank Questions
$sqlblank= "SELECT * FROM btps_blank WHERE assessment_id = :id ORDER BY id";
$stmtblank = $user_home->runQuery($sqlblank);
$stmtblank->bindValue(':id', $assessmentid);
$stmtblank->execute();

foreach($stmtblank as $rowblank){
?>
<div class ="jumbotron">
<div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowblank['question_text']) ?></strong></p>
<b>Correct Answer: </b><?php echo htmlspecialchars_decode($rowblank['answer']) ?><br/><br/>
<b>Feedback: </b><?php echo htmlspecialchars_decode($rowblank['feedback']) ?><br/><br/>
</div></div>
<?php
}


}


# For Assignments




include "includes/studentfooter.php";
}
?>
