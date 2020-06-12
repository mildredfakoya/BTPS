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
<?php
#for multichoice Questions
$sqlmulti= "SELECT * FROM btps_multichoice WHERE assessment_id = :id ORDER BY id";
$stmtmulti = $user_home->runQuery($sqlmulti);
$stmtmulti->bindValue(':id', $assessmentid);
$stmtmulti->execute();

#for true or false
$sqlbool= "SELECT * FROM btps_boolean WHERE assessment_id = :id ORDER BY id";
$stmtbool = $user_home->runQuery($sqlbool);
$stmtbool->bindValue(':id', $assessmentid);
$stmtbool->execute();

# for essay Questions

$sqlessay= "SELECT * FROM btps_essay WHERE assessment_id = :id ORDER BY id";
$stmtessay = $user_home->runQuery($sqlessay);
$stmtessay->bindValue(':id', $assessmentid);
$stmtessay->execute();

#for fill in the blank Questions
$sqlblank= "SELECT * FROM btps_blank WHERE assessment_id = :id ORDER BY id";
$stmtblank = $user_home->runQuery($sqlblank);
$stmtblank->bindValue(':id', $assessmentid);
$stmtblank->execute();
?>
<div class ="jumbotron">
  <table>
<tr>
  <th>Question ID</th>
  <th>Question text</th>
  <th>Option 1</th>
  <th>Option 2</th>
  <th>Option 3</th>
  <th>Option 4</th>
  <th>Answer</th>
  <th>Answer guide / Keyword</th>
  <th>Topic</th>
  <th>Feedback</th>
</tr>

<?php
foreach ($stmtmulti as $key) {
echo "<tr><td>". $key['question_id']. "</td>";
echo "<td>". htmlspecialchars_decode($key['question_text']). "</td>";
echo "<td>". $key['option1']. "</td>";
echo "<td>". $key['option2']. "</td>";
echo "<td>". $key['option3']. "</td>";
echo "<td>". $key['option4']. "</td>";
echo "<td>". $key['answer']. "</td>";
echo "<td></td>";
echo "<td>". $key['topic']. "</td>";
echo "<td>". $key['feedback']. "</td></tr>";

}

foreach ($stmtbool as $keybool) {
echo "<tr><td>". $keybool['question_id']. "</td>";
echo "<td>". htmlspecialchars_decode($keybool['question_text']). "</td>";
echo "<td>". $keybool['option1']. "</td>";
echo "<td>". $keybool['option2']. "</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>". $keybool['answer']. "</td>";
echo "<td></td>";
echo "<td>". $keybool['topic']. "</td>";
echo "<td>". $keybool['feedback']. "</td></tr>";

}

foreach ($stmtessay as $keyessay) {
echo "<tr><td>". $keyessay['question_id']. "</td>";
echo "<td>". htmlspecialchars_decode($keyessay['question_text']). "</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>". $keyessay['answer_guide']. "</td>";
echo "<td>". $keyessay['topic']. "</td>";
echo "<td>". $keyessay['feedback']. "</td></tr>";

}

foreach ($stmtblank as $keyblank) {
echo "<tr><td>". $keyblank['question_id']. "</td>";
echo "<td>". htmlspecialchars_decode($keyblank['question_text']). "</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>". $keyblank['answer_keyword']. "</td>";
echo "<td>". $keyblank['topic']. "</td>";
echo "<td>". $keyblank['feedback']. "</td></tr>";

}
?>
</table>

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
 </select>
  </div>
  </div>
  <input type ="hidden" value ="<?php echo $rowfindassessment['assessment_id']?>" name ="assessmentid">
  <input type ="hidden" value ="<?php echo $rowfindassessment['target_class']?>" name ="class">
  <input type ="hidden" value ="<?php echo $rowfindassessment['subject']?>" name ="subject">
  <input type = "submit" name ="submittype" value ="Create Question">
</form>
</div>
<?php

}
else{
  echo "The assessment ID that you entered was not found. Ensure that you have entered the correct ID and the assessment was originally created by you. Redirecting....";
  header('refresh:10;getassessment.php');
}
}
else{
  echo "Please enter an assessment ID";
  header('refresh:7;getassessment.php');
}
}




include_once "includes/teacherfooter.php";
?>
</div>
