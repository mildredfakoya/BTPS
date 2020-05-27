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
$sqlupdatestudentsclass = "UPDATE ihs_students_class SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname', grade ='$grade', month ='$month', year ='$year'  WHERE email ='$account'";
$resultupdatestudentsclass = $user_home->runQuery4($sqlupdatestudentsclass);

#update the gender table
$sqlupdatestudentsgender = "UPDATE ihs_students_gender SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname', gender ='$gender',
month ='$month', year ='$year'  WHERE email ='$account'";
$resultupdatestudentsgender = $user_home->runQuery4($sqlupdatestudentsgender);

#update the medical table

$sqlupdatestudentsmedical = "UPDATE ihs_students_medical SET date_last_updated ='$date_last_updated', updated_by_firstname ='$updated_by_firstname', updated_by_lastname ='$updated_by_lastname', medical_conditions = '$conditions',
medications ='$medications',emergency_contact ='$contact', other_information ='$others', month ='$month', year ='$year'  WHERE email ='$account'";
$resultupdatestudentsmedical = $user_home->runQuery4($sqlupdatestudentsmedical);

  #insert into ihs_students_change
	$sqlstudentschange = "INSERT INTO ihs_students_change(created_at, created_by_firstname, created_by_lastname, first_name, middle_name, last_name,
		grade, gender, day_of_birth, month_of_birth, year_of_birth, address, telephone, email, access_right, medical_conditions, medications,
	emergency_contact, other_information, month, year)VALUES(:created_at, :created_by_firstname, :created_by_lastname, :first_name, :middle_name, :last_name,
		:grade, :gender, :day_of_birth, :month_of_birth, :year_of_birth, :address, :telephone, :email, :access_right, :medical_conditions, :medications,
	:emergency_contact, :other_information, :month, :year)";
	$stmtsc = $user_home->runQuery($sqlstudentschange);
	$stmtsc->bindValue(':created_at' ,  $date_last_updated);
	$stmtsc->bindValue(':created_by_firstname', $updated_by_firstname);
	$stmtsc->bindValue(':created_by_lastname',$updated_by_lastname);
	$stmtsc->bindValue(':first_name',$firstname);
	$stmtsc->bindValue(':middle_name',$middlename);
	$stmtsc->bindValue(':last_name',$lastname);
	$stmtsc->bindValue(':grade', $grade);
	$stmtsc->bindValue(':gender',$gender);
	$stmtsc->bindValue(':day_of_birth',$dayofbirth);
	$stmtsc->bindValue(':month_of_birth',$monthofbirth);
	$stmtsc->bindValue(':year_of_birth',$yearofbirth);
	$stmtsc->bindValue(':address', $address);
	$stmtsc->bindValue(':telephone', $phone);
	$stmtsc->bindValue(':email', $account);
	$stmtsc->bindValue(':access_right', $access);
	$stmtsc->bindValue(':medical_conditions', $conditions);
	$stmtsc->bindValue(':medications', $medications);
	$stmtsc->bindValue(':emergency_contact', $contact);
	$stmtsc->bindValue(':other_information', $others);
	$stmtsc->bindValue(':month', $month);
	$stmtsc->bindValue(':year', $year);
	$resultsc = $stmtsc->execute();

#insert into the students age change table
$sqlstudentsagechange = "INSERT INTO ihs_students_age_change(created_at, created_by_firstname, created_by_lastname,
email, day_of_birth, month_of_birth, year_of_birth, month, year)VALUES(:created_at, :created_by_firstname, :created_by_lastname,:email,
:day_of_birth, :month_of_birth, :year_of_birth, :month, :year)";
$stmtac = $user_home->runQuery($sqlstudentsagechange);
$stmtac->bindValue(':created_at' ,  $date_last_updated);
$stmtac->bindValue(':created_by_firstname', $updated_by_firstname);
$stmtac->bindValue(':created_by_lastname',$updated_by_lastname);
$stmtac->bindValue(':email',$account);
$stmtac->bindValue(':day_of_birth',$dayofbirth);
$stmtac->bindValue(':month_of_birth',$monthofbirth);
$stmtac->bindValue(':year_of_birth',$yearofbirth);
$stmtac->bindValue(':month', $month);
$stmtac->bindValue(':year', $year);
$resultac = $stmtac->execute();

# insert into the students contact change table
$sqlstudentscontactchange = "INSERT INTO ihs_students_contact_change(created_at, created_by_firstname, created_by_lastname,
address, telephone, email, emergency_contact, other_information,month, year)VALUES(:created_at, :created_by_firstname, :created_by_lastname,
:address, :telephone, :email, :emergency_contact, :other_information, :month, :year)";
$stmtcc = $user_home->runQuery($sqlstudentscontactchange);
$stmtcc->bindValue(':created_at' ,  $date_last_updated);
$stmtcc->bindValue(':created_by_firstname', $updated_by_firstname);
$stmtcc->bindValue(':created_by_lastname',$updated_by_lastname);
$stmtcc->bindValue(':address',$address);
$stmtcc->bindValue(':telephone',$phone);
$stmtcc->bindValue(':email',$account);
$stmtcc->bindValue(':emergency_contact',$contact);
$stmtcc->bindValue(':other_information',$others);
$stmtcc->bindValue(':month', $month);
$stmtcc->bindValue(':year', $year);
$resultcc = $stmtcc->execute();

#insert into the class change table
$sqlclasschange = "INSERT INTO ihs_students_class_change(created_at, created_by_firstname, created_by_lastname,
email, grade, month, year)VALUES(:created_at, :created_by_firstname, :created_by_lastname,
:email, :grade, :month, :year)";
$stmtclass = $user_home->runQuery($sqlclasschange);
$stmtclass->bindValue(':created_at' ,  $date_last_updated);
$stmtclass->bindValue(':created_by_firstname', $updated_by_firstname);
$stmtclass->bindValue(':created_by_lastname',$updated_by_lastname);
$stmtclass->bindValue(':email',$account);
$stmtclass->bindValue(':grade',$grade);
$stmtclass->bindValue(':month', $month);
$stmtclass->bindValue(':year', $year);
$resultclass = $stmtclass->execute();

#insert into the gender change table

$sqlgenderchange = "INSERT INTO ihs_students_gender_change(created_at, created_by_firstname, created_by_lastname,
email, gender, month, year)VALUES(:created_at, :created_by_firstname, :created_by_lastname,
:email, :gender, :month, :year)";
$stmtgender = $user_home->runQuery($sqlgenderchange);
$stmtgender->bindValue(':created_at' ,  $date_last_updated);
$stmtgender->bindValue(':created_by_firstname', $updated_by_firstname);
$stmtgender->bindValue(':created_by_lastname',$updated_by_lastname);
$stmtgender->bindValue(':email',$account);
$stmtgender->bindValue(':gender',$gender);
$stmtgender->bindValue(':month', $month);
$stmtgender->bindValue(':year', $year);
$resultgender = $stmtgender->execute();

#insert into the medical conditions change table
$sqlmedical = "INSERT INTO ihs_students_medical_change(created_at, created_by_firstname, created_by_lastname,
email, medical_conditions, medications, emergency_contact, other_information, month, year)VALUES(:created_at, :created_by_firstname, :created_by_lastname,
:email, :medical_conditions, :medications, :emergency_contact, :other_information, :month, :year)";
$stmtmedical = $user_home->runQuery($sqlmedical);
$stmtmedical->bindValue(':created_at' ,  $date_last_updated);
$stmtmedical->bindValue(':created_by_firstname', $updated_by_firstname);
$stmtmedical->bindValue(':created_by_lastname',$updated_by_lastname);
$stmtmedical->bindValue(':email',$account);
$stmtmedical->bindValue(':medical_conditions',$conditions);
$stmtmedical->bindValue(':medications',$medications);
$stmtmedical->bindValue(':emergency_contact',$contact);
$stmtmedical->bindValue(':other_information',$others);
$stmtmedical->bindValue(':month', $month);
$stmtmedical->bindValue(':year', $year);
$resultmedical = $stmtmedical->execute();


if($resultupdatestudents&&$resultupdateusers&&$resultupdatestudentsage&&$resultupdatestudentscontact&&$resultupdatestudentsclass&&$resultupdatestudentsgender&&$resultupdatestudentsmedical&&$resultsc&&$resultac&&$resultcc&&$resultclass&&$resultgender&&$resultmedical){
	echo "saved";
}
else{
	echo "Failed!! not saved. Try again";
}
	#insert into ihs_students_gender_change


	#update ihs


    }
catch(PDOException $e)
    {
		echo "could not find record: ".$e->getMessage();
   //die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

	}

	?>
