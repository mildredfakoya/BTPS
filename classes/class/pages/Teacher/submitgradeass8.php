<?php
require_once "includes/teacherinit.php";

#$questionid = !empty($_POST['questionid']) ? $helper->test_input($_POST['questionid']) : null;
#$email = !empty($_POST['hidden']) ? $helper->test_input($_POST['hidden']) : null;
#$score = !empty($_POST['points']) ? $helper->test_input($_POST['points']) : null;
$questionid = $_POST['questionid'];
$assessmentid = $_POST['assessment'];
$email = $_POST['hidden'];
$score = $_POST['points'];
$assessmenttype ='Assignment /Project';
$class ='Grade 8';
$subject = $_POST['subject'];
for($i=0;$i<count($score);$i++)
{
  try{
    $sqlmultichoice= "UPDATE btps_student_assignment_grade_8 SET score = '$score[$i]' WHERE question_id = '$questionid[$i]' AND email ='$email'";
    $result = $user_home->runQuery4($sqlmultichoice);

  }
  catch(PDOException $e)
      {
      die('PLEASE ANSWER ALL QUESTIONS');
    }
}
  $total = array_sum($score);
  $sqlcheck = "SELECT * FROM btps_student_grades WHERE assessment_id = '$assessmentid' AND email = '$email'";
  $stmtcheck = $user_home->runQuery($sqlcheck);
  $stmtcheck->execute();
  $rowcheck =$stmtcheck->fetch(PDO::FETCH_ASSOC);

  if($rowcheck){

try{
  $sqlupdate= "UPDATE btps_student_grades SET total ='$total' WHERE assessment_id = '$assessmentid' AND email ='$email'";
  $result = $user_home->runQuery4($sqlupdate);
  echo "Total Score = ".$total. " Updated";

}
catch(PDOException $e)
    {
    die('PLEASE ANSWER ALL QUESTIONS');
  }
}
else{
  try{
  $sqlsubmit = "INSERT INTO btps_student_grades(email, assessment_id, subject,
  class, assessment_type, total)
  VALUES(:email, :assessment_id, :subject,
  :class, :assessment_type, :total)";
  $stmtsubmit = $user_home->runQuery($sqlsubmit);
  $stmtsubmit->bindValue(':email' ,$email);
  $stmtsubmit->bindValue(':assessment_id' ,$assessmentid);
  $stmtsubmit->bindValue(':subject' ,$subject);
  $stmtsubmit->bindValue(':class' ,$class);
  $stmtsubmit->bindValue(':assessment_type' ,$assessmenttype);
  $stmtsubmit->bindValue(':total' ,$total);
  //$stmtsubmit->bindValue(':' ,$);
  $resultsubmit = $stmtsubmit->execute();

    echo "Total Score = ".$total. " Saved";
}

catch(PDOException $e)
    {
    die('PLEASE ANSWER ALL QUESTIONS');
  }
}



?>
