<?php
require_once "includes/teacherheader.php";
$inputkey = "marketdayanyigba";
$blocksize = 256;
$assessmentid = !empty($_POST['hiddenid']) ? $helper->test_input($_POST['hiddenid']) : null;
$sqlgrade= "SELECT * FROM btps_student_continous_grade_k WHERE assessment_id =:id GROUP BY email";
$stmtgrade= $user_home->runQuery($sqlgrade);
$stmtgrade->bindparam(':id', $assessmentid);
$stmtgrade->execute();
#$rowgrade = $stmtgrade->fetch(PDO::FETCH_ASSOC);
foreach($stmtgrade as $rowgrade){
  $email = $rowgrade['email'];
  $firstname = $rowgrade['firstname'];
  $lastname = $rowgrade['lastname'];
  $emailn = new AES($email, $inputkey, $blocksize);
  $fn = new AES($firstname, $inputkey, $blocksize);
  $ln = new AES($lastname, $inputkey, $blocksize);
  $emaildec =$emailn->decrypt();
  $fndec =$fn->decrypt();
  $lndec =$ln->decrypt();
  echo "<div class ='container'>";
  echo "<form method ='post' action ='gradecontk.php'>";
  echo "<h5>".$fndec." ".$lndec."</h5>";
  echo "<input type = 'text' name ='email' value ='".$emaildec."' readonly class ='borderless'>";
  echo "<input type = 'hidden' name ='hiddenassessment' value ='".$assessmentid."'>";
  echo "<input type = 'hidden' name ='hiddenemail' value ='".$email."'>";
  echo "<input type ='submit' name ='submit' value = 'GRADE' class ='btn btn-secondary'>";
  echo "</form>";
  echo "</div>";
  echo "<div class ='spacer'></div>";
}
?>
