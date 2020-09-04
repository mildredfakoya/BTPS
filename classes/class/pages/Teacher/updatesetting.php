<?php require_once 'includes/teacherheader.php';

$assessmentid = !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
$term = !empty($_POST['term']) ? $helper->test_input($_POST['term']) : null;
$academicyear = !empty($_POST['academicyear']) ? $helper->test_input($_POST['academicyear']) : null;
$accesscode = !empty($_POST['accesscode']) ? $helper->test_input($_POST['accesscode']) : null;
$class = !empty($_POST['class']) ? $helper->test_input($_POST['class']) : null;
$accessdate = !empty($_POST['accessdate']) ? $helper->test_input($_POST['accessdate']) : null;
$closedate = !empty($_POST['closedate']) ? $helper->test_input($_POST['closedate']) : null;
$subject = !empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
$type = !empty($_POST['type']) ? $helper->test_input($_POST['type']) : null;

date_default_timezone_set('America/dominica');
$dateupdated= date("y-m-d h:i:s");
$updatedbyfirstname = $row['firstname'];
$updatedbylastname = $row['lastname'];
$email = $row['email'];
$y = strtotime($dateupdated);
$year = date('Y', $y);
$month = date('m', $y);

if(!empty($assessmentid) && !empty($term) &&!empty($academicyear) && !empty($accesscode) && !empty($class) &&!empty($accessdate) && !empty($closedate) && !empty($subject) && !empty($type)){
try{
  $sqlmultichoice= "UPDATE btps_new_assessment SET term = '$term', academic_year = '$academicyear', access_code ='$accesscode', target_class ='$class', intended_access_date ='$accessdate',
  intended_close_date = '$closedate', subject ='$subject', assessment_type = '$type' WHERE assessment_id = '$assessmentid'";
  $result = $user_home->runQuery4($sqlmultichoice);
  if($result){
  echo "<div class='alert alert-success'>
        <strong>Success!</strong> Updated.
        </div>";
  header('refresh:5; changesettings.php');
  }
  else{
  echo "Failure!! Assessment settings was not updated. make sure all fields have been correctly filled.";

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
}
?>
