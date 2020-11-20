<?php
require_once 'includes/teacherheader.php';
$firstname = $row['firstname'];
$lastname = $row['lastname'];


$sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
$stmtcurrent = $user_home->runQuery($sqlcurrent);
$stmtcurrent->execute();
$rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM btps_new_assessment WHERE created_by_firstname =:firstname AND created_by_lastname=:lastname AND term = :term AND academic_year = :academicyear ORDER BY created_at DESC';
$stmtuploads = $user_home->runQuery($sql);
$stmtuploads->bindValue(':firstname', $firstname);
$stmtuploads->bindValue(':lastname', $lastname);
$stmtuploads->bindValue(':term', $rowcurrent['current_term']);
$stmtuploads->bindValue(':academicyear', $rowcurrent['academic_year']);
$stmtuploads->execute();
echo "<div class ='container'>";
foreach($stmtuploads as $row1){
?>
<form id ="form" method="post">

  <table>
<tr>
  <th>Date created</th>
  <th>Assessment ID</th>
  <th>Target Class</th>
  <th>Assessment type</th>
  <th>Subject</th>
  <th></th>
</tr>
<tr>
  <td><?php echo $row1['created_at']?></td>
  <td><?php echo $row1['assessment_id']  ?></td>
  <td><?php echo $row1['target_class']  ?></td>
  <td><?php echo $row1['assessment_type'] ?></td>
  <td><?php echo $row1['subject']?></td>
  <td><input type='hidden' name='hiddenid' value='<?php echo $row1['assessment_id']?>'><input type='submit' name='deleteassessment' value='Delete' class ='btn btn-danger' style ='width:100%'/></td>
</tr>
  </table>
</form>
<?php
}
if(isset($_POST['deleteassessment'])){
     date_default_timezone_set('America/dominica');
   	try{
        $sql = "DELETE FROM btps_new_assessment WHERE assessment_id='$_POST[hiddenid]'";
        $result = $user_home->runQuery4($sql);
       if ($result){
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
echo "</div>";
require_once 'includes/teacherfooter.php';
?>
