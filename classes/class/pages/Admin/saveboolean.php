<?php require_once 'includes/admininit.php';
$questiontitle = !empty($_POST['questiontitle'])? $helper->test_input($_POST['questiontitle']) : null;
$question = !empty($_POST['question']) ? $helper->test_input($_POST['question']) : null;
$option1 = !empty($_POST['option1']) ? $helper->test_input($_POST['option1']) : null;
$option2 = !empty($_POST['option2']) ? $helper->test_input($_POST['option2']) : null;
$topiccovered = !empty($_POST['topiccovered']) ? $helper->test_input($_POST['topiccovered']) : null;
$feedback = !empty($_POST['feedback']) ? $helper->test_input($_POST['feedback']) : null;
date_default_timezone_set('America/dominica');
if(!empty($questiontitle)&&!empty($question)&&!empty($option1)&&!empty($option2)&&!empty($topiccovered)){
try{
  $sqlmultichoice= "UPDATE btps_boolean SET question_text ='$question', option1 = '$option1', option2 = '$option2',
  topic = '$topiccovered', feedback = '$feedback' WHERE question_id = '$questiontitle'";
  $result = $user_home->runQuery4($sqlmultichoice);
  if($result){
  echo "Success!! Question has been updated";
  }
  else{
  echo "Failure!! Question was not updated";

  }

}
catch(PDOException $e)
    {
    //die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
    echo $e->getMessage();
	}
}
else{
  echo "Please fill in all fields";
  header('refresh:4;getassessment.php');
}
?>
