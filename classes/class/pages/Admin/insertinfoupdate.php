<?php
require_once 'includes/admininit.php';

date_default_timezone_set('America/dominica');
$datecreated = date("y-m-d h:i:sa");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$email = $row['email'];
$grade= !empty($_POST['grade']) ? $helper->test_input($_POST['grade']) : null;
$ages= !empty($_POST['agerange']) ? $helper->test_input($_POST['agerange']) : null;
$information= !empty($_POST['information']) ? $helper->test_input($_POST['information']) : null;
$id= $_POST['hidden'];

try{

    $sqlf = "UPDATE btps_info SET date_last_updated='$datecreated', updated_by_firstname ='$createdbyfirstname', updated_by_lastname ='$createdbylastname',
    grade ='$grade', ages ='$ages', information='$information' WHERE id ='$_POST[hidden]'";
    $resultf = $user_home->runQuery4($sqlf);


    $sqlg="INSERT INTO btps_info_change(created_at, created_by_firstname, created_by_lastname, email, grade, ages, information)
    VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :grade, :ages, :information)";
    $stmtg = $user_home->runQuery($sqlg);
    $stmtg->bindValue(':created_at', $datecreated);
    $stmtg->bindValue(':created_by_firstname', $createdbyfirstname);
    $stmtg->bindValue(':created_by_lastname', $createdbylastname);
    $stmtg->bindValue(':email', $email);
    $stmtg->bindValue(':grade', $grade);
    $stmtg->bindValue(':ages', $ages);
    $stmtg->bindValue(':information', $information);

    $resultg = $stmtg->execute();
    if($resultf && $resultg){
  		echo "Success!! Information has been updated. Check the target class to ensure that the news appears";
  	   }
  	   else{
  		echo "Failure!! information was not updated. Ensure that all fields are correctly filled in";
  	   }
  }

   catch(PDOException $e)
      {
        //die("SYSTEM FAILURE!! Please contact your administrator");
     echo $e->getMessage();
      }




?>
