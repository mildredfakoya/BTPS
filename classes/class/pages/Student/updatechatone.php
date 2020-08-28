<?php
require_once 'includes/studentinit.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;

date_default_timezone_set('America/dominica');
$datecreated = date("y-m-d h:i:sa");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$createdbyemail = $row['email'];
$chatid = bin2hex(random_bytes(10));
$content= !empty($_POST['content']) ? $helper->test_input($_POST['content']) : null;


try{
 $sqlf="INSERT INTO chats1(created_at, created_by_email, chat_id, content)
 VALUES(:created_at, :created_by_email, :chat_id, :content)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_email', $createdbyemail);
 $stmtf->bindValue(':chat_id', $chatid);
 $stmtf->bindValue(':content', $content);
 $resultf = $stmtf->execute();

  if($resultf){
		echo "Chat has been created";
	   }
	   else{
		echo "Chat was not created";
	   }
}

 catch(PDOException $e)
    {
      //die("SYSTEM FAILURE!! Please contact your administrator");
   echo $e->getMessage();
    }



?>
