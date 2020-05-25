<?php
require_once 'includes/teacherinit.php';
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$sql = 'SELECT * FROM ihs_video_uploads WHERE created_by_firstname =:firstname AND created_by_lastname=:lastname ORDER BY created_at DESC';
$stmtuploads = $user_home->runQuery($sql);
$stmtuploads->bindValue(':firstname', $firstname);
$stmtuploads->bindValue(':lastname', $lastname);
$stmtuploads->execute();

foreach($stmtuploads as $row1){
?>
<form id ="form" method="post">

  <table>
<tr>
  <th>Date created</th>
  <th>Title</th>
  <th>Grade</th>
  <th>Subject</th>
  <th>Report</th>
  <th>File</th>
  <th></th>
</tr>
<tr>
  <td><?php echo $row1['created_at']?></td>
  <td><?php echo $row1['title']  ?></td>
  <td><?php echo $row1['grade']  ?></td>
  <td><?php echo $row1['subject'] ?></td>
  <td><?php echo $row1['report']?></td>
  <td><?php echo $row1['image']?></td>
  <td><input type='hidden' name='hiddenimage' value='<?php echo $row1['image']?>'><input type='submit' name='deletevideo' value='Delete' class ='btn btn-danger' style ='width:100%'/></td>
</tr>
  </table>
</form>
<?php
}
if(isset($_POST['deletevideo'])){
     date_default_timezone_set('America/dominica');
   	try{
        $sql = "DELETE FROM ihs_video_uploads WHERE image='$_POST[hiddenimage]'";
        $result = $user_home->runQuery4($sql);
       if ($result){
                       unlink($_POST['hiddenimage']);
                       $helper->redirect('success.php?deleted');
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
?>
