<?php
require_once "includes/teacherheader.php";
if(isset($_GET['deleted']))
		{

          echo  "<div class='alert alert-success'>
				<strong>File has been deleted</strong>
		</div>" ;
         header('refresh:3;teacherhome.php');
		}


		if(isset($_GET['tabledeleted']))
				{
					echo "<div class='alert alert-success'>
							  <strong>Success!</strong> File has been deleted.
								</div>";
								 header('refresh:5; uploadedbooks.php');
				}

		if(isset($_GET['deletedquestion']))
				{

		          echo  "<div class='alert alert-success'>
						<strong>File has been deleted</strong>
				</div>" ;
		         header('refresh:3;myassessments.php');
				}

		if(isset($_GET['topicdeleted']))
				{

		          echo  "<div class='alert alert-success'>
						<strong>Topic has been deleted</strong>
				</div>" ;
		         header('refresh:3;createtopics.php');
				}

	if(isset($_GET['reset']))
						{

				          echo  "<div class='alert alert-success'>
								<strong>Student's access has been reset</strong>
						</div>" ;
				         header('refresh:3;release.php');
						}

    ?>
