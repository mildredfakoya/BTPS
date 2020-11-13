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
if(!in_array("records", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<div class ="container">
  <div class ="outer">
    <div class ="header"><h4>Define a new term and academic year</h4></div>
  </div>
</div>

<?php


}
require_once 'includes/adminfooter.php';
