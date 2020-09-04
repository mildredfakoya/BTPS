<?php
ob_start();
require_once 'includes/teacherinit.php';
// SET THE TIME ZONE
date_default_timezone_set('America/dominica');
//AUTOMATICALLY SET THE DATE OF CREATION AND THE USER.
$date_created = date("y-m-d h:i:s");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$email = $row['email'];
$review = "Not Submitted";
$reviewstatus = "Not Reviewed";
$approvalstatus = "Not Approved";
$assessmentid = !empty($_POST['assessment_id']) ? $helper->test_input($_POST['assessment_id']) : null;
$accesscode = !empty($_POST['access_password']) ? $helper->test_input($_POST['access_password']) : null;
$intendedaccessday= !empty($_POST['intendedaccessday']) ? $helper->test_input($_POST['intendedaccessday']) : null;
$intendedaccessmonth= !empty($_POST['intendedaccessmonth']) ? $helper->test_input($_POST['intendedaccessmonth']) : null;
$intendedaccessyear= !empty($_POST['intendedaccessyear']) ? $helper->test_input($_POST['intendedaccessyear']) : null;
$intendedcloseday= !empty($_POST['intendedcloseday']) ? $helper->test_input($_POST['intendedcloseday']) : null;
$intendedclosemonth= !empty($_POST['intendedclosemonth']) ? $helper->test_input($_POST['intendedclosemonth']) : null;
$intendedcloseyear= !empty($_POST['intendedcloseyear']) ? $helper->test_input($_POST['intendedcloseyear']) : null;
$assessmenttype= !empty($_POST['assessment_type']) ? $helper->test_input($_POST['assessment_type']) : null;
$targetclass= !empty($_POST['target_class']) ? $helper->test_input($_POST['target_class']) : null;
$term= !empty($_POST['term']) ? $helper->test_input($_POST['term']) : null;
$academicyear= !empty($_POST['academicyear']) ? $helper->test_input($_POST['academicyear']) : null;
$subject= !empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
$ad =mktime(8, 0, 0, $intendedaccessmonth, $intendedaccessday, $intendedaccessyear);
$intendedaccessdate = date("Y-m-d h:i:sa", $ad);
$cd = mktime(8, 0, 0, $intendedclosemonth, $intendedcloseday, $intendedcloseyear);
$intendedclosedate = date("Y-m-d h:i:sa", $cd);
$y = strtotime($date_created);
	$year = date('Y', $y);
  $month = date('m', $y);
try{

		  $sqlid="SELECT * FROM btps_new_assessment WHERE assessment_id= :assessmentid" ;
	    $stmtid = $user_home->runQuery($sqlid);
	    $stmtid->bindValue(':assessmentid', $assessmentid);
	    $stmtid->execute();
	    $rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
		//IF THE ASSESSMENT ID IS IN USE
		if($rowid){
			echo "Failed!!. This assessment cannot be created.
      Reason : A previously created assessment uses the same ID. Try again";
			}

		else{
//IF NO ASSESSMENT EXIST FOR THE GENERATED ID

	// insert into btps_new_assessment table
		 $sqlcreate= "INSERT INTO btps_new_assessment(created_at, created_by_firstname, created_by_lastname, term, academic_year, assessment_id, access_code, email, target_class, intended_access_date, intended_close_date,
		 assessment_type, submitted_review, review_status, approval_status, subject, month, year)
		 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :term, :academic_year,:assessment_id, :access_code, :email, :target_class, :intended_access_date, :intended_close_date,
		 :assessment_type, :submitted_review, :review_status, :approval_status, :subject, :month, :year)";
     $stmtcreate = $user_home->runQuery($sqlcreate);
		 $stmtcreate->bindValue(':created_at' ,$date_created);
		 $stmtcreate->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmtcreate->bindValue(':created_by_lastname', $createdbylastname);
		 $stmtcreate->bindValue(':term',$term);
		 $stmtcreate->bindValue(':academic_year',$academicyear);
		 $stmtcreate->bindValue(':assessment_id',$assessmentid);
	   $stmtcreate->bindValue(':access_code',$accesscode);
		 $stmtcreate->bindValue(':email',$email);
	   $stmtcreate->bindValue(':target_class',$targetclass);
		 $stmtcreate->bindValue(':intended_access_date',$intendedaccessdate);
	   $stmtcreate->bindValue(':intended_close_date',$intendedclosedate);
		 $stmtcreate->bindValue(':assessment_type',$assessmenttype);
		 $stmtcreate->bindValue(':submitted_review',$review);
		 $stmtcreate->bindValue(':review_status',$reviewstatus);
		 $stmtcreate->bindValue(':approval_status',$approvalstatus);
	   $stmtcreate->bindValue(':subject',$subject);
		 $stmtcreate->bindValue(':month',$month);
	   $stmtcreate->bindValue(':year',$year);
		 $resultcreate = $stmtcreate->execute();

		 //insert into the btps_new_assessment_change table
		 $sqlcreatechange= "INSERT INTO btps_new_assessment_change(created_at, created_by_firstname, created_by_lastname, term, academic_year, assessment_id, access_code, email, target_class, intended_access_date, intended_close_date,
		 assessment_type, subject, month, year)
		 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :term, :academic_year,:assessment_id, :access_code, :email, :target_class, :intended_access_date, :intended_close_date,
		 :assessment_type, :subject, :month, :year)";
		 $stmtcreatechange = $user_home->runQuery($sqlcreatechange);
		 $stmtcreatechange->bindValue(':created_at' ,$date_created);
		 $stmtcreatechange->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmtcreatechange->bindValue(':created_by_lastname', $createdbylastname);
		 $stmtcreatechange->bindValue(':term',$term );
		 $stmtcreatechange->bindValue(':academic_year',$academicyear);
		 $stmtcreatechange->bindValue(':assessment_id',$assessmentid);
		 $stmtcreatechange->bindValue(':access_code',$accesscode);
		 $stmtcreatechange->bindValue(':email',$email);
		 $stmtcreatechange->bindValue(':target_class',$targetclass);
		 $stmtcreatechange->bindValue(':intended_access_date',$intendedaccessdate);
		 $stmtcreatechange->bindValue(':intended_close_date',$intendedclosedate);
		 $stmtcreatechange->bindValue(':assessment_type',$assessmenttype);
		 $stmtcreatechange->bindValue(':subject',$subject);
		 $stmtcreatechange->bindValue(':month',$month);
		 $stmtcreatechange->bindValue(':year',$year);
		 $resultcreatechange = $stmtcreatechange->execute();
if ($assessmenttype == "assignment"){
			 $sqlassignment= "INSERT INTO btps_assignment(created_at, created_by_firstname, created_by_lastname, assessment_id,  email, target_class, subject, month, year)
			 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :assessment_id, :email, :target_class, :subject, :month, :year)";
			 $stmtassignment = $user_home->runQuery($sqlassignment);
			 $stmtassignment->bindValue(':created_at' ,$date_created);
			 $stmtassignment->bindValue(':created_by_firstname', $createdbyfirstname);
			 $stmtassignment->bindValue(':created_by_lastname', $createdbylastname);
			 $stmtassignment->bindValue(':assessment_id',$assessmentid);
			 $stmtassignment->bindValue(':email',$email);
			 $stmtassignment->bindValue(':target_class',$targetclass);
			 $stmtassignment->bindValue(':subject',$subject);
			 $stmtassignment->bindValue(':month',$month);
		   $stmtassignment->bindValue(':year',$year);
			 $resultassignment = $stmtassignment->execute();

if($resultcreate||$resultcreatechange||$resultassignment){
echo "Success!! Assessment has been created";
}
else{
echo "Failure!! Failed to create test. Please try again later.";

	}
}

if($assessmenttype == "project"){
	$sqlproject= "INSERT INTO btps_project(created_at, created_by_firstname, created_by_lastname, assessment_id,  email, target_class, subject, month, year)
	VALUES(:created_at, :created_by_firstname, :created_by_lastname, :assessment_id, :email, :target_class, :subject, :month, :year)";
	$stmtproject = $user_home->runQuery($sqlproject);
	$stmtproject->bindValue(':created_at' ,$date_created);
	$stmtproject->bindValue(':created_by_firstname', $createdbyfirstname);
	$stmtproject->bindValue(':created_by_lastname', $createdbylastname);
	$stmtproject->bindValue(':assessment_id',$assessmentid);
	$stmtproject->bindValue(':email',$email);
	$stmtproject->bindValue(':target_class',$targetclass);
	$stmtproject->bindValue(':subject',$subject);
	$stmtproject->bindValue(':month',$month);
	$stmtproject->bindValue(':year',$year);
	$resultproject = $stmtproject->execute();

if($resultcreate||$resultcreatechange||$resultproject){
echo "Success!! Assessment has been created";
}
else{
echo "Failure!! Failed to create test. Please try again later.";

}
}

if($assessmenttype == "continous_assessment"){
	$sqlcont= "INSERT INTO continous_assessment(created_at, created_by_firstname, created_by_lastname, assessment_id,  email, target_class, subject, month, year)
	VALUES(:created_at, :created_by_firstname, :created_by_lastname, :assessment_id, :email, :target_class, :subject, :month, :year)";
	$stmtcont = $user_home->runQuery($sqlcont);
	$stmtcont->bindValue(':created_at' ,$date_created);
	$stmtcont->bindValue(':created_by_firstname', $createdbyfirstname);
	$stmtcont->bindValue(':created_by_lastname', $createdbylastname);
	$stmtcont->bindValue(':assessment_id',$assessmentid);
	$stmtcont->bindValue(':email',$email);
	$stmtcont->bindValue(':target_class',$targetclass);
	$stmtcont->bindValue(':subject',$subject);
	$stmtcont->bindValue(':month',$month);
	$stmtcont->bindValue(':year',$year);
	$resultcont = $stmtcont->execute();

if($resultcreate||$resultcreatechange||$resultcont){
echo "Success!! Assessment has been created";
}
else{
echo "Failure!! Failed to create test. Please try again later.";

}
}

if($assessmenttype == "exam"){
	$sqlexam= "INSERT INTO exam(created_at, created_by_firstname, created_by_lastname, assessment_id,  email, target_class, subject, month, year)
	VALUES(:created_at, :created_by_firstname, :created_by_lastname, :assessment_id, :email, :target_class, :subject, :month, :year)";
	$stmtexam = $user_home->runQuery($sqlexam);
	$stmtexam->bindValue(':created_at' ,$date_created);
	$stmtexam->bindValue(':created_by_firstname', $createdbyfirstname);
	$stmtexam->bindValue(':created_by_lastname', $createdbylastname);
	$stmtexam->bindValue(':assessment_id',$assessmentid);
	$stmtexam->bindValue(':email',$email);
	$stmtexam->bindValue(':target_class',$targetclass);
	$stmtexam->bindValue(':subject',$subject);
	$stmtexam->bindValue(':month',$month);
	$stmtexam->bindValue(':year',$year);
	$resultexam = $stmtexam->execute();

if($resultcreate||$resultcreatechange||$resultexam){
echo "Success!! Assessment has been created";
}
else{
echo "Failure!! Failed to create test. Please try again later.";

}
}
}
}
//IF THERE IS AN ERROR WITH THE DATABASE
catch(PDOException $e)
    {
			echo $e->getMessage();
    //die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
	}
?>
