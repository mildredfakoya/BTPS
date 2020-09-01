<?php
require_once 'includes/admininit.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
$sqlaccess="SELECT * FROM ihs_users WHERE email= :email" ;
$stmtaccess = $user_home->runQuery($sqlaccess);
$stmtaccess->bindValue(':email',$_POST['hiddenpersonal']);
$stmtaccess->execute();
$rowaccess = $stmtaccess->fetch(PDO::FETCH_ASSOC);
$uuid = $rowaccess['uuid'];
    // set the time zone and get the date
	date_default_timezone_set('America/dominica');
  $date_last_updated = date("y-m-d h:i:s");
	$y = strtotime($date_last_updated);
	$year = date('Y',$y);
	$month =date('m', $y);
	$updated_by_firstname = $row['firstname'];
	$updated_by_lastname = $row['lastname'];
	$dayofbirth = !empty($_POST['dobday']) ? $helper->test_input($_POST['dobday']) : null;
	$monthofbirth = !empty($_POST['dobmonth']) ? $helper->test_input($_POST['dobmonth']) : null;
	$yearofbirth = !empty($_POST['dobyear']) ? $helper->test_input($_POST['dobyear']) : null;
	$gender = !empty($_POST['gender']) ? $helper->test_input($_POST['gender']) : null;
	$grade = !empty($_POST['grade']) ? $helper->test_input($_POST['grade']) : null;
	$access = !empty($_POST['access']) ? $helper->test_input($_POST['access']) : null;
	$address = !empty($_POST['address']) ? $helper->test_input($_POST['address']) : null;
	$phone = !empty($_POST['phone']) ? $helper->test_input($_POST['phone']) : null;
	$conditions = !empty($_POST['conditions']) ? $helper->test_input($_POST['conditions']) : null;
	$medications = !empty($_POST['medications']) ? $helper->test_input($_POST['medications']) : null;
	$contact = !empty($_POST['contact']) ? $helper->test_input($_POST['contact']) : null;
	$others = !empty($_POST['others']) ? $helper->test_input($_POST['others']) : null;
	$account =$_POST['hiddenpersonal'];
#from the users table
	$firstname = $rowaccess['firstname'];
	$middlename = $rowaccess['middlename'];
	$lastname = $rowaccess['lastname'];


	try{
	#updates
	#update the students table
	$sqlupdatestudents = "UPDATE ihs_students SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname', gender ='$gender', grade ='$grade',
	 day_of_birth ='$dayofbirth', month_of_birth ='$monthofbirth', year_of_birth ='$yearofbirth', address ='$address', telephone ='$phone', access_right ='$access', medical_conditions = '$conditions',
	 medications ='$medications',emergency_contact ='$contact', other_information ='$others', month ='$month', year ='$year'  WHERE email ='$account'";
	$resultupdatestudents = $user_home->runQuery4($sqlupdatestudents);

  #update the users table
	$sqlupdateusers = "UPDATE ihs_users SET access_status ='$access' WHERE email ='$account'";
	$resultupdateusers= $user_home->runQuery4($sqlupdateusers);

	#update the age table
	$sqlupdatestudentsage = "UPDATE ihs_students_age SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname',
	 day_of_birth ='$dayofbirth', month_of_birth ='$monthofbirth', year_of_birth ='$yearofbirth', month ='$month', year ='$year'  WHERE email ='$account'";
	$resultupdatestudentsage= $user_home->runQuery4($sqlupdatestudentsage);

	#update the contact table
	$sqlupdatestudentscontact = "UPDATE ihs_students_contact SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname',
	 address ='$address', telephone ='$phone', emergency_contact ='$contact', other_information ='$others', month ='$month', year ='$year'  WHERE email ='$account'";
	$resultupdatestudentscontact = $user_home->runQuery4($sqlupdatestudentscontact);

#update the class table
$sqlupdatestudentsclass = "UPDATE ihs_students_class SET grade ='$grade', month ='$month', year ='$year'  WHERE email ='$account'";
$resultupdatestudentsclass = $user_home->runQuery4($sqlupdatestudentsclass);

#update the gender table
$sqlupdatestudentsgender = "UPDATE ihs_students_gender SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname', gender ='$gender',
month ='$month', year ='$year'  WHERE email ='$account'";
$resultupdatestudentsgender = $user_home->runQuery4($sqlupdatestudentsgender);

#update the medical table

$sqlupdatestudentsmedical = "UPDATE ihs_students_medical SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname', medical_conditions = '$conditions',
medications ='$medications',emergency_contact ='$contact', other_information ='$others', month ='$month', year ='$year'  WHERE email ='$account'";
$resultupdatestudentsmedical = $user_home->runQuery4($sqlupdatestudentsmedical);

if($resultupdatestudents&&$resultupdateusers&&$resultupdatestudentsage&&$resultupdatestudentscontact&&$resultupdatestudentsclass&&$resultupdatestudentsgender&&$resultupdatestudentsmedical){
	echo "saved";
}
else{
	echo "Failed!! not saved. Try again";
}



    }
catch(PDOException $e)
    {
		echo "could not find record: ".$e->getMessage();
   //die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

	}

	?>
