<?php
ob_start();
// include header files
include_once "includes/teacherheader.php";
// when the form is submitted
if (isset($_POST['submit'])) {
?>
<script>
$(document).ready(function(){
  $("#submitreview").validate({
 //specify how the form should be submitted
  submitHandler: function(form) {
    var r = confirm('Are you ready to save the information?');
       if(r==true){
         $.ajax({
 //specify file for form processing
            url:"submitreview.php",
            method:"post",
           data:$('form').serialize(),
            dataType:"text",
            success:function(strMessage){
             alert(strMessage);
              location.reload();
            },
         })
       }
   }
  })
 });



</script>

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
# if assessment has been submitted for review:
$sqlreview= "SELECT * FROM btps_new_assessment WHERE assessment_id = :id";
$stmtreview = $user_home->runQuery($sqlreview);
$stmtreview->bindValue(':id', $assessmentid);
$stmtreview->execute();
$rowreview = $stmtreview->fetch(PDO::FETCH_ASSOC);

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
  <th class ="error">Edit this Question</th>
</tr>

<?php
foreach ($stmtmulti as $key) {
echo "<form method ='post' action = 'updatemulti.php'><tr><td>". $key['question_id']."</td>";
echo "<td>". htmlspecialchars_decode($key['question_text']). "</td>";
echo "<td>". $key['option1']. "</td>";
echo "<td>". $key['option2']. "</td>";
echo "<td>". $key['option3']. "</td>";
echo "<td>". $key['option4']. "</td>";
echo "<td>". $key['answer']. "</td>";
echo "<td></td>";
echo "<td>". $key['topic']. "</td>";
echo "<td>". $key['feedback']."</td>";
echo "<td><input type = 'submit' class ='btn btn-info' name ='updatemulti' value ='UPDATE'><br/><input type = 'submit' class ='btn btn-danger' name ='deletemulti' value ='DELETE'><input type = 'hidden' name ='hiddenmulti' value =".$key['question_id']."></td></tr>";
echo "</form>";
}


foreach ($stmtbool as $keybool) {
echo "<form method ='post' action = 'updatebool.php'><tr><td>". $keybool['question_id']."</td>";
echo "<td>". htmlspecialchars_decode($keybool['question_text']). "</td>";
echo "<td>". $keybool['option1']. "</td>";
echo "<td>". $keybool['option2']. "</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>". $keybool['answer']. "</td>";
echo "<td></td>";
echo "<td>". $keybool['topic']. "</td>";
echo "<td>". $keybool['feedback']. "</td>";
echo "<td><input type = 'submit' class ='btn btn-info' name ='updatemulti' value ='UPDATE'><br/><input type = 'submit' class ='btn btn-danger' name ='deletemulti' value ='DELETE'><input type = 'hidden' name ='hiddenmulti' value =".$keybool['question_id']."></td></tr>";
echo "</form>";

}

foreach ($stmtessay as $keyessay) {
echo "<form method ='post' action = 'updateessay.php'><tr><td>". $keyessay['question_id']."</td>";
echo "<td>". htmlspecialchars_decode($keyessay['question_text']). "</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>". $keyessay['answer_guide']. "</td>";
echo "<td>". $keyessay['topic']. "</td>";
echo "<td>". $keyessay['feedback']. "</td>";
echo "<td><input type = 'submit' class ='btn btn-info' name ='updatemulti' value ='UPDATE'><br/><input type = 'submit' class ='btn btn-danger' name ='deletemulti' value ='DELETE'><input type = 'hidden' name ='hiddenmulti' value =".$keyessay['question_id']."></td></tr>";
echo "</form>";
}

foreach ($stmtblank as $keyblank) {
echo "<form method ='post' action = 'updateblank.php'><tr><td>". $keyblank['question_id']."</td>";
echo "<td>". htmlspecialchars_decode($keyblank['question_text']). "</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>". $keyblank['answer_keyword']. "</td>";
echo "<td>". $keyblank['topic']. "</td>";
echo "<td>". $keyblank['feedback']. "</td>";
echo "<td><input type = 'submit' class ='btn btn-info' name ='updatemulti' value ='UPDATE'><br/><input type = 'submit' class ='btn btn-danger' name ='deletemulti' value ='DELETE'><input type = 'hidden' name ='hiddenmulti' value =".$keyblank['question_id']."></td></tr>";
echo "</form>";
}
?>
</table>
   <div class ="spacer"></div>
   <?php
    if($rowfindassessment['approval_status'] =='Approved'){
      echo " <h5 class ='error'>This assessment has been approved. You can no longer add questions</h5>";
    }
    else{
    ?>
  <button class="button" value="add question" id ="addquestion">Add question</button>
<?php }
?>
  <br/><br/>
  <p class="error">Please note that submission of assessment for review is final. Once submitted, it will be sent to admin for approval</p>
<?php
if($rowreview['submitted_review'] == 'Submitted'){
    echo "<h4>This assesssment has been submitted for review</h4>";
  }
  else{
   ?>
  <form method = "post" novalidate id = "submitreview">
    <input type ="hidden" value ="<?php echo $rowfindassessment['assessment_id']?>" name ="submithidden">
    <button class="button" name = "submitreview">Submit for Review</button>
  </form>
<?php
};
?>
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
