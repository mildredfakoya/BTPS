<?php
require_once 'includes/teacherinit.php';
error_reporting('E_ALL|E_STRICT');
$valid_extensions = array('mp4', 'jpg', 'png', 'gif', 'bmp' , 'pdf', 'docx', 'jpeg'); // valid extensions
$path = '../../uploads/'; // upload directory

if(!empty($_POST['title']) || $_FILES['image'])
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
$title= !empty($_POST['title']) ? $helper->test_input($_POST['title']) : null;
$grade= !empty($_POST['grade']) ? $helper->test_input($_POST['grade']) : null;
$subject= !empty($_POST['subject']) ? $helper->test_input($_POST['subject']) : null;
$report= !empty($_POST['report']) ? $helper->test_input($_POST['report']) : null;


try{
 $sqlf="INSERT INTO ihs_video_uploads(created_at, created_by_firstname, created_by_lastname, title, grade,subject, image, report)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :title, :grade, :subject, :file_name, :report)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtf->bindValue(':created_by_lastname', $createdbylastname);
 $stmtf->bindValue(':title', $title);
 $stmtf->bindValue(':grade', $grade);
 $stmtf->bindValue(':subject', $subject);
 $stmtf->bindValue(':file_name', $path);
 $stmtf->bindValue(':report', $report);

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
  echo "The image selected was not accepted. Please use another image / file format / file size";
}
}
else{
  echo "Please fill in all values";
}
?>
