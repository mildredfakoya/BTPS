<?php
require_once "includes/teacherheader.php";
if(isset($_GET['updated']))
		{

          echo  "<div class='alert alert-success'>
				<strong>SUCCESSFUL. Ethnicity has been updated</strong>
		</div>" ;
         header('refresh:3;ethnicity.php');
		}

	
    ?>
