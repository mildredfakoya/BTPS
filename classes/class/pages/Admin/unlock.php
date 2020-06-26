<?php include "includes/adminheader.php";

if(isset($_POST['unlock'])){
$assessmentid = !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
$accessstatus ="UNLOCKED";
try{
  $sqllock= "UPDATE btps_new_assessment SET access_status ='$accessstatus' WHERE assessment_id = '$assessmentid'";
  $result = $user_home->runQuery4($sqllock);
  if($result){
    echo  "<div class='alert alert-success'>
  <strong>Assessment has been unlocked</strong>
</div>" ;
   header('refresh:3;unlock.php');
  }


}
catch(PDOException $e)
    {
    die('PLEASE ANSWER ALL QUESTIONS');
	}
}

$sqlreview= "SELECT * FROM btps_new_assessment WHERE access_status ='LOCKED'";
$stmtreview = $user_home->runQuery($sqlreview);
$stmtreview->execute();
echo '<div class ="container">';
echo '<h5 class ="header">Unlock an assessment</h5>';
echo '<p>Click on the button that holds the assessment ID to unlock the assessment</p>';
foreach($stmtreview as $rowreview){
?>

  <form method ="post">
    <input type ="hidden" name ="assessmentid" value ="<?php echo $rowreview['assessment_id']?>">
    <input type ='submit' name ='unlock' value = '<?php echo $rowreview['assessment_id']?>' class = "btn btn-danger">
  </form>
<div class ="spacer"></div>



<?php
}
echo '</div>';
include "includes/adminfooter.php";
?>
