<?php
require_once "header.php";

        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-danger'>
				<strong>Wrong Details!</strong>
			</div>

            <?php
			header('refresh:3; login.php');
		}

        if(isset($_GET['error2']))
		{
			?>
            <div class='alert alert-danger'>
				<strong>You need to Login in with the right credentials to access this page.</strong>
			</div>
            <?php
			header('refresh:3; login.php');
		}

        if(isset($_GET['nop']))
		{
			?>
            <div class='alert alert-danger'>
				<strong>You don't have permission to view this page.</strong>
			</div>
            <?php
			header('refresh:3; login.php');
		}




		if(isset($_GET['required']))
		{
			?>
            <div class='alert alert-info'>
				<strong>Please provide your Username / Password to Login</strong>
			</div>
            <?php
			header('refresh:3; login.php');
		}


		?>
