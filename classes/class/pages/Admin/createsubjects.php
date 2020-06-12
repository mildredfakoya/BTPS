<?php require_once 'includes/adminheader.php';

#to view all the subjects added
#for multichoice Questions
$sqlsubjects= "SELECT * FROM btps_subject ORDER BY subject";
$stmtsubjects = $user_home->runQuery($sqlsubjects);
$stmtsubjects->execute();
?>

<div class ="jumbotron">
  <h5 class ="headeranimated">Already Listed Subjects</h5>
  <table>
<tr>
  <th>Date Created</th>
  <th>Subject</th>
  <th>Class</th>
</tr>

<?php
foreach ($stmtsubjects as $key) {
echo "<tr><td>". $key['created_at']. "</td>";
echo "<td>". $key['subject']. "</td>";
echo "<td>". $key['class']. "</td></tr>";

}
?>
</table>
</div>
<script>
 //script for form validation and submission.
$(document).ready(function(){
  $("#createsubject").validate({
 //specify the validation rules
  rules: {
    subject:"required",
    grade:"required",

    },

 // Specify the validation error messages
    messages: {
      subject:"required",
      grade:"required",

    },

 //specify how the form should be submitted
  submitHandler: function(form) {
    var r = confirm('Are you ready to save the information?');
 	    if(r==true){
 	      $.ajax({
 //specify file for form processing
 		       url:"insertsubjects.php",
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
<form method ="post" class ="form-group" novalidate ="novalidate" id ="createsubject">
<div class ="row">
  <div class ="col-4">
 <h2>Subject</h2>
  </div>
  <div class ="columnspacer col-8">
  <input type ="text" class="form-control" name ="subject" />
  </div>
</div>
<div class ="textspacer"></div>

<div class="row">
  <div class ="col-4">
<h2>Please select the target grade: </h2>
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
  <button type ="submit" name ="create" class ="btn btn-success">Create</button>
</form>

</div>
<?php require_once 'includes/adminfooter.php';?>
