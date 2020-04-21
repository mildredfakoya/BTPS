<?php
require_once 'includes/supervisorinit.php';


    // set the time zone and get the date
	date_default_timezone_set('America/dominica');
    $date_last_updated = date("y-m-d h:i:s");
	$updated_by_firstname = $row['firstname'];
	$updated_by_lastname = $row['lastname'];
	$country = !empty($_POST['country']) ? $helper->test_input($_POST['country']) : null;
	$uniqueid =$_POST['hidden5'];


	try{


	$sql1 = "UPDATE ihs_residence SET date_last_updated = '$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname', country_of_birth ='$country' WHERE unique_id ='$_POST[hidden5]'";
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
		//echo "could not find record: ".$e->getMessage();
   die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

	}

	?>
