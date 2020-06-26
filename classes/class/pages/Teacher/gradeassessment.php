<?php
require_once "includes/teacherheader.php";
$email = $row['email'];
$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("assessment", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{


echo "<div class ='jumbotron'>";
echo "<h5 class ='header'>Click on the button that holds the assessment ID to grade the assessment</h5>";

#for Pre K grading

if(in_array("pre_k_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Pre - K Assessments</h5>";
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'pre_k' AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignmentpk.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='prekass' class = 'btn btn-info' value ='".$rowreview['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'pre_k' AND assessment_type ='continous_assessment'";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinouspk.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='prekass' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'pre_k' AND assessment_type ='exam'";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexampk.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='prekass' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";


?>

<?php
echo "</div>";
require_once "includes/teacherfooter.php";
}
?>
