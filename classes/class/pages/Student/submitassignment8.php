<?php
require "includes/studentinit.php";

date_default_timezone_set('America/dominica');
$submittedat = date("y-m-d h:i:sa");

$studentanswer= $_POST['answer'];
$questionid= $_POST['hiddenid'];
$assessmentid= $_POST['hiddenassessment'];
$subject= $_POST['hiddensubject'];
$topic= $_POST['hiddentopic'];
$feedback= $_POST['hiddenfeedback'];
$correctanswer= $_POST['hiddenanswer'];
$email = $row['email'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$visibility= "Not Visible";
if(!empty($studentanswer) && !empty($questionid) &&!empty($assessmentid) && !empty($subject) && !empty($topic) && !empty($feedback) && !empty($correctanswer)){
for($i=0;$i<count($questionid);$i++)
{

  $sqlcheck = "SELECT * FROM btps_student_assignment_grade_8 WHERE question_id = '$questionid[$i]' AND email ='$email'";
  $stmtcheck = $user_home->runQuery($sqlcheck);
  $stmtcheck->execute();
  $rowcheck =$stmtcheck->fetch(PDO::FETCH_ASSOC);
  if($rowcheck){

try{
  $sqlmultichoice= "UPDATE btps_student_assignment_grade_8 SET submitted_at ='$submittedat', student_answer ='$studentanswer[$i]' WHERE question_id = '$questionid[$i]' AND email ='$email'";
  $result = $user_home->runQuery4($sqlmultichoice);


}
catch(PDOException $e)
    {
    die('PLEASE ANSWER ALL QUESTIONS');
	}
}
else{
  try{
  $sqlsubmit = "INSERT INTO btps_student_assignment_grade_8(submitted_at, email, firstname, lastname, assessment_id, question_id, subject,
  topic, student_answer, correct_answer, visibility, feedback)
  VALUES(:submitted_at, :email, :firstname, :lastname, :assessment_id, :question_id, :subject,
  :topic, :student_answer, :correct_answer, :visibility, :feedback)";
  $stmtsubmit = $user_home->runQuery($sqlsubmit);
  $stmtsubmit->bindValue(':submitted_at' ,$submittedat);
  $stmtsubmit->bindValue(':email' ,$email);
  $stmtsubmit->bindValue(':firstname' ,$firstname);
  $stmtsubmit->bindValue(':lastname' ,$lastname);
  $stmtsubmit->bindValue(':assessment_id' ,$assessmentid[$i]);
  $stmtsubmit->bindValue(':question_id' ,$questionid[$i]);
  $stmtsubmit->bindValue(':subject' ,$subject[$i]);
  $stmtsubmit->bindValue(':topic' ,$topic[$i]);
  $stmtsubmit->bindValue(':student_answer' ,$studentanswer[$i]);
  $stmtsubmit->bindValue(':correct_answer' ,$correctanswer[$i]);
  $stmtsubmit->bindValue(':visibility' ,$visibility);
  $stmtsubmit->bindValue(':feedback' ,$feedback[$i]);
  $resultsubmit = $stmtsubmit->execute();
}

catch(PDOException $e)
    {
    die('PLEASE ANSWER ALL QUESTIONS');
	}
}
}
}

?>
