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
$grade= !empty($_POST['grade']) ? $helper->test_input($_POST['grade']) : null;
$age= !empty($_POST['agerange']) ? $helper->test_input($_POST['agerange']) : null;
$info= !empty($_POST['info']) ? $helper->test_input($_POST['info']) : null;



try{
 $sqlf="INSERT INTO btps_info(created_at, created_by_firstname, created_by_lastname, email, grade, ages, information)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :grade, :ages, :info)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtf->bindValue(':created_by_lastname', $createdbylastname);
 $stmtf->bindValue(':email', $createdbyemail);
 $stmtf->bindValue(':grade', $grade);
 $stmtf->bindValue(':ages', $age);
 $stmtf->bindValue(':info', $info);
 $resultf = $stmtf->execute();

 $sqlg="INSERT INTO btps_info_change(created_at, created_by_firstname, created_by_lastname, email, grade, ages, information)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :grade, :ages, :info)";
 $stmtg = $user_home->runQuery($sqlg);
 $stmtg->bindValue(':created_at', $datecreated);
 $stmtg->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtg->bindValue(':created_by_lastname', $createdbylastname);
 $stmtg->bindValue(':email', $createdbyemail);
 $stmtg->bindValue(':grade', $grade);
 $stmtg->bindValue(':ages', $age);
 $stmtg->bindValue(':info', $info);

 $resultg = $stmtg->execute();
  if($resultf&&$resultg){
		echo "SUCCESSFUL!! The inforamtion has been saved";
	   }
	   else{
		echo "Failure!! Save Failed";
	   }
}

 catch(PDOException $e)
    {
      //die("SYSTEM FAILURE!! Please contact your administrator");
   echo $e->getMessage();
    }



?>
