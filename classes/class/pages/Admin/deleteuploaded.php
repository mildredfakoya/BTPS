<?php
require_once 'includes/adminheader.php';

#to delete timetable uploads
$sqltimetable = 'SELECT * FROM ihs_timetable_uploads ORDER BY created_at DESC';
$stmttimetable = $user_home->runQuery($sqltimetable);
$stmttimetable->execute();

#to delete food menu uploads
$sqlmenu = 'SELECT * FROM ihs_menu_uploads ORDER BY created_at DESC';
$stmtmenu = $user_home->runQuery($sqlmenu);
$stmtmenu->execute();

#to delete newsletter uploads
$sqlnewsletter = 'SELECT * FROM ihs_newsletter_uploads ORDER BY created_at DESC';
$stmtnewsletter = $user_home->runQuery($sqlnewsletter);
$stmtnewsletter->execute();
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
?>

<?php
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
?>



<?php

#create the delete for newsletter uploads
foreach($stmtnewsletter as $rowletter){
  $firstname =$rowletter['created_by_firstname'];
  $lastname =$rowletter['created_by_lastname'];
  $email =$rowletter['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();
  $emailn =new AES($email, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
?>

  <h2>Newsletter Uploads</h2>
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
  <td><?php echo $rowletter['created_at']  ?></td>
  <td><?php echo $dec.' '.$decl?></td>
  <td><?php echo $decemail ?></td>
  <td><?php echo $rowletter['monthnews'] ?></td>
  <td><?php echo $rowletter['file']?></td>
  <td><input type='hidden' name='hiddenletter' value='<?php echo $rowletter['file']?>'><input type='submit' name='deleteletter' value='Delete' class ='btn btn-danger' style ='width:100%'/></td>
</tr>
  </table>
</form>
<?php
}
if(isset($_POST['deleteletter'])){
   	try{
        $sql = "DELETE FROM ihs_newsletter_uploads WHERE file='$_POST[hiddenletter]'";
        $result = $user_home->runQuery4($sql);
       if ($result){
                       unlink($_POST['hiddenletter']);
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
?>
</div>

<?php require_once 'includes/adminfooter.php';?>
