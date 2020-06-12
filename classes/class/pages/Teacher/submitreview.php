<?php require_once 'includes/teacherinit.php';
$review = "Submitted";
$assessmentid = $_POST['submithidden'];
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
  submitted_review ='$review', month = '$month', year = '$year' WHERE assessment_id ='$assessmentid'";
  $resultf = $user_home->runQuery4($sqlf);

  if($resultf){
  echo "Success!! Assessment has been submitted for review";
  }
  else{
  echo "Failure!! Assessment was not submitted. Try again later";
  }
}
catch(PDOException $e)
  {
    echo $e->getMessage();
    //die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
	}

?>
