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
$sqlreview= "SELECT * FROM btps_new_assessment";
$stmtreview = $user_home->runQuery($sqlreview);
$stmtreview->execute();
foreach($stmtreview as $rowproctor){
?>


<?php
}
//$rowreview = $stmtreview->fetch(PDO::FETCH_ASSOC);
?>




<?php
require_once "includes/teacherfooter.php";
}
?>
