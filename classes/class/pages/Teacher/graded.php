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

if(in_array("pre_k_teacher", $permissions)){
  $class ='Pre - K';
echo "<div class ='container'>";
echo "<h5 class ='header'>Pre - K</h5>"
$sqlcheck= "SELECT * FROM grades WHERE class = '$class' ORDER BY assessment_type";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->execute();
?>
<table>
  <tr>
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
}

}
echo "</div>";
}







}
require_once "includes/teacherfooter.php";
?>
