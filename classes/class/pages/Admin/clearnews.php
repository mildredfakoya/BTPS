<?php
require_once 'includes/adminheader.php';
$email = $row['email'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];

$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("deletes", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<div class ="container">
  <div class ="outer">
  </div>
</div>

<?php
#delete News from all class news / Clear all the news for the term
$sqlinfo = 'SELECT * FROM ihs_news ORDER BY created_at DESC';
$stmtinfo = $user_home->runQuery($sqlinfo);
$stmtinfo->execute();

echo '<div class ="container">';

#create the news table
foreach($stmtinfo as $rowinfo){
  $firstname =$rowinfo['created_by_firstname'];
  $lastname =$rowinfo['created_by_lastname'];
  $email =$rowinfo['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($email, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
?>


<form id ="form" method="post">
  <table>
<tr>
  <th>Date created</th>
  <th>Created by</th>
  <th>Email</th>
  <th>Topic</th>
  <th>Class</th>
  <th>Details</th>
</tr>
<tr>
  <td><?php echo $rowinfo['created_at']  ?></td>
  <td><?php echo $dec.' '.$decl?></td>
  <td><?php echo $decemail ?></td>
  <td><?php echo $rowinfo['topic']?></td>
  <td><?php echo $rowinfo['class']?></td>
  <td><?php echo $rowinfo['details']?></td>
</tr>
<?php
}
?>
  </table>
  <input type = "submit" name ="clearallnews" value = "Clear all news and reset classes" class ="btn btn-danger btn-large">
</form>
</div>
<?php
            if(isset($_POST['clearallnews'])){
               	try{
                    $sql = "DELETE FROM ihs_news";
                    $sql2 = "DELETE FROM ihs_news_change";
                    $result = $user_home->runQuery4($sql);
                    $result2 = $user_home->runQuery4($sql2);
                   if ($result && $result2){
                                   $helper->redirect('success.php?tabledeleted');
                                 }
                    else{
                      echo "Failure!! Unable to clear the news";

                    }

                }
                catch(PDOException $e)
                    {
                    die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
                    }
                }
}
require_once 'includes/adminfooter.php';?>
