<?php require_once 'includes/teacherinit.php';
$assessmentid = !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
$questiontitle = !empty($_POST['questiontitle']) ? $helper->test_input($_POST['questiontitle']) : null;
$question = !empty($_POST['question']) ? $helper->test_input($_POST['question']) : null;
$option1 = !empty($_POST['option1']) ? $helper->test_input($_POST['option1']) : null;
$option2 = !empty($_POST['option2']) ? $helper->test_input($_POST['option2']) : null;
$topiccovered = !empty($_POST['topic']) ? $helper->test_input($_POST['topic']) : null;
$answer= !empty($_POST['answer']) ? $helper->test_input($_POST['answer']) : null;
$feedback = !empty($_POST['feedback']) ? $helper->test_input($_POST['feedback']) : null;
//$ = !empty($_POST['']) ? $helper->test_input($_POST['']) : null;
//$ = !empty($_POST['']) ? $helper->test_input($_POST['']) : null;
date_default_timezone_set('America/dominica');
$date_created = date("y-m-d h:i:s");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$email = $row['email'];
$y = strtotime($date_created);
$year = date('Y', $y);
$month = date('m', $y);
if(!empty($assessmentid)&&!empty($questiontitle)&&!empty($question)&&!empty($option1)&&!empty($option2)&&!empty($answer) &&!empty($feedback)){
try{
  $sqlmultichoice= "INSERT INTO btps_boolean(created_at, created_by_firstname, created_by_lastname, assessment_id,  email,
  question_id, question_text, option1, option2, answer, topic, feedback, month, year)
  VALUES(:created_at, :created_by_firstname, :created_by_lastname, :assessment_id,  :email,
  :question_id, :question_text, :option1, :option2, :answer, :topic, :feedback, :month, :year)";
  $stmtmultichoice = $user_home->runQuery($sqlmultichoice);
  $stmtmultichoice->bindValue(':created_at' ,$date_created);
  $stmtmultichoice->bindValue(':created_by_firstname', $createdbyfirstname);
  $stmtmultichoice->bindValue(':created_by_lastname', $createdbylastname);
  $stmtmultichoice->bindValue(':assessment_id',$assessmentid);
  $stmtmultichoice->bindValue(':email',$email);
  $stmtmultichoice->bindValue(':question_id',$questiontitle);
  $stmtmultichoice->bindValue(':question_text',$question);
  $stmtmultichoice->bindValue(':option1',$option1);
  $stmtmultichoice->bindValue(':option2',$option2);
  $stmtmultichoice->bindValue(':answer',$answer);
  $stmtmultichoice->bindValue(':topic',$topiccovered);
  $stmtmultichoice->bindValue(':feedback',$feedback);
  $stmtmultichoice->bindValue(':month',$month);
  $stmtmultichoice->bindValue(':year',$year);
  $resultmultichoice = $stmtmultichoice->execute();

  if($resultmultichoice){
  echo "Success!! Question has been created";
  }
  else{
  echo "Failure!! Failed to create test. Please try again later.";

  }

}
catch(PDOException $e)
    {
    die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
	}
}
else{
  echo "Please fill in all fields";
  header('refresh:4;getassessment.php');
}
?>
