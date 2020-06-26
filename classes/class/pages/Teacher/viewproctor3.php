<?php require_once 'includes/teacherheader.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
$email = $row['email'];
$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("assessment", $permissions) OR !in_array("grade_3_teacher", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
  $assessmentid = !empty($_POST['hiddenid']) ? $helper->test_input($_POST['hiddenid']) : null;
  $targetclass = !empty($_POST['hiddenclass']) ? $helper->test_input($_POST['hiddenclass']) : null;
  $assessmenttype= !empty($_POST['hiddentype']) ? $helper->test_input($_POST['hiddentype']) : null;

  if(!empty($targetclass) && !empty($assessmentid) && !empty($assessmenttype)){
?>
<div class ="container">
  <h5 class ="header">Lock this Assessment</h5>
  <form method ="post" action = "lock.php">
    <p class = "error">NOTE: if this assessment is not locked at the end of the assessment period, students will be able to access and resubmit the same assessment unproctored.</p>
    <p>Once an examination is locked, Administration will need to approve any further administration of the assessment</p>
    <input type ="hidden" name ="assessmentid" value ="<?php echo $assessmentid ?>">
    <input type ='submit' name ='lock' value = 'CLICK TO LOCK' class = "btn btn-danger">
  </form>
</div>
<?php
echo "<div class ='jumbotron'>";


if($assessmenttype == 'exam'){
  $sqlreview= "SELECT * FROM btps_student_exam_grade_3 WHERE assessment_id = '$assessmentid' ORDER BY question_id";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();


  echo "<table><tr>";
  echo "<th>Question ID</th>";
  echo "<th>First name</th>";
  echo "<th>Last name</th>";
  echo "<th>Email</th>";
  echo "<th>Student answer</th></tr>";
  foreach($stmtreview as $rowreview){
    $firstname =$rowreview['firstname'];
    $lastname =$rowreview['lastname'];
    $email = $rowreview['email'];
    $firstn =new AES($firstname, $inputkey, $blocksize);
    $dec =$firstn->decrypt();
    $lastn =new AES($lastname, $inputkey, $blocksize);
    $decl =$lastn->decrypt();
    $emailn =new AES($email, $inputkey, $blocksize);
    $decemail =$emailn->decrypt();
    echo "<tr>";
    echo "<td>".$rowreview['question_id']."</td>";
    echo "<td>".$dec."</td>";
    echo "<td>".$decl."</td>";
    echo "<td>".$decemail."</td>";
    echo "<td>".$rowreview['student_answer']."</td></tr>";

  }
echo "</table>";
}

if($assessmenttype == 'continous_assessment'){
  $sqlreview= "SELECT * FROM btps_student_continous_grade_3 WHERE assessment_id = '$assessmentid' ORDER BY question_id";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();


  echo "<table><tr>";
  echo "<th>Question ID</th>";
  echo "<th>First name</th>";
  echo "<th>Last name</th>";
  echo "<th>Email</th>";
  echo "<th>Student answer</th></tr>";
  foreach($stmtreview as $rowreview){
    $firstname =$rowreview['firstname'];
    $lastname =$rowreview['lastname'];
    $email = $rowreview['email'];
    $firstn =new AES($firstname, $inputkey, $blocksize);
    $dec =$firstn->decrypt();
    $lastn =new AES($lastname, $inputkey, $blocksize);
    $decl =$lastn->decrypt();
    $emailn =new AES($email, $inputkey, $blocksize);
    $decemail =$emailn->decrypt();
    echo "<tr>";
    echo "<td>".$rowreview['question_id']."</td>";
    echo "<td>".$dec."</td>";
    echo "<td>".$decl."</td>";
    echo "<td>".$decemail."</td>";
    echo "<td>".$rowreview['student_answer']."</td></tr>";

  }
echo "</table>";
}


if($assessmenttype == 'assignment' OR $assessmenttype == 'project'){
  $sqlreview= "SELECT * FROM btps_student_assignment_grade_3 WHERE assessment_id = '$assessmentid' ORDER BY question_id";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();


  echo "<table><tr>";
  echo "<th>Question ID</th>";
  echo "<th>First name</th>";
  echo "<th>Last name</th>";
  echo "<th>Email</th>";
  echo "<th>Student answer</th></tr>";
  foreach($stmtreview as $rowreview){
    $firstname =$rowreview['firstname'];
    $lastname =$rowreview['lastname'];
    $email = $rowreview['email'];
    $firstn =new AES($firstname, $inputkey, $blocksize);
    $dec =$firstn->decrypt();
    $lastn =new AES($lastname, $inputkey, $blocksize);
    $decl =$lastn->decrypt();
    $emailn =new AES($email, $inputkey, $blocksize);
    $decemail =$emailn->decrypt();
    echo "<tr>";
    echo "<td>".$rowreview['question_id']."</td>";
    echo "<td>".$dec."</td>";
    echo "<td>".$decl."</td>";
    echo "<td>".$decemail."</td>";
    echo "<td>".$rowreview['student_answer']."</td></tr>";

  }
echo "</table>";
}


}

}

?>
</div>
