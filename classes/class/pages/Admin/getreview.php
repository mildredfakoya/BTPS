<?php
require_once 'includes/adminheader.php';
$email = $row['email'];

$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("exams", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<script>
$(document).ready(function(){
  $("#updateapproval").validate({
 //specify how the form should be submitted
  submitHandler: function(form) {
    var r = confirm('Are you ready to save the information?');
       if(r==true){
         $.ajax({
 //specify file for form processing
            url:"updatereview.php",
            method:"post",
           data:$('form').serialize(),
            dataType:"text",
            success:function(strMessage){
             alert(strMessage);
              location.assign('reviewassessment.php');
            },
         })
       }
   }
  })
 });


</script>
<?php
if(isset($_POST['smt'])){
$assessmentid = !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
if(!empty($assessmentid)){
  echo "<h3 class ='header'>Assessment Questions for ".$assessmentid."</h3>";
  #for assessment settings
  $sqlassess= "SELECT * FROM btps_new_assessment WHERE assessment_id = :id ORDER BY id";
  $stmtassess = $user_home->runQuery($sqlassess);
  $stmtassess->bindValue(':id', $assessmentid);
  $stmtassess->execute();
  //date_default_timezone_set('America/dominica');
  $rowfindassessment = $stmtassess->fetch(PDO::FETCH_ASSOC);
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
  echo "<td><input type = 'submit' class ='btn btn-info' name ='updatemulti' value ='UPDATE'><input type = 'hidden' name ='hiddenmulti' value =".$key['question_id']."></td></tr>";
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
  echo "<td><input type = 'submit' class ='btn btn-info' name ='updatemulti' value ='UPDATE'><input type = 'hidden' name ='hiddenmulti' value =".$keybool['question_id']."></td></tr>";
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
  echo "<td><input type = 'submit' class ='btn btn-info' name ='updatemulti' value ='UPDATE'><input type = 'hidden' name ='hiddenmulti' value =".$keyessay['question_id']."></td></tr>";
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
  echo "<td><input type = 'submit' class ='btn btn-info' name ='updatemulti' value ='UPDATE'><input type = 'hidden' name ='hiddenmulti' value =".$keyblank['question_id']."></td></tr>";
  echo "</form>";
  }
?>
</table>
<div class = "container">
  <h5 class ="headeranimated">Review this assessment</h5>
  <form method = "post" novalidate id ="updateapproval">
  <div class ="row">
  <div class ="col-5"><strong><em>Review Status</em></strong></div>
  <div class ="col-7 columnspacer">
    <input type ="radio" name ="reviewstatus" value = "Reviewed" <?php if ($rowfindassessment['review_status'] == "Reviewed") echo "checked"; ?>>Reviewed<br/>
    <input type ="radio" name ="reviewstatus" value = "Not Reviewed" <?php if ($rowfindassessment['review_status'] == "Not Reviewed") echo "checked"; ?>>Not Reviewed</div>
  </div>
  <div class ="textspacer"></div>
  <div class ="row">
  <div class ="col-5"><strong><em>Review Note</em></strong></div>
  <div class ="col-7 columnspacer">
    <textarea value ="<?php echo $rowfindassessment['review_notes'];?>" name = "reviewnotes"><?php echo $rowfindassessment['review_notes'];?></textarea></div>
  </div>
  <div class ="textspacer"></div>
  <div class ="row">
  <div class ="col-5"><strong><em>Approval Status</em></strong></div>
  <div class ="col-7"><div class ="col-7 columnspacer">
    <input type ="radio" name ="approvalstatus" value = "Approved" <?php if ($rowfindassessment['approval_status'] == "Approved") echo "checked"; ?>>Approved<br/>
    <input type ="radio" name ="approvalstatus" value = "Not Approved" <?php if ($rowfindassessment['approval_status'] == "Not Approved") echo "checked"; ?>>Not Approved</div></div>
  </div>
  <input type ="hidden" name ="hiddenreview" value ="<?php echo $assessmentid?>">
  <button class ="btn btn-success" name = "save" value = "save">Update</button>
</form>

</div>





<?php
}else{
  echo "Refresh your page to ensure that the assessment id is displayed. If problem persists, contact your administrator";
}
}
}
include "includes/adminfooter.php";
?>
