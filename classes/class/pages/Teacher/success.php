<?php
require_once "includes/teacherheader.php";
if(isset($_GET['deleted']))
		{

          echo  "<div class='alert alert-success'>
				<strong>File has been deleted</strong>
		</div>" ;
         header('refresh:3;teacherhome.php');
		}


    ?>
