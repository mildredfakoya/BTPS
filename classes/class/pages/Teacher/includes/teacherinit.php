<?php
session_start();
require_once '../../../../helper.php';
require_once '../../classes.php';
$user_home = new USER();
$helper = new HELPER();

if(!$user_home->is_logged_in())
{
	$helper->redirect('../../login.php');
}
$role = $_SESSION['userrole'];
$access = $_SESSION['userpermission'];
if(!isset($role) || $role!="Teacher"){
$helper->redirect('../../errors.php?error2');

}
$stmt = $user_home->runQuery("SELECT * FROM ihs_users WHERE id=:id");
$stmt->execute(array(":id"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
