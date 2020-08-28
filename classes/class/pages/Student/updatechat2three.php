<?php
require_once 'includes/studentinit.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;

date_default_timezone_set('America/dominica');
$datecreated = date("y-m-d h:i:sa");
$createdbyemail = $row['email'];
$chatid = bin2hex(random_bytes(10));
$content= !empty($_POST['content2']) ? $helper->test_input($_POST['content2']) : null;
$recipient= !empty($_POST['recipient']) ? $helper->test_input($_POST['recipient']) : null;

$encrec = new AES($recipient, $inputkey, $blocksize);
$recn = $encrec->encrypt();
$encrec->setData($recn);


try{
 $sqlf="INSERT INTO chats3(created_at, created_by_email, chat_id, content, recipient_mail)
 VALUES(:created_at, :created_by_email, :chat_id, :content, :recipient_mail)";
 $stmtf = $user_home->runQuery($sqlf);
 $stmtf->bindValue(':created_at', $datecreated);
 $stmtf->bindValue(':created_by_email', $createdbyemail);
 $stmtf->bindValue(':chat_id', $chatid);
 $stmtf->bindValue(':content', $content);
 $stmtf->bindValue(':recipient_mail', $recn);
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
