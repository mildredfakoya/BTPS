<?php
require_once 'includes/teacherheader.php';
$email = $row['email'];
#to view all the subjects added
#for multichoice Questions
$sqltopics= "SELECT * FROM btps_topics WHERE email = :email";
$stmttopics = $user_home->runQuery($sqltopics);
$stmttopics->bindValue(':email',$email);
$stmttopics->execute();
?>
<script>
$(document).ready(function() {
  $('.summernote').summernote({
    maximumImageFileSize: 102400
  });
});
</script>
<div class ="jumbotron">
  <h5 class ="headeranimated">Created Topics</h5>
  <table>
<tr>
  <th>Date Created</th>
  <th>Subject</th>
  <th>Class</th>
  <th>Topics</th>
  <th>Notes</th>
</tr>

<?php
foreach ($stmttopics as $key) {
echo "<tr><td>". $key['created_at']. "</td>";
echo "<td>". $key['subject']. "</td>";
echo "<td>". $key['grade']. "</td>";
echo "<td>". $key['topics_covered']. "</td>";
echo "<td>". htmlspecialchars_decode($key['notes']). "</td></tr>";

}
?>
</table>
</div>

<script>
 //script for form validation and submission.
$(document).ready(function(){
  $("#createtopic").validate({
 //specify the validation rules
  rules: {
    topic:"required",
    grade:"required",
    subject:"required",

    },

 // Specify the validation error messages
    messages: {
      topic:"required",
      grade:"required",
      subject:"required",

    },

 //specify how the form should be submitted
  submitHandler: function(form) {
    var r = confirm('Are you ready to save the information?');
 	    if(r==true){
 	      $.ajax({
 //specify file for form processing
 		       url:"inserttopics.php",
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


<div class ="container">
  <h3 class ="headeranimated">Add new topic covered</h3>
<form method ="post" class ="form-group" novalidate ="novalidate" id ="createtopic">
<div class ="row">
  <div class ="col-4">
 <h5>Topic</h5>
  </div>
  <div class ="columnspacer col-8">
  <input type ="text" class="form-control" name ="topic" />
  </div>
</div>
<div class ="textspacer"></div>

<div class="row">
  <div class ="col-4">
<h5>Please select the target grade: </h5>
</div>
<div class ="col-8 columnspacer">
<select name="grade" id ="grade">
<option value ="" selected disabled>[Choose here]</option>
<option value = "pre_k">Pre-K</option>
<option value = "grade_k">Grade K</option>
<option value = "grade_1">Grade 1</option>
<option value = "grade_2">Grade 2</option>
<option value = "grade_3">Grade 3</option>
<option value = "grade_4">Grade 4</option>
<option value = "grade_5">Grade 5</option>
<option value = "grade_6">Grade 6</option>
<option value = "grade_7">Grade 7</option>
<option value = "grade_8">Grade 8</option>
<option value = "grade_9">Grade 9</option>
<option value = "grade_10">Grade 10</option>
<option value = "grade_11">Grade 11</option>
<option value = "general">General</option>
</select>
</div>
</div>
<div class ="row">
  <div class ="col-4">
 <h5>Please select a subject</h5>
  </div>
  <div class ="columnspacer col-8">
    <select name ="subject">
      <option selected disabled>[choose here]</option>
      <?php
      $sqltopic = "SELECT DISTINCT subject FROM btps_subject";
      $stmttopic = $user_home->runQuery($sqltopic);
     $stmttopic->execute();
    while ($rowtopic = $stmttopic->fetch(PDO::FETCH_ASSOC)) {
       echo "<option value='" . $rowtopic['subject'] . "'>" . $rowtopic['subject'] . "</option>";
    }
  ?>
</select>
  </div>
</div>
<div class ="textspacer"></div>
<div class ="row">
  <div class ="col-4">
 <h5>Study Guide</h5>
  </div>
  <div class ="columnspacer col-8">
  <textarea class="summernote" name ="notes"></textarea>
  </div>
</div>
<div class ="textspacer"></div>
  <button type ="submit" name ="create topic" class ="btn btn-success">Create</button>
</form>

</div>
<?php require_once 'includes/teacherfooter.php';?>
