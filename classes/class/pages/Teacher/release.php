<?php
require_once "includes/teacherheader.php";
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
if(!in_array("assessment", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
  echo "<div class ='jumbotron'>";
  $sqlcheck= "SELECT * FROM btps_student_timer";
  $stmtcheck = $user_home->runQuery($sqlcheck);
  $stmtcheck->execute();
  ?>
  <p class ='error'>NOTE: If a student reports being locked out of an assessment before completion, take note of the following before release: </p>
  <ul>
    <li>If the assessment shows a start time and no end time and the status is STARTED, then press reset</li>
    <li>If the assessment shows a start time and an end time and the status is TAKEN, compare the start time and end time and check student's submission. If the submission shows
      that students have answered any question, you might want to consider not resetting or changing the questions.</li>
    <li>If the assessment shows a start time and an end time and the status is STARTED, then press reset</li>
    <li>If the assessment shows a start time and no end time and the status is TAKEN, then press reset</li>
  </ul>
  <p class ='error'>NOTE that the presence of a start time indicates that the student have seen the question. To ensure academic integrity, make careful reset consideration.</p>
  <table>
    <tr>
      <th>Student's Email</th>
      <th>Assessment ID</th>
      <th>Start time</th>
      <th>End Time</th>
      <th>Assessment Duration</th>
      <th>Status</th>
      <th></th>
    </tr>
  <?php
  foreach($stmtcheck as $rowcheck){
    $emails = $rowcheck['email'];
    $emailn =new AES($emails, $inputkey, $blocksize);
    $decemail =$emailn->decrypt();
  echo "<tr><form method ='post' action = 'resetstudent.php'>";
  echo "<td>".$decemail."</td>";
  echo "<td>".$rowcheck['assessment_id']."</td>";
  echo "<td>".$rowcheck['start_time']."</td>";
  echo "<td>".$rowcheck['end_time']."</td>";
  echo "<td>".$rowcheck['duration']."</td>";
  echo "<td>".$rowcheck['status']."</td>";
  echo "<input type ='hidden' name ='email' value ='".$rowcheck['email']."'/>";
  echo "<input type ='hidden' name ='assessmentid' value ='".$rowcheck['assessment_id']."'/>";
  echo "<td><input type ='submit' class = 'btn btn-danger' name ='reset' value = 'RESET'/></td>";
  echo "</form></tr>";

  }





}
echo "</table></div>";
require_once "includes/teacherfooter.php";
