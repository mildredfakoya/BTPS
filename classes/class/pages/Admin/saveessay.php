<?php require_once 'includes/admininit.php';
$questiontitle = !empty($_POST['questiontitle'])? $helper->test_input($_POST['questiontitle']) : null;
$question = !empty($_POST['question']) ? $helper->test_input($_POST['question']) : null;
$topiccovered = !empty($_POST['topiccovered']) ? $helper->test_input($_POST['topiccovered']) : null;
$feedback = !empty($_POST['feedback']) ? $helper->test_input($_POST['feedback']) : null;
date_default_timezone_set('America/dominica');
if(!empty($questiontitle)&&!empty($question)&&!empty($topiccovered)){
try{
  $sqlmultichoice= "UPDATE btps_essay SET question_text ='$question',
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
