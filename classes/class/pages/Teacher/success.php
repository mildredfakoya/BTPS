<?php
require_once "includes/teacherheader.php";
if(isset($_GET['deleted']))
		{

          echo  "<div class='alert alert-success'>
				<strong>File has been deleted</strong>
		</div>" ;
         header('refresh:3;teacherhome.php');
		}

		if(isset($_GET['topicdeleted']))
				{

		          echo  "<div class='alert alert-success'>
						<strong>Topic has been deleted</strong>
				</div>" ;
		         header('refresh:3;createtopics.php');
				}

    ?>
