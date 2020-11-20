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
  $sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
  $stmtcurrent = $user_home->runQuery($sqlcurrent);
  $stmtcurrent->execute();
  $rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);


if(in_array("pre_k_teacher", $permissions)){
  $class ='Pre - K';
echo "<div class ='container'>";
echo "<h5 class ='header'>Pre - K</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' AND term =:term AND academic_year = :year ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->bindValue(':term', $rowcurrent['current_term']);
$stmtcheck->bindValue(':year', $rowcurrent['academic_year']);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";




if(in_array("grade_k_teacher", $permissions)){
  $class ='Grade K';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade - K</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";

if(in_array("grade_1_teacher", $permissions)){
  $class ='Grade 1';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 1</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";


if(in_array("grade_2_teacher", $permissions)){
  $class ='Grade 2';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 2</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";


if(in_array("grade_3_teacher", $permissions)){
  $class ='Grade 3';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 3</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";


if(in_array("grade_4_teacher", $permissions)){
  $class ='Grade 4';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 4</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";

if(in_array("grade_5_teacher", $permissions)){
  $class ='Grade 5';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 5</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";



if(in_array("grade_6_teacher", $permissions)){
  $class ='Grade 6';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 6</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";




if(in_array("grade_7_teacher", $permissions)){
  $class ='Grade 7';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 7</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";



if(in_array("grade_8_teacher", $permissions)){
  $class ='Grade 8';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 8</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";


if(in_array("grade_9_teacher", $permissions)){
  $class ='Grade 9';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 9</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";



if(in_array("grade_10_teacher", $permissions)){
  $class ='Grade 10';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 10</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";



if(in_array("grade_11_teacher", $permissions)){
  $class ='Grade 11';
echo "<div class ='container'>";
echo "<h5 class ='header'>Grade 11</h5>";
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY email, assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
    <th>Student's Email</th>
    <th>Student's First Name</th>
    <th>Student's Last Name</th>
    <th>Assessment ID</th>
    <th>Assessment type</th>
    <th>Subject</th>
    <th>Total</th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){

  $firstname =$rowcheck['firstname'];
  $lastname =$rowcheck['lastname'];
  $emails = $rowcheck['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($emails, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
 echo "<tr>";
 echo "<td>".$decemail."</td>";
 echo "<td>".$dec."</td>";
 echo "<td>".$decl."</td>";
 echo "<td>".$rowcheck['assessment_id']."</td>";
 echo "<td>".$rowcheck['assessment_type']."</td>";
 echo "<td>".$rowcheck['subject']."</td>";
 echo "<td>".$rowcheck['total']."</td>";
 echo "</tr>";


}

}
echo "</table></div>";
echo "<div class ='spacer'></div>";










}

require_once "includes/teacherfooter.php";
?>
