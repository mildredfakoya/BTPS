<?php
require_once 'includes/admininit.php';
require_once 'includes/adminhead.php';
require_once 'includes/adminnav.php';
 if(isset($_GET['error']))
		{

            echo "<div class='alert alert-success'>
				<strong>Email not Found! please enter the correct email address</strong>
			</div>";

		}

		if(isset($_GET['error1']))
		{

           echo  "<div class='alert alert-success'>
				<strong>Please Fill in an Email Address</strong>
			</div>";

		}
?>
<div class ='jumbotron'>
<h1>Welcome Administrator</h1>



</div>
<?php require_once 'includes/adminfooter.php';?>
