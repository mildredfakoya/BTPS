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
require_once 'includes/adminfooter.php';
