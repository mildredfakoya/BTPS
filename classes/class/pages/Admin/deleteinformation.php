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

#to delete information entry
$sqlinfo = 'SELECT * FROM btps_info ORDER BY created_at DESC';
$stmtinfo = $user_home->runQuery($sqlinfo);
$stmtinfo->execute();




#create the visitor information table
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

  <h2>Visitors Information Content</h2>
<form id ="form" method="post">
  <table>
<tr>
  <th>Date created</th>
  <th>Created by</th>
  <th>Email</th>
  <th>Grade</th>
  <th>Ages</th>
  <th>Information</th>
  <th></th>
</tr>
<tr>
  <td><?php echo $rowinfo['created_at']  ?></td>
  <td><?php echo $dec.' '.$decl?></td>
  <td><?php echo $decemail ?></td>
  <td><?php echo $rowinfo['grade']?></td>
  <td><?php echo $rowinfo['ages']?></td>
  <td><?php echo $rowinfo['information']?></td>
  <td><input type='hidden' name='hiddeninfo' value='<?php echo $rowinfo['information']?>'><input type='submit' name='deleteinfo' value='Delete' class ='btn btn-danger' style ='width:100%'/></td>
</tr>
  </table>
</form>
<?php
}

            if(isset($_POST['deleteinfo'])){
               	try{
                    $sql = "DELETE FROM btps_info WHERE information='$_POST[hiddeninfo]'";
                    $result = $user_home->runQuery4($sql);
                   if ($result){
                                   $helper->redirect('success.php?tabledeleted');
                                 }
                    else{
                      echo "Update Failed";

                    }

                }
                catch(PDOException $e)
                    {
                    die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
                    }
                }
}
require_once 'includes/adminfooter.php';?>
