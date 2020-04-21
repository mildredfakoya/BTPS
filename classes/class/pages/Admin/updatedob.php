<?php
require_once 'includes/supervisorinit.php';


    // set the time zone and get the date
	date_default_timezone_set('America/dominica');
    $date_last_updated = date("y-m-d h:i:s");
	$updated_by_firstname = $row['firstname'];
	$updated_by_lastname = $row['lastname'];
	$day = !empty($_POST['dobday']) ? $helper->test_input($_POST['dobday']) : null;
	$month = !empty($_POST['dobmonth']) ? $helper->test_input($_POST['dobmonth']) : null;
	$year = !empty($_POST['dobyear']) ? $helper->test_input($_POST['dobyear']) : null;
	$testingcode = !empty($_POST['testingcode']) ? $helper->test_input($_POST['testingcode']) : null;
	$uniqueid =$_POST['hidden3'];


	try{
	$sql = "UPDATE ihs_testing SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname',
	 day ='$day', month ='$month', year ='$year', testingcode ='$testingcode' WHERE unique_id ='$uniqueid'";
	$result = $user_home->runQuery4($sql);

	$sql1 = "UPDATE ihs_age SET year ='$year', month ='$month', day ='$day' WHERE unique_id ='$_POST[hidden3]'";
	$result1 = $user_home->runQuery4($sql1);

	if ($result||$result1){
         echo "Update Successful";
	}
	// if form data is not successfully saved
	else{
    echo "Update Failed";

	}


    }
catch(PDOException $e)
    {
		//echo "could not find record: ".$e->getMessage();
   die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

	}

	?>
