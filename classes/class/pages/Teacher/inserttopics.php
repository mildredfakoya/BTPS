<?php
require_once 'includes/teacherinit.php';
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
$topic= !empty($_POST['topic']) ? $helper->test_input($_POST['topic']) : null;
$notes= !empty($_POST['notes']) ? $helper->test_input($_POST['notes']) : null;

try{
 $sqlf="INSERT INTO btps_topics(created_at, created_by_firstname, created_by_lastname, email, subject, grade, topics_covered, notes)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :subject, :grade, :topics_covered, :notes)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtf->bindValue(':created_by_lastname', $createdbylastname);
 $stmtf->bindValue(':email', $createdbyemail);
 $stmtf->bindValue(':subject', $subject);
 $stmtf->bindValue(':grade', $grade);
 $stmtf->bindValue(':topics_covered', $topic);
 $stmtf->bindValue(':notes', $notes);
 $resultf = $stmtf->execute();

  if($resultf){
		echo "Success!! Topic has been added";
	   }
	   else{
		echo "Failure!! Topic was not added. Ensure that all fields are filled";
	   }
}

 catch(PDOException $e)
    {
   die("SYSTEM FAILURE!! Please contact your administrator");
   #echo $e->getMessage();
    }



?>
