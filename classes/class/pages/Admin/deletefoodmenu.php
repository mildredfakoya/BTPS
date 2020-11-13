<?php
require_once 'includes/adminheader.php';
#to delete food menu uploads
$sqlmenu = 'SELECT * FROM ihs_menu_uploads ORDER BY created_at DESC';
$stmtmenu = $user_home->runQuery($sqlmenu);
$stmtmenu->execute();
echo '<div class ="jumbotron">';
echo '<h1 class ="error">Please be sure of the file you wish to delete before you click on the delete button. There is no delete confirmation. A click deletes the file and all traces of it.</h1>';

#create the delete table for food menu uploads
foreach($stmtmenu as $rowmenu){
  $firstname =$rowmenu['created_by_firstname'];
  $lastname =$rowmenu['created_by_lastname'];
  $email =$rowmenu['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($email, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
?>

<h2>Food menu uploads</h2>
<form id ="form" method="post">
  <table>
<tr>
  <th>Date created</th>
  <th>Created by</th>
  <th>Email</th>
  <th>Month</th>
  <th>File</th>
  <th></th>
</tr>
<tr>
  <td><?php echo $rowmenu['created_at']  ?></td>
  <td><?php echo $dec.' '.$decl?></td>
  <td><?php echo $decemail ?></td>
  <td><?php echo $rowmenu['month'] ?></td>
  <td><?php echo $rowmenu['file']?></td>
  <td><input type='hidden' name='hiddenmenu' value='<?php echo $rowmenu['file']?>'><input type='submit' name='deletemenu' value='Delete' class ='btn btn-danger' style ='width:100%'/></td>
</tr>
  </table>
</form>
<?php
}


?>
</div>

<?php

    if(isset($_POST['deletemenu'])){
       	try{
            $sql = "DELETE FROM ihs_menu_uploads WHERE file='$_POST[hiddenmenu]'";
            $result = $user_home->runQuery4($sql);
           if ($result){
                           unlink($_POST['hiddenmenu']);
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


require_once 'includes/adminfooter.php';?>
