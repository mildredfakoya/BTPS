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
<ul type ='none'>

<li><a target = "_blank" href="https://us02web.zoom.us/j/87114057766">Join Grade 1 Session</a></li>
<li><a target = "_blank" href="https://us02web.zoom.us/j/82052708190">Join Grade 2 Session</a></li>
<li><a target = "_blank" href="https://us02web.zoom.us/j/84702993730">Join Grade 3 Session</a></li>
<li><a target = "_blank" href="https://us02web.zoom.us/j/85675057132">Join Grade 4 Session</a></li>
<li><a target = "_blank" href="https://us02web.zoom.us/j/87063460642">Join Grade 5 Session</a></li>
<li><a target = "_blank" href="https://us02web.zoom.us/j/81104844111">Join Grade 6 Session</a></li>
<li><a target ="_blank" href ="https://us02web.zoom.us/j/81841776036?pwd=TWFUTWFlYnVNVVVlODlXaElYYys4QT09">Start Administrative Meeting  -- Password = 600746</a></li>
</ul>
<?php require_once 'includes/adminfooter.php';?>
