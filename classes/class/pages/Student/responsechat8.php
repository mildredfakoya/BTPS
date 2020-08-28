<?php
require_once 'includes/studentinit.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;

date_default_timezone_set('America/dominica');
$createdat = date("y-m-d h:i:sa");
$createdbyemail = $row['email'];
$chatid= !empty($_POST['chatidres']) ? $helper->test_input($_POST['chatidres']) : null;
$content= !empty($_POST['respond']) ? $helper->test_input($_POST['respond']) : null;
$recipientmail= !empty($_POST['recipientres']) ? $helper->test_input($_POST['recipientres']) : null;



try{
 $sqlf="INSERT INTO chats8(created_at, created_by_email, chat_id,  content, recipient_mail)
 VALUES(:created_at, :created_by_email, :chat_id,  :content, :recipient_mail)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $createdat);
 $stmtf->bindValue(':created_by_email', $createdbyemail);
 $stmtf->bindValue(':chat_id', $chatid);
 $stmtf->bindValue(':content', $content);
 $stmtf->bindValue(':recipient_mail', $recipientmail);
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
