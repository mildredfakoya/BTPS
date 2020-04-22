<?php
ob_start();
require_once 'includes/supervisorhead.php';


if(isset($_GET['exists']))
		{

          echo  "<div class='alert alert-danger'>
				<strong>The Email you entered already exists. Please use another Email</strong>
		</div>" ;
         header('refresh:3; signup.php');
		}

		if(isset($_GET['emailplease']))
				{

		          echo  "<div class='alert alert-danger'>
						<strong>Please enter an email address</strong>
				</div>" ;
		         header('refresh:3; registerpharmacy.php');
				}

				if(isset($_GET['nopharmacy']))
						{

									echo  "<div class='alert alert-danger'>
								<strong>The email address you entered does not have the pharmacist permission granted. Please assign pharmacy permission to the associated email first.</strong>
						</div>" ;
								 header('refresh:7; registerpharmacy.php');
						}

						if(isset($_GET['pharmacyrequired']))
								{

											echo  "<div class='alert alert-danger'>
										<strong>Please select a pharmacy to associate the user with</strong>
								</div>" ;
										 header('refresh:5; registerpharmacy.php');
								}

								if(isset($_GET['pharmacyassociation']))
										{

													echo  "<div class='alert alert-danger'>
												<strong>Failed to save the association. Please try again later</strong>
										</div>" ;
												 header('refresh:5; registerpharmacy.php');
										}
if(isset($_GET['noemail']))
		{

          echo  "<div class='alert alert-danger'>
				<strong>Please enter an email address</strong>
		</div>" ;
         header('refresh:3; manageusers.php');
		}

if(isset($_GET['noaddress']))
		{

          echo  "<div class='alert alert-danger'>
				<strong>The email address you entered cannot be found. Please ensure that you enter the correct email.</strong>
		</div>" ;
         header('refresh:3; manageusers.php');
		}
if(isset($_GET['nonefound']))
		{

          echo  "<div class='alert alert-danger'>
				<strong>The name you entered was not found. </strong>
		</div>" ;
         header('refresh:3; findcaseinformation.php');
		}

if(isset($_GET['choose']))
		{

          echo  "<div class='alert alert-danger'>
				<strong>Please Select a testing site</strong>
		</div>" ;
         header('refresh:3; getscreening.php');
		}
if(isset($_GET['noscreening']))
		{

          echo  "<div class='alert alert-danger'>
				<strong>No Screening Information was found for this client</strong>
		</div>" ;
         header('refresh:3; getscreening.php');
		}
require_once 'includes/supervisorfooter.php';
