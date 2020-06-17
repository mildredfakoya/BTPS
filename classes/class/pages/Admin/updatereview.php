<?php require_once 'includes/admininit.php';

$reviewstatus = !empty($_POST['reviewstatus']) ? $helper->test_input($_POST['reviewstatus']) : null;
$reviewnotes = !empty($_POST['reviewnotes']) ? $helper->test_input($_POST['reviewnotes']) : null;
$approvalstatus = !empty($_POST['approvalstatus']) ? $helper->test_input($_POST['approvalstatus']) : null;
$assessmentid = $_POST['hiddenreview'];
date_default_timezone_set('America/dominica');
$date_created = date("y-m-d h:i:s");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$email = $row['email'];
$y = strtotime($date_created);
$year = date('Y', $y);
$month = date('m', $y);

try{

  $sqlf = "UPDATE btps_new_assessment SET date_last_updated='$date_created', updated_by_firstname ='$createdbyfirstname', updated_by_lastname ='$createdbylastname',
  review_status ='$reviewstatus', review_notes = '$reviewnotes', approval_status = '$approvalstatus', month = '$month', year = '$year' WHERE assessment_id ='$assessmentid'";
  $resultf = $user_home->runQuery4($sqlf);

  if($resultf){
  echo "Success!! Approval status has been updated.";
  }
  else{
  echo "Failure!! Status was not updated";
  }
}
catch(PDOException $e)
  {
    echo $e->getMessage();
    //die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
	}

?>
