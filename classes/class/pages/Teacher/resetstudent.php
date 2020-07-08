<?php require_once "includes/teacherinit.php";

if(isset($_POST['reset'])){
$assessmentid = !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
$email = !empty($_POST['email']) ? $helper->test_input($_POST['email']) : null;
  try{
      $sql = "DELETE FROM btps_student_timer WHERE email='$email' AND assessment_id = '$assessmentid'";
      $result = $user_home->runQuery4($sql);
     if ($result){

                  $helper->redirect('success.php?reset');
                   }
      else{
        echo "Reset Failed";

      }

  }
  catch(PDOException $e)
      {
      die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
      }
}


?>
