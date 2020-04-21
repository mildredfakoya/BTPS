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
$email = $row['email'];
$title= !empty($_POST['title']) ? $helper->test_input($_POST['title']) : null;
$grade= !empty($_POST['grade']) ? $helper->test_input($_POST['grade']) : null;
$news= !empty($_POST['news']) ? $helper->test_input($_POST['news']) : null;
$id= $_POST['hidden'];

try{

    $sqlf = "UPDATE ihs_news SET date_last_updated='$datecreated', updated_by_firstname ='$createdbyfirstname', updated_by_lastname ='$createdbylastname',
    topic ='$title', class ='$grade', details='$news' WHERE id ='$_POST[hidden]'";
    $resultf = $user_home->runQuery4($sqlf);


    $sqlg="INSERT INTO ihs_news_change(created_at, created_by_firstname, created_by_lastname, email, topic, class, details)
    VALUES(:created_at, :created_by_firstname, :created_by_lastname, :email, :title, :grade, :news)";
    $stmtg = $user_home->runQuery($sqlg);
    $stmtg->bindValue(':created_at', $datecreated);
    $stmtg->bindValue(':created_by_firstname', $createdbyfirstname);
    $stmtg->bindValue(':created_by_lastname', $createdbylastname);
    $stmtg->bindValue(':email', $email);
    $stmtg->bindValue(':title', $title);
    $stmtg->bindValue(':grade', $grade);
    $stmtg->bindValue(':news', $news);

    $resultg = $stmtg->execute();
    if($resultf && $resultg){
  		echo "News has been updated. Check the target class to ensure that the news appears";
  	   }
  	   else{
  		echo "Failure!! News was not updated. Ensure that all fields are correctly filled in";
  	   }
  }

   catch(PDOException $e)
      {
        //die("SYSTEM FAILURE!! Please contact your administrator");
     echo $e->getMessage();
      }




?>
