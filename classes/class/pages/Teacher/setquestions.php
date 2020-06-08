<?php
ob_start();
// include header files
include_once "includes/teacherheader.php";
// when the form is submitted
if (isset($_POST['submit'])) {
?>
<div class="container">
<h1 style='text-align:center'>Enter Questions</h1>
<?php
$assessmentid = !empty($_POST['id']) ? $helper->test_input($_POST['id']) : null;
$userfirst = $row['firstname'];
$userlast =$row['lastname'];
if (!empty($assessmentid) || $assessmentid != null) {
$sqlassessment= "SELECT * FROM btps_new_assessment WHERE assessment_id = :id AND created_by_firstname = :userfirst AND created_by_lastname = :userlast";
$stmtfindassessment = $user_home->runQuery($sqlassessment);
$stmtfindassessment->bindValue(':id', $assessmentid);
$stmtfindassessment->bindValue(':userfirst', $userfirst);
$stmtfindassessment->bindValue(':userlast', $userlast);
$stmtfindassessment->execute();

//Fetch the row.
date_default_timezone_set('America/dominica');
$rowfindassessment = $stmtfindassessment->fetch(PDO::FETCH_ASSOC);
#$today = strtotime("Today");
#$date = strtotime($rowfindsite['date']);
#if ($date === $today) {

#}
#else{

#}

if($rowfindassessment){
  $type = $rowfindassessment['assessment_type'];
  if($type =="assignment"){
    $sqlassignment= "SELECT * FROM btps_assignment WHERE assessment_id = :id AND created_by_firstname = :userfirst AND created_by_lastname = :userlast";
    $stmtassignment = $user_home->runQuery($sqlassignment);
    $stmtassignment->bindValue(':id', $assessmentid);
    $stmtassignment->bindValue(':userfirst', $userfirst);
    $stmtassignment->bindValue(':userlast', $userlast);
    $stmtassignment->execute();
    $rowassignment = $stmtassignment->fetch(PDO::FETCH_ASSOC);

?>
<script>
//toggle for form selection
$(document).ready(function () {
$("#selecttype").hide()
$("#addquestion").click(function () {
$("#selecttype").toggle()
});
})

</script>
<div class ="jumbotron">
  <button class="button" value="add question" id ="addquestion">Add question</button>
  </div>
  <div id ='selecttype' class ="container">
  <h3>Question Types</h3>
  <form method ="post" action = "processtype.php">
  <div class ='row'>
  <div class ='col-4'><p>Please a type for this question</p></div>
  <div class ='col-8 columnspacer'>
   <select name ="questiontype" required ="required">
   <option selected disabled>[Choose here]</option>
   <option value="multichoice">Multiple Choice</option>
   <option value ="true_false">True or False</option>
   <option value = "essay">Essay</option>
   <option value = "blank">Fill in the blank</option>
   <option value = "matching">Matching</option>
 </select>
  </div>
  </div>
  <input type ="hidden" value ="<?php echo $rowassignment['assessment_id']?>" name ="assessmentid">
  <input type = "submit" name ="submittype" value ="Create Question">
</form>
</div>
<?php





}
  if($type =="continous_assessment"){

  }
  if($type =="project"){

  }
}
else{
  echo "The assessment ID that you entered was not found. Ensure that you have entered the correct ID";
  header('refresh:10;getassessment.php');
}
}
else{
  echo "Please enter an assessment ID";
  header('refresh:5;getassessment.php');
}
}




include_once "includes/teacherfooter.php";
?>
</div>
