<?php include "includes/studentheader.php";
# The original page before form processing;
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

# For Assignments
$releaseassignments = "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_4 WHERE email = :email";
$stmtreleaseassignment = $user_home->runQuery($releaseassignments);
$stmtreleaseassignment->bindValue(':email', $email);
$stmtreleaseassignment->execute();
foreach($stmtreleaseassignment as $getid){
  echo "<form method = 'post'>";
  echo "<input type = 'hidden' name ='assessment_id' value = ".$getid['assessment_id'].">";
  echo "<input type = 'submit' name = ".$getid['assessment_id']." class ='btn btn-primary'>";
  echo "</form>";
}
# For Continous assessment



# For Exam




include "includes/studentfooter.php";
}
?>
