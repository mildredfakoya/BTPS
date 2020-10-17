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
<h5 class = 'header'>View all created Accounts</h5>
		<div class ='outer'>
		<div class ='heading'>
		<h3>All Users</h3>
		</div>
		<div class ='container'>
		<?php
		try{
		$sql ="SELECT * FROM ihs_users";
		$stmt = $user_home->runQuery($sql);
		$stmt->execute();
		$counter = 0;
		echo "<div class ='row'>";
		echo "<div class ='col-1 effect'><label>S /No.</label></div>";
		echo "<div class ='col-2 effect columnspacer'><label>FIRST NAME</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>LAST NAME</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>EMAIL</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>ROLE</label></div>";
		echo "<div class ='col-1 columnspacer effect'><label>Activated?</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Access status</label></div>";
		echo "</div><div class ='textspacer'></div>";

		foreach($stmt as $row1){
		   	$counter++;
			$firstname =$row1['firstname'];
			$lastname = $row1['lastname'];
			$email = $row1['email'];
			$encemail = new AES($email, $inputkey, $blocksize);
			$encfirst = new AES($firstname, $inputkey, $blocksize);
			$enclast = new AES($lastname, $inputkey, $blocksize);
			$decfirst = $encfirst->decrypt();
			$decemail = $encemail->decrypt();
			$declast = $enclast->decrypt();
		echo "<div class ='row'>";
		echo "<p class ='col-1 effect'>".$counter."</p>";
		echo "<p class ='col-2 effect columnspacer'>".$decfirst."</p>";
		echo "<p class ='col-2 columnspacer effect'>".$declast."</p>";
		echo "<p class ='col-2 columnspacer effect'>".$decemail."</p>";
		echo "<p class ='col-2 columnspacer effect'>".$row1['role']."</p>";
		echo "<p class ='col-1 columnspacer effect'>".$row1['userStatus']."</p>";
		echo "<p class ='col-2 columnspacer effect'>".$row1['access_status']."</p>";

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
