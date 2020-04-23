<?php
include "header.php";
$inputkey = "marketdayanyigba";
$blocksize = 256;
$user = new USER();
$helper = new MAILERHELPER();
if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	$encemail= new AES($email,$inputkey, $blocksize);
		$emailn = $encemail->encrypt();
		$encemail->setData($emailn);

	$stmt = $user->runQuery("SELECT id FROM ihs_users WHERE email=:email LIMIT 1");
	$stmt->execute(array(":email"=>$emailn));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['id']);
		$code = md5(uniqid(rand()));

		$stmt = $user->runQuery("UPDATE ihs_users SET code=:token WHERE email=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$emailn));

		$message= "
				   Hello , user
				   <br /><br />
				   We got requested to reset your password, if you did this then just click the following link to reset your password, if not just ignore   this email,
				   <br /><br />
				   Click Following Link To Reset Your Password
				   <br /><br />
				   <a href='https://btpps.org/classes/class/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
				   <br /><br />
				   thank you :)
				   ";
		$subject = "Password Reset";

		$helper->send_mail($email,$message,$subject);

		$msg = "<div class='alert alert-success'>
					An email has been sent to $email.
            Please click on the password reset link in the email to generate new password.
			  	</div>";

	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<strong>Sorry!</strong> $email was not found.
			    </div>";
					}


}

?>
 <div class="container">
 <form method ="POST">

        <h2>Forgot Password ? </h2>

        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				<p>Please enter your email address. You will receive a link to create a new password via email.!</p>
				</div>
                <?php
			}
			?>

        <input type="email" placeholder="Email address" name="txtemail" class="form-control" required />
     	<hr />
        <input type="submit" name="btn-submit" value ='Send Link'/>

      </form>

    </div>
