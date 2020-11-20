<?php
require_once "includes/adminheader.php";
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
  $sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
  $stmtcurrent = $user_home->runQuery($sqlcurrent);
  $stmtcurrent->execute();
  $rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);
?>
<div class ="jumbotron">
<h5 class ="header">Assessments submitted by teachers for review and release to students</h5>
<table>
    <thead>
      <tr>
        <th>Assessment ID</th>
        <th>Date Created</th>
        <th>Created By</th>
        <th>Target Class</th>
        <th>Intended assessment date</th>
        <th>Assessment type</th>
        <th>Subject</th>
        <th>Approval Status</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
      <tr>
<?php
$status = "Submitted";
$approvestatus = "Not Approved";
$sqlid="SELECT * FROM btps_new_assessment WHERE submitted_review = :status && approval_status = :approve && term =:term && academic_year = :year";
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':status', $status);
$stmtid->bindValue(':approve', $approvestatus);
$stmtid->bindValue(':term', $rowcurrent['current_term']);
$stmtid->bindValue(':year', $rowcurrent['academic_year']);
$stmtid->execute();
#$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
foreach($stmtid as $rowid){
echo "<form method ='post' id = 'approvalform'  action = 'getreview.php'>";
  $created_by_firstname = $rowid['created_by_firstname'];
  $created_by_lastname = $rowid['created_by_lastname'];
  $createdfn = new AES($created_by_firstname, $inputkey, $blocksize);
  $createdln = new AES($created_by_lastname, $inputkey, $blocksize);
  $fndec =$createdfn->decrypt();
  $lndec =$createdln->decrypt();
echo "<td><input type ='text' name ='assessmentid' value = '".$rowid['assessment_id']."' readonly/></td>";
echo "<td>".$rowid['created_at']."</td>";
echo "<td>".$fndec." ".$lndec."</td>";
echo "<td>".$rowid['target_class']."</td>";
echo "<td>".$rowid['intended_access_date']."</td>";
echo "<td>".$rowid['assessment_type']."</td>";
echo "<td>".$rowid['subject']."</td>";
echo "<td>".$rowid['approval_status']."</td>";
echo "<td><button type ='submit' name = 'smt' value ='smt'>View Assessment</button></td>";
echo "</tr></form>";
}
?>
</tbody>
</table>
</div>
<div class ="container">
  <h5 class ="headeranimated">Assessments Approved</h5>
  <table>
      <thead>
        <tr>
          <th>Assessment ID</th>
          <th>Date Created</th>
          <th>Created By</th>
          <th>Target Class</th>
          <th>Assessment type</th>
          <th>Subject</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
  <?php
  $status = "Approved";
  $sqlapp="SELECT * FROM btps_new_assessment WHERE approval_status = :status && term =:term && academic_year = :year";
  $stmtapp = $user_home->runQuery($sqlapp);
  $stmtapp->bindValue(':status', $status);
  $stmtapp->bindValue(':term', $rowcurrent['current_term']);
  $stmtapp->bindValue(':year', $rowcurrent['academic_year']);
  $stmtapp->execute();


  foreach($stmtapp as $rowapp){
  echo "<form method ='post'  action = 'getreview.php'>";
    $created_by_firstname = $rowapp['created_by_firstname'];
    $created_by_lastname = $rowapp['created_by_lastname'];
    $createdfn = new AES($created_by_firstname, $inputkey, $blocksize);
    $createdln = new AES($created_by_lastname, $inputkey, $blocksize);
    $fndec =$createdfn->decrypt();
    $lndec =$createdln->decrypt();
  echo "<td><input type ='text' name ='assessmentid' value = '".$rowapp['assessment_id']."' readonly/></td>";
  echo "<td>".$rowapp['created_at']."</td>";
  echo "<td>".$fndec." ".$lndec."</td>";
  echo "<td>".$rowapp['target_class']."</td>";
  echo "<td>".$rowapp['assessment_type']."</td>";
  echo "<td>".$rowapp['subject']."</td>";
  echo "<td><input type ='submit' name = 'smt' value ='Change Approval'/></td>";
  echo "</tr></form>";
  }
  echo "</table>";
?>
</table>
</div>
<?php
require_once "includes/adminfooter.php";
}
?>
