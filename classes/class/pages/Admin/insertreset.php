<?php
ob_start();
require_once 'includes/admininit.php';
// SET THE TIME ZONE
date_default_timezone_set('America/dominica');
//AUTOMATICALLY SET THE DATE OF CREATION AND THE USER.
$date_created = date("y-m-d h:i:s");
$email = $row['email'];

$academicyear = !empty($_POST['academicyear']) ? $helper->test_input($_POST['academicyear']) : null;
$term = !empty($_POST['term']) ? $helper->test_input($_POST['term']) : null;

try{


	// insert into btps_new_assessment table
		 $sqlcreate= "INSERT INTO btps_reset_term(created_at, created_by_email, current_term, academic_year)
		 VALUES(:created_at, :created_by_email, :current_term, :academic_year)";
     $stmtcreate = $user_home->runQuery($sqlcreate);
		 $stmtcreate->bindValue(':created_at' ,$date_created);
		 $stmtcreate->bindValue(':created_by_email', $email);
		 $stmtcreate->bindValue(':current_term',$term);
		 $stmtcreate->bindValue(':academic_year',$academicyear);
		 $resultcreate = $stmtcreate->execute();


if($resultcreate){
echo "Success! The term has been reset";
}
else{
echo "Failure!! Unable to reset the term. Please try again later or contact administrator for support";

}
}


//IF THERE IS AN ERROR WITH THE DATABASE
catch(PDOException $e)
    {
			echo $e->getMessage();
    //die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
	}
?>
