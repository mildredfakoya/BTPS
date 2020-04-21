<?php
require_once 'includes/supervisorinit.php';
require '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;

    // set the time zone and get the date
	date_default_timezone_set('America/dominica');
  $date_last_updated = date("y-m-d h:i:s");
	$updated_by_firstname = $row['firstname'];
	$updated_by_lastname = $row['lastname'];
	$gender = !empty($_POST['gender']) ? $helper->test_input($_POST['gender']) : null;
	$uniqueid =$_POST['hidden2'];


	try{
	$sql = "UPDATE ihs_testing SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname',
	 gender ='$gender' WHERE unique_id ='$uniqueid'";
	$result = $user_home->runQuery4($sql);

	$sql1 = "UPDATE ihs_gender SET gender ='$gender' WHERE unique_id ='$_POST[hidden2]'";
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
