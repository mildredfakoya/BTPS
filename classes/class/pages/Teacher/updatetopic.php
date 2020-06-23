<?php require_once 'includes/teacherinit.php';

$topic= !empty($_POST['topicupdate']) ? $helper->test_input($_POST['topicupdate']) : null;
$grade = !empty($_POST['gradeupdate']) ? $helper->test_input($_POST['gradeupdate']) : null;
$subject = !empty($_POST['subjectupdate']) ? $helper->test_input($_POST['subjectupdate']) : null;
$notes = !empty($_POST['notesupdate']) ? $helper->test_input($_POST['notesupdate']) : null;
$id = $_POST['hiddenupdate'];
date_default_timezone_set('America/dominica');
$date_created = date("y-m-d h:i:s");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$email = $row['email'];
$y = strtotime($date_created);
$year = date('Y', $y);
$month = date('m', $y);

try{

  $sqlf = "UPDATE btps_topics SET date_last_updated='$date_created', updated_by_firstname ='$createdbyfirstname', updated_by_lastname ='$createdbylastname',
  notes ='$notes', grade = '$grade', topics_covered = '$topic', month = '$month', year = '$year' WHERE id ='$id'";
  $resultf = $user_home->runQuery4($sqlf);

  if($resultf){
  echo "Success!! Topic Updated.";
  }
  else{
  echo "Failure!! Topic not updated";
  }
}
catch(PDOException $e)
  {
    echo $e->getMessage();
    //die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
	}

?>
