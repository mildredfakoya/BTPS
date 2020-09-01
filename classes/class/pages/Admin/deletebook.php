<?php
require_once 'includes/adminheader.php';


#to delete teachers uploads
$sqlteachers = 'SELECT * FROM btps_library ORDER BY created_at DESC';
$stmtteachers = $user_home->runQuery($sqlteachers);
$stmtteachers->execute();

echo '<div class ="jumbotron">';
echo '<h1 class ="error">Please be sure of the file you wish to delete before you click on the delete button. There is no delete confirmation. A click deletes the file and all traces of it.</h1>';


#create the delete table for teachers uploads
foreach($stmtteachers as $rowteachers){
  $firstname =$rowteachers['created_by_firstname'];
  $lastname =$rowteachers['created_by_lastname'];
  $email =$rowteachers['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($email, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
?>

  <h2>Library Content</h2>
<form id ="form" method="post">
  <table>
<tr>
  <th>Date created</th>
  <th>Created by</th>
  <th>Book Title</th>
  <th>Class</th>
  <th>Subject</th>
  <th>Book</th>
  <th>Description</th>
  <th></th>
</tr>
<tr>
  <td><?php echo $rowteachers['created_at']  ?></td>
  <td><?php echo $dec.' '.$decl?></td>
  <td><?php echo $rowteachers['booktitle'] ?></td>
  <td><?php echo $rowteachers['class']?></td>
  <td><?php echo $rowteachers['subject']?></td>
  <td><?php echo $rowteachers['image']?></td>
  <td><?php echo $rowteachers['description']?></td>
  <td><input type='hidden' name='hiddenteachers' value='<?php echo $rowteachers['image']?>'><input type='submit' name='deleteteachers' value='Delete' class ='btn btn-danger' style ='width:100%'/></td>
</tr>
  </table>
</form>
<?php
}
?>
</div>

<?php

        if(isset($_POST['deleteteachers'])){
           	try{
                $sql = "DELETE FROM btps_library WHERE image='$_POST[hiddenteachers]'";
                $result = $user_home->runQuery4($sql);
               if ($result){
                               unlink($_POST['hiddenteachers']);
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
