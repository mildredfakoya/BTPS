<?php
require_once 'includes/teacherinit.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;

#$firstname =$row['firstname'];
#$lastname =$row['lastname'];
#$firstn =new AES($firstname, $inputkey, $blocksize);
#$dec =$firstn->decrypt();
#$lastn =new AES($lastname, $inputkey, $blocksize);
#$decl =$lastn->decrypt();

date_default_timezone_set('America/dominica');
$datecreated = date("y-m-d h:i:sa");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$createdbyemail = $row['email'];
$title= !empty($_POST['title']) ? $helper->test_input($_POST['title']) : null;
$grade= !empty($_POST['grade']) ? $helper->test_input($_POST['grade']) : null;
$news= !empty($_POST['news']) ? $helper->test_input($_POST['news']) : null;


try{
 $sqlf="INSERT INTO ihs_news(created_at, created_by_firstname, created_by_lastname, email, topic, class, details)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :title, :grade, :news)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtf->bindValue(':created_by_lastname', $createdbylastname);
 $stmtf->bindValue(':email', $createdbyemail);
 $stmtf->bindValue(':title', $title);
 $stmtf->bindValue(':grade', $grade);
 $stmtf->bindValue(':news', $news);
 $resultf = $stmtf->execute();

 $sqlg="INSERT INTO ihs_news_change(created_at, created_by_firstname, created_by_lastname, email, topic, class, details)
 VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :title, :grade, :news)";
 $stmtg = $user_home->runQuery($sqlg);
 $stmtg->bindValue(':created_at', $datecreated);
 $stmtg->bindValue(':created_by_firstname', $createdbyfirstname);
 $stmtg->bindValue(':created_by_lastname', $createdbylastname);
 $stmtg->bindValue(':email', $createdbyemail);
 $stmtg->bindValue(':title', $title);
 $stmtg->bindValue(':grade', $grade);
 $stmtg->bindValue(':news', $news);

 $resultg = $stmtg->execute();
  if($resultf&&$resultg){
		echo "News has been created. Check the target class to ensure that the news appears";
	   }
	   else{
		echo "Failure!! News was not created. Ensure that all fields are filled";
	   }
}

 catch(PDOException $e)
    {
      die("SYSTEM FAILURE!! Please contact your administrator");
   //echo $e->getMessage();
    }



?>
