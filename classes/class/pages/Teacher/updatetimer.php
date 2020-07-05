<?php require_once 'includes/teacherheader.php';
$duration = $_POST['duration'];
$format = $_POST['style'];
$assessmentid = $_POST['hiddenid'];
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
  duration ='$duration', style = '$format', month = '$month', year = '$year' WHERE assessment_id ='$assessmentid'";
  $resultf = $user_home->runQuery4($sqlf);

  if($resultf){
    echo  "<div class='alert alert-success'>
  <strong>Success!! Assessment Updated</strong>
</div>" ;
   header('refresh:3;createtimer.php');
  }
  else{
    echo  "<div class='alert alert-danger'>
  <strong>Failure!! Assessment was not updated</strong>
  </div>" ;
   header('refresh:3;createtimer.php');
  }
}
catch(PDOException $e)
  {
    echo $e->getMessage();
    //die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
	}

?>
