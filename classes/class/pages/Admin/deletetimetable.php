<?php
require_once 'includes/adminheader.php';

#to delete timetable uploads
$sqltimetable = 'SELECT * FROM ihs_timetable_uploads ORDER BY created_at DESC';
$stmttimetable = $user_home->runQuery($sqltimetable);
$stmttimetable->execute();

echo '<div class ="jumbotron">';
echo '<h1 class ="error">Please be sure of the file you wish to delete before you click on the delete button. There is no delete confirmation. A click deletes the file and all traces of it.</h1>';
#create the delete table for  timetable uploads
foreach($stmttimetable as $rowtimetable){
  $firstname =$rowtimetable['created_by_firstname'];
  $lastname =$rowtimetable['created_by_lastname'];
  $email =$rowtimetable['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($email, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
?>


<h2>Time table Uploads</h2>
<form id ="form" method="post">
  <table>
<tr>
  <th>Date created</th>
  <th>Created by</th>
  <th>Email</th>
  <th>Grade</th>
  <th>File</th>
  <th></th>
</tr>
<tr>
  <td><?php echo $rowtimetable['created_at']  ?></td>
  <td><?php echo $dec.' '.$decl?></td>
  <td><?php echo $decemail ?></td>
  <td><?php echo $rowtimetable['grade'] ?></td>
  <td><?php echo $rowtimetable['file']?></td>
  <td><input type='hidden' name='hiddentables' value='<?php echo $rowtimetable['file']?>'><input type='submit' name='deletetable' value='Delete' class ='btn btn-danger' style ='width:100%'/></td>
</tr>
  </table>
</form>
<?php
}
echo "</div>";
if(isset($_POST['deletetable'])){
   	try{
        $sql = "DELETE FROM ihs_timetable_uploads WHERE file='$_POST[hiddentables]'";
        $result = $user_home->runQuery4($sql);
       if ($result){
                       unlink($_POST['hiddentables']);
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
