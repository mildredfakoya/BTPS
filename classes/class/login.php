<?php
session_start();
require 'header.php';
require '../../helper.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
$user_login = new USER();
$helper = new HELPER();

#if the login button is clicked
if(isset($_POST['login']))
{
	$email = !empty($_POST['email']) ? $helper->test_input($_POST['email']) : null;
	$password = !empty($_POST['password']) ? $helper->test_input($_POST['password']) : null;

	if($email ==''||$email==null||$password ==''||$password==null){
		$helper->redirect('errors.php?required');
	}
	else{
	$encemail= new AES($email, $inputkey, $blocksize);
	$emailn = $encemail->encrypt();
	$encemail->setData($emailn);

	$encpassword= new AES($password,$inputkey, $blocksize);
	$passwordn = $encpassword->encrypt();
	$encpassword->setData($passwordn);
	if($user_login->login($emailn,$passwordn))
	{


		if($_SESSION['userrole'] == "Admin")
		{
		 $id = $_SESSION['userSession'];
         $date = $helper->timestamp();
	     $sql2 ="update ihs_users set last_logged_in = '$date' where id ='$id'";
	     $user_login->runQuery4($sql2);
	     $user_login->redirect('pages/Admin/adminhome.php');
		}
        if($_SESSION['userrole'] == "Teacher")
		{
		 $id = $_SESSION['userSession'];
         $date = $helper->timestamp();
	     $sql2 ="update ihs_users set last_logged_in = '$date' where id ='$id'";
	     $user_login->runQuery4($sql2);
	     $user_login->redirect('pages/Teacher/teacherhome.php');
		}


		if($_SESSION['userrole'] == "Student")
		{
		 $id = $_SESSION['userSession'];
         $date = $helper->timestamp();
	     $sql2 ="update ihs_users set last_logged_in = '$date' where id ='$id'";
	     $user_login->runQuery4($sql2);
		 $helper->redirect('pages/Student/studenthome.php');
		}

	}

		else{
		$helper->redirect('errors.php?error2');
	}
	}
}

?>
<div class ='spacer'></div>
<div class="container">

  <fieldset>
  <legend>Please Identify Yourself </legend>
  <form method ="POST">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    <input type="submit" class="btn btn-primary" name ="login" value="Login">
      <div class ="spacer"></div>
    <p>Lost your Password? <a href="fpass.php">Click Here </a></p>
    </fieldset>
  </form>
  </div>

</body>
</html>
