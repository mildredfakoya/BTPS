<?php
require_once 'header.php';
require_once '../../helper.php';
$user = new USER();
$helper = new HELPER();


if(empty($_GET['id']) && empty($_GET['code']))
{
	$helper->redirect('../../index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	$statusY = "Y";
	$statusN = "N";

	$stmt = $user->runQuery("SELECT * FROM ihs_users WHERE id=:id AND code=:code LIMIT 1");
	$stmt->execute(array(":id"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{

				$stmt = $user->runQuery("UPDATE ihs_users SET userStatus=:status WHERE id=:id");
				$stmt->bindparam(":status",$statusY);
				$stmt->bindparam(":id",$id);
				$stmt->execute();

				$msg = "
		           <div class='alert alert-success'>
					  <strong>SUCCESS!!</strong>  Your Account is Now Activated : <a href='login.php'>Login here</a>
			       </div>
			       ";
				}

				else {
					$msg = "
				           <div class='alert alert-info'>
							  <strong>Your Account is already Activated</strong> : <a href='login.php'>Login here</a>
					       </div>
					       ";
				}



		}

		else
		{
			$msg = "
		           <div class='alert alert-info'>
					  <strong>Your Account is already Activated</strong> : <a href='login.php'>Login here</a>
			       </div>
			       ";
		}
	}
	else
	{
		$msg = "
		       <div class='alert alert-danger'>
			   <strong>sorry !</strong> Sorry, Your account was not found.</a>
			   </div>
			   ";
	}


?>

    <div>
		<?php if(isset($msg)) { echo $msg; } ?>
    </div>
