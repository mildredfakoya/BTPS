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

	// get the data entered into the form fields

	$firstname = !empty($_POST['gfirstname']) ? $helper->test_input($_POST['gfirstname']) : null;
	$middlename = !empty($_POST['gmiddlename']) ? $helper->test_input($_POST['gmiddlename']) : null;
	$mmaidenname = !empty($_POST['gmmaidenname']) ? $helper->test_input($_POST['gmmaidenname']) : null;
	$lastname = !empty($_POST['glastname']) ? $helper->test_input($_POST['glastname']) : null;
	$uniqueid =$_POST['hidden1'];


	if(empty($_POST["gfirstname"])){
		 $firstn ="";
	}
	else{
	 $firstname = !empty($_POST['gfirstname']) ? $helper->test_input($_POST['gfirstname']) : null;
	 $encfirst = new AES($firstname,$inputkey, $blocksize);
	 $firstn = $encfirst->encrypt();
	 $encfirst->setData($firstn);
	}
	 if(empty($_POST["gmiddlename"])){
		 $middlen ="";
	 }
	 else{
	 $middlename= !empty($_POST['gmiddlename']) ? $helper->test_input($_POST['gmiddlename']) : null;
	 $encmiddle = new AES($middlename,$inputkey, $blocksize);
	 $middlen = $encmiddle->encrypt();
	 $encmiddle->setData($middlen);
	 }

	 if (empty($_POST["glastname"])) {
        $lastn = "";
    }
    else {
        $lastname= !empty($_POST['glastname']) ? $helper->test_input($_POST['glastname']) : null;
		$enclast= new AES($lastname,$inputkey, $blocksize);
		$lastn = $enclast->encrypt();
		$enclast->setData($lastn);
    }

	if (empty($_POST["gmmaidenname"])) {
        $mmaidenn = "";
    }
    else {
        $mmaidenname= !empty($_POST['gmmaidenname']) ? $helper->test_input($_POST['gmmaidenname']) : null;
		$encmaiden = new AES($mmaidenname,$inputkey, $blocksize);
		$mmaidenn = $encmaiden->encrypt();
		$encmaiden->setData($mmaidenn);
    }
	try{
	$sql = "UPDATE ihs_testing SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname',
	first_name ='$firstn', middle_name = '$middlen', last_name= '$lastn', mother_maiden_name ='$mmaidenn' WHERE unique_id ='$_POST[hidden1]'";
	$result = $user_home->runQuery4($sql);


	if ($result){
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
