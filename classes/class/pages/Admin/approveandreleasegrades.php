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
?>
<div class ="jumbotron">
  <h5 class ="header">Approve Student's Grade Book</h5>
  <div class = "outer">
    <div class ="heading"><h4>Pre K</h4></div>
    <div class ="container">

    </div>
  </div>

</div>


<?php
}
require_once 'includes/adminfooter.php';
?>
