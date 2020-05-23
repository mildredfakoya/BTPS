<?php
require_once 'includes/admininit.php';
error_reporting('E_ALL|E_STRICT');
$valid_extensions = array('pdf'); // valid extensions
$path = '../../newsletter/'; // upload directory

if(!empty($_POST['monthnews']) &&  $_FILES['news'])
{
$img = $_FILES['news']['name'];
$tmp = $_FILES['news']['tmp_name'];

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
$month= !empty($_POST['monthnews']) ? $helper->test_input($_POST['monthnews']) : null;


try{
 $sqlf="INSERT INTO ihs_newsletter_uploads(created_at, created_by_firstname, created_by_lastname, email, monthnews, file)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :monthnews, :file)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtf->bindValue(':created_by_lastname', $createdbylastname);
 $stmtf->bindValue(':email', $createdbyemail);
 $stmtf->bindValue(':monthnews', $month);
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
