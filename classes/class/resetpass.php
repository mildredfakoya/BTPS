<?php
ob_start();
require_once 'header.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
$user= new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('country_login.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];

	$stmt = $user->runQuery("SELECT * FROM ihs_users WHERE id=:id AND code=:token");
	$stmt->execute(array(":id"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);

	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];

			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-success'>
						<strong>Sorry!</strong>  Password Doesn't match.
						</div>";
			}
			else
			{
				$encpassword= new AES($pass,$inputkey, $blocksize);
				$passwordn = $encpassword->encrypt();
				$encpassword->setData($passwordn);
				$stmt = $user->runQuery("UPDATE ihs_users SET password=:password WHERE id=:id");
				$stmt->execute(array(":password"=>$passwordn,":id"=>$rows['id']));

				$msg = "<div class='alert alert-info'>
						<strong>Password Changed.</strong>
						</div>";
				header("refresh:5;country_login.php");
			}
		}
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				No Account Found, Try again
				</div>";

	}


}
$firstname =$rows['firstname'];
$encfirst =new AES($firstname, $inputkey ,$blocksize);
$decfirst =$encfirst->decrypt();
?>
    <div class="jumbotron">
    	<div class='alert alert-success'>
			<strong>Hello!</strong>  <?php echo $decfirst;?> you are here to reset your forgotten password.
		</div>

        <form method="post">
        <h3>Password Reset</h3>
        <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>

		<div class ="row">
		<label for="pass" class ="col-5">New Password:</label>
        <input type="password" class ="col-7" name="pass" id ="pass" class="form-control" required //>
		</div>
		<div class ="row">
		<label for="confirm-pass" class ="col-5">Re-type Password:</label>
        <input type="password" class ="col-7" name="confirm-pass" id ="confirm-pass" class="form-control" required //>
     	</div>
        <input type="submit" name="btn-reset-pass" value ='Reset'/>
        </form>
		</div>
