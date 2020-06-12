<?php
require_once 'includes/admininit.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;

date_default_timezone_set('America/dominica');
$datecreated = date("y-m-d h:i:sa");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$createdbyemail = $row['email'];
$subject= !empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
$grade= !empty($_POST['grade']) ? $helper->test_input($_POST['grade']) : null;


try{
 $sqlf="INSERT INTO btps_subject(created_at, created_by_firstname, created_by_lastname, email, subject, class)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :subject, :grade)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtf->bindValue(':created_by_lastname', $createdbylastname);
 $stmtf->bindValue(':email', $createdbyemail);
 $stmtf->bindValue(':subject', $subject);
 $stmtf->bindValue(':grade', $grade);
 $resultf = $stmtf->execute();

  if($resultf){
		echo "Success!! Subject has been added";
	   }
	   else{
		echo "Failure!! Subject was not added. Ensure that all fields are filled";
	   }
}

 catch(PDOException $e)
    {
      //die("SYSTEM FAILURE!! Please contact your administrator");
   echo $e->getMessage();
    }



?>
