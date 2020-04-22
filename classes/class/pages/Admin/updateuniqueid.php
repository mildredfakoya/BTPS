<?php
require_once 'includes/supervisorinit.php';


    // set the time zone and get the date
	date_default_timezone_set('America/dominica');
  $date_last_updated = date("y-m-d h:i:s");
	$updated_by_firstname = $row['firstname'];
	$updated_by_lastname = $row['lastname'];
	$uniqueid = !empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;



	try{


	$sql1 = "UPDATE ihs_uuid SET updated_at = '$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname', unique_id ='$uniqueid' WHERE uuid ='$_POST[hidden]'";
	$result1 = $user_home->runQuery4($sql1);

	if ($result1){
         echo "Update Successful";
	}
	// if form data is not successfully saved
	else{
    echo "Update Failed";

	}


    }
catch(PDOException $e)
    {
	echo "could not find record: ".$e->getMessage();
   //die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

	}

	?>
