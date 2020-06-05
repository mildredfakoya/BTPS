<?php
require_once 'includes/adminheader.php';
?>

<script>
 //script for form validation and submission.
$(document).ready(function(){
  $("#gradeinfo").validate({
 //specify the validation rules
  rules: {
		grade :"required",
  agerange:"required",
  info:"required"

    },

 // Specify the validation error messages
    messages: {
			grade: "required",
			agerange:"required",
		  info:"required"

    },

 //specify how the form should be submitted
  submitHandler: function(form) {
    var r = confirm('Are you ready to save the information?');
 	    if(r==true){
 	      $.ajax({
 //specify file for form processing
 		       url:"insertgradeinfo.php",
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
  <p class ="error">After creation of an information <a href ="http://localhost/BTPS/classes/class/pages/Admin/updateinfo.php">click here</a> to verify that the
  information entered is as intended before creating another information</p>
<!---for for grade 1 information-->
<form method = "post" id = "gradeinfo" novalidate ="novlidate">
	<fieldset>
		<legend>Please enter information that will be displayed on the landing page of the site</legend>
		<div class="form-group">
			<label for="grade">Grade:</label><br/>
			<select name ="grade" id ="grade">
				<option value ="" selected>[Choose here]</option>
				<option value ="prek">Pre - K</option>
				<option value ="gradek">Grade K</option>
				<option value ="grade1">Grade 1</option>
				<option value ="grade2">Grade 2</option>
				<option value ="grade3">Grade 3</option>
				<option value ="grade4">Grade 4</option>
				<option value ="grade5">Grade 5</option>
				<option value ="grade6">Grade 6</option>
				<option value ="grade7">Grade 7</option>
				<option value ="grade8">Grade 8</option>
				<option value ="grade9">Grade 9</option>
				<option value ="grade10">Grade 10</option>
				<option value ="grade11">Grade 11</option>
			</select>
		</div>
		<div class="form-group">
			<label for="agerange">Age Range:</label>
			<input type="text" class="form-control" id="agerange" placeholder="Age range" name="agerange">
		</div>

		<div class="form-group">
			<label for="grade1info">Information:</label>
			<textarea class="form-control"id="info" placeholder="information" name="info"></textarea>
		</div>
		<input type="submit" class="btn btn-primary" name ="save" value="Save">
      <div class ="spacer"></div>
	</fieldset>
</form>
</div>

<?php require_once 'includes/adminfooter.php';?>
