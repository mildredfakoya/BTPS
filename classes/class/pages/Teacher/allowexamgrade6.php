<?php include "includes/teacherheader.php";

if(isset($_POST['exam6'])){
$assessmentid = !empty($_POST['hiddenid']) ? $helper->test_input($_POST['hiddenid']) : null;
$visibility ="Visible";
try{
  $sqllock= "UPDATE btps_student_exam_grade_6 SET visibility ='$visibility' WHERE assessment_id = '$assessmentid'";
  $result = $user_home->runQuery4($sqllock);
  if($result){
    echo  "<div class='alert alert-success'>
    <strong>Student feedback has been released</strong>
    </div>" ;
   header('refresh:3;releasegrades.php');
  }


}
catch(PDOException $e)
    {
    die('FAILED!! Please contact your administrator');
	}
}

include "includes/teacherfooter.php";
?>
