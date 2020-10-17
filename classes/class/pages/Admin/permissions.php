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
if(!in_array("users_account", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{

?>
		<div class ='jumbotron'>
<h5 class = 'header'>User's Permissions</h5>
		<div class ='outer'>
		<div class ='heading'>
		<h3>All Users</h3>
		</div>
		<div class ='container'>
		<?php
		try{
		$sql ="SELECT * FROM ihs_user_permissions";
		$stmt = $user_home->runQuery($sql);
		$stmt->execute();
		$counter = 0;
		echo "<div class ='row'>";
		echo "<div class ='col-2 effect'><h2>S /No.</h2></div>";
		echo "<div class ='col-4 effect columnspacer'><h2>Email</h2></div>";
		echo "<div class ='col-6 columnspacer effect'><h2>Permissions</h2></div>";
		echo "</div><div class ='textspacer'></div>";

		foreach($stmt as $row1){
			$counter++;
			$email = $row1['email'];
			$encemail = new AES($email, $inputkey, $blocksize);
			$decemail = $encemail->decrypt();
		echo "<div class ='row'>";
		echo "<p class ='col-2 effect'>".$counter."</p>";
		echo "<p class ='col-4 effect columnspacer'><i>".$decemail."</i></p>";
		echo "<p class ='col-6 columnspacer effect'>".$row1['permissions']."</p>";


		echo "</div>";

		echo "<div class ='textspacer'></div>";

		}
		}
		catch(PDOException $e)
		{
		DIE('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

		}
		?>

		</div>
		</div>

		</div>
<?php }require_once 'includes/adminfooter.php';?>
