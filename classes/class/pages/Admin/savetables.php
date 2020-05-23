<?php
require_once 'includes/admininit.php';
error_reporting('E_ALL|E_STRICT');
$valid_extensions = array('pdf','txt'); // valid extensions
$path = '../../timetables/'; // upload directory

if(!empty($_POST['grade']) &&  $_FILES['table'])
{
$img = $_FILES['table']['name'];
$tmp = $_FILES['table']['tmp_name'];

// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

// can upload same image using rand function
$final_image = rand(1000,1000000).$img;

// check's valid format
if(in_array($ext, $valid_extensions))
{
$path = $path.strtolower($final_image);

if(move_uploaded_file($tmp,$path))
{

date_default_timezone_set('America/dominica');
$datecreated = date("y-m-d h:i:sa");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$createdbyemail = $row['email'];
$grade= !empty($_POST['grade']) ? $helper->test_input($_POST['grade']) : null;


try{
 $sqlf="INSERT INTO ihs_timetable_uploads(created_at, created_by_firstname, created_by_lastname, email, grade, file)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :grade, :file)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtf->bindValue(':created_by_lastname', $createdbylastname);
 $stmtf->bindValue(':email', $createdbyemail);
 $stmtf->bindValue(':grade', $grade);
 $stmtf->bindValue(':file', $path);

 $resultf = $stmtf->execute();
  if($resultf){
		echo "Success!! File has been uploaded successfully";
	   }
	   else{
		echo "Failure!! File could not be uploaded at this time. Please stry again later";
	   }
}

 catch(PDOException $e)
    {
      die("SYSTEM FAILURE!! Please contact your administrator");
   //echo $e->getMessage();
    }

}
else{
  echo "Failed";
}
}
else{
  echo "The file selected was not accepted. Please choose another file format / file size";
}
}
else{
  echo "FAILED!!!! Please fill in all values";
}
?>
