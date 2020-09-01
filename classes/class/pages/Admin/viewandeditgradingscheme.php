<?php
require_once 'includes/adminheader.php';
$email = $row['email'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];

$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("exams", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
  echo "<div class ='jumbotron'>";
  echo "<h5>Edit Grading Scheme</h5>";
  echo "<p>Please click the button that holds the term and academic year to edit previously created scheme</p>";
  $sqlget="SELECT * FROM assessmentdefinitions" ;
  $stmtget = $user_home->runQuery($sqlget);
  $stmtget->execute();
  foreach($stmtget as $rowget){
    echo "<form method ='post' class ='updatescheme' action ='updateschemedefinition.php'>";
    echo "<input type ='hidden' name ='definitioncode' value ='".$rowget['definition_code']."'>";
    echo "<input type = 'submit' name ='submit' class ='btn btn-primary' value = '".$rowget['term']."/".$rowget['academic_year']."/".$rowget['class']."'>";
    echo "</form><div class ='spacer'></div>";

  }

}
echo "</div>";
require_once 'includes/adminfooter.php';
?>
