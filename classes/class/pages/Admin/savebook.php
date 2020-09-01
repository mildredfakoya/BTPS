<?php
require_once 'includes/admininit.php';
error_reporting('E_ALL|E_STRICT');
$valid_extensions = array('doc' , 'pdf', 'docx'); // valid extensions
$path = '../../library/'; // upload directory

if(!empty($_POST['booktitle']) || $_FILES['image'])
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

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
$booktitle= !empty($_POST['booktitle']) ? $helper->test_input($_POST['booktitle']) : null;
$class= !empty($_POST['class']) ? $helper->test_input($_POST['class']) : null;
$subject= !empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
$description= !empty($_POST['description']) ? $helper->test_input($_POST['description']) : null;


try{
 $sqlf="INSERT INTO btps_library(created_at, created_by_firstname, created_by_lastname, email, booktitle, class,subject, image, description)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :booktitle, :class, :subject, :image, :description)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtf->bindValue(':created_by_lastname', $createdbylastname);
 $stmtf->bindValue(':email', $createdbyemail);
 $stmtf->bindValue(':booktitle', $booktitle);
 $stmtf->bindValue(':class', $class);
 $stmtf->bindValue(':subject', $subject);
 $stmtf->bindValue(':image', $path);
 $stmtf->bindValue(':description', $description);

 $resultf = $stmtf->execute();
  if($resultf){
		echo "Success!! Book has been added to the Library";
	   }
	   else{
		echo "Failure!! Book was not added at this time. Please stry again later";
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
  echo "The File selected was not accepted. Please use another file format / file size";
}
}
else{
  echo "Please fill in all values";
}
?>
