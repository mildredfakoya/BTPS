<?php include "includes/teacherheader.php";
$assessmentid = !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
$accessstatus ="LOCKED";
try{
  $sqllock= "UPDATE btps_new_assessment SET access_status ='$accessstatus' WHERE assessment_id = '$assessmentid'";
  $result = $user_home->runQuery4($sqllock);
  if($result){
    echo  "<div class='alert alert-success'>
  <strong>This assessment has been locked</strong>
</div>" ;
   header('refresh:3;proctor.php');
  }


}
catch(PDOException $e)
    {
    die('PLEASE ANSWER ALL QUESTIONS');
	}
include "includes/teacherfooter.php";
 ?>
