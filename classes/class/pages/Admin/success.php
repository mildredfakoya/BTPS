<?php
require_once 'includes/supervisorheader.php';


if(isset($_GET['created']))
		{
		echo "<div class='alert alert-success'>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account.
			  		</div>";
         header('refresh:3; signup.php');
		}

		if(isset($_GET['pharmacyassociation']))
				{
				echo "<div class='alert alert-success'>
								<strong>Success!</strong> The pharmacist has been associated with the selected pharmacy.
					  		</div>";
		         header('refresh:3; registerpharmacy.php');
				}

require_once 'includes/supervisorfooter.php';
