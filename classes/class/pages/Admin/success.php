<?php
require_once 'includes/adminheader.php';

#for delete of timetable uploaded

if(isset($_GET['tabledeleted']))
		{
			echo "<div class='alert alert-success'>
					  <strong>Success!</strong> File has been deleted.
						</div>";
						 header('refresh:5; adminhome.php');
		}

		if(isset($_GET['definitiondeleted']))
				{
					echo "<div class='alert alert-success'>
							  <strong>Success!</strong> Grading Scheme has been deleted.
								</div>";
								 header('refresh:5; viewandeditgradingscheme.php');
				}

if(isset($_GET['definitionupdated']))
		{
			echo "<div class='alert alert-success'>
			<strong>Success!</strong> Grading Scheme has updated.
			</div>";
			header('refresh:5; viewandeditgradingscheme.php');
		}

require_once 'includes/adminfooter.php';
