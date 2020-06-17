<?php
require_once "includes/studentinit.php";
$email = $row['email'];

$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("grade_4", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  date_default_timezone_set('America/dominica');
  $datecreated = date("y-m-d h:i:sa");
  $assessmentid= !empty($_POST['assessmentidass']) ? $helper->test_input($_POST['assessmentidass']) : null;
  $subject= !empty($_POST['subjectass']) ? $helper->test_input($_POST['subjectass']) : null;
  $accesscode=!empty($_POST['accesscodeass']) ? $helper->test_input($_POST['accesscodeass']) : null;
  if(!empty($assessmentid) && !empty($subject)&&!empty($accesscode) ){
    $sqlaccess="SELECT * FROM btps_new_assessment WHERE assessment_id= :assessmentid" ;
    $stmtaccess = $user_home->runQuery($sqlaccess);
    $stmtaccess->bindValue(':assessmentid', $assessmentid);
    $stmtaccess->execute();
    $rowaccess = $stmtaccess->fetch(PDO::FETCH_ASSOC);
    if($rowaccess['access_code'] == $accesscode){
     echo "click OK to redirect you to the assignment page";
    }else{
      echo "The access code you entered is not correct. Please enter the correct access code and try again";
    }
  }
  else{
      echo "Please fill in all required fields";
  }
}



?>
