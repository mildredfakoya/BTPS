<?php
require_once "includes/teacherheader.php";

if(!in_array("assessment", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
function random_strings($length_of_string)
{
    // String of all alphanumeric character and some special characters
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz&!#@$';
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
}

$assessment_id = random_strings(6);
$access_passwd = random_strings(8);
?>
<script>
//script for form validation and submission.
$(document).ready(function(){
$("#insertassessment").validate({
rules: {
      assessment_id: "required",
      access_password: "required",
      intendedaccessday: "required",
      intendedaccessmonth: "required",
      intendedaccessyear: "required",
			intendedcloseday: "required",
			intendedclosemonth: "required",
			intendedcloseyear: "required",
			assessment_type: "required",
			target_class: "required",
			subject: "required",
},

// Specify the validation error messages
messages: {
  assessment_id: "required",
  access_password:"required",
  intendedaccessday: "required",
  intendedaccessmonth: "required",
  intendedaccessyear: "required",
  intendedcloseday: "required",
  intendedclosemonth: "required",
  intendedcloseyear: "required",
  assessment_type: "required",
  target_class: "required",
  subject: "required",
},

submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"insertassessment.php",
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

//script for date picker

$(document).ready(function(){
  $.dobPicker({
    daySelector: '#intendedday', /* Required */
    monthSelector: '#intendedmonth', /* Required */
    yearSelector: '#intendedyear', /* Required */
    dayDefault: 'Day', /* Optional */
    monthDefault: 'Month', /* Optional */
    yearDefault: 'Year', /* Optional */
    minimumAge: 0, /* Optional */
    maximumAge: 100 /* Optional */

});
});

$(document).ready(function(){
  $.dobPicker({
    daySelector: '#closeday', /* Required */
    monthSelector: '#closemonth', /* Required */
    yearSelector: '#closeyear', /* Required */
    dayDefault: 'Day', /* Optional */
    monthDefault: 'Month', /* Optional */
    yearDefault: 'Year', /* Optional */
    minimumAge: 0, /* Optional */
    maximumAge: 100 /* Optional */


  });
});

</script>

<!--The User Interface Form -->
<div class ="jumbotron row">
<div class ="col-4 container">
<h4>Please read before filling the form</h4>
<p class ='error'>Note: The assessment id is automatically generated 6 character code. Please copy the ID for future use.
  The assessment_id is regenerated every time the page is refreshed. Please ensure you copy the ID just before a sucessful creation.</p>
<h5>THE ACCESS PASSWORD IS AUTO GENERATED 8 CHARACTER CODE. STUDENTS WILL NEED THIS CODE TO BE ABLE TO START ACCESS AN ASSESSMENT. PLEASE MAKE NOT OF THIS CODE.</h5>
<p>After the assessment has been created, it will be sent automatically by the system for approval. Assessment will become visible to students once it is approved.</p>
</div>
<div class ="col-8 columnspacer">
<h1>Create a new assessment</h1>
<p><em>Note: This is a one time creation form. For update of a previously created assessment, use the <strong><a href ="#">Name the link here</a>.</strong></em></p>
<p class ="error">If this is an examination, please use the <a href ="#"><strong>exam creation page link here</strong></a>.</p>
<form method ="post" name ="assessment" id ='insertassessment' novalidate ="novalidate" autocomplete ="off">
<h4>Assessment Settings</h4>
<div class="row">
<label class="col-5">Assessment ID</label>
<div class="col-7 columnspacer">
<input type ="text" name ="assessment_id" value = "<?php echo $assessment_id?>" readonly>
 </div>
</div>
<div class ="textspacer"></div>
<div class="row">
<label class="col-5">Access password</label>
<div class="col-7 columnspacer">
<input type ="text" name ="access_password" value = "<?php echo $access_passwd?>" readonly>
 </div>
</div>
<div class ="textspacer"></div>
<div class="row">
<label class="col-5">Intended date of assessment</label>
<div class="col-7 columnspacer">
<div class="row">
<div class="col-4">
<select id="intendedday" name ='intendedaccessday'></select>
</div>
<div class="col-4">
<select id="intendedmonth" name ='intendedaccessmonth'></select>
</div>
<div class="col-4">
<select id="intendedyear" name ='intendedaccessyear'></select>
</div>
</div>
 </div>
</div>
<div class ="textspacer"></div>
<div class="row">
<label class="col-5">Intended assessment close date</label>
<div class="col-7 columnspacer">
<div class="row">
<div class="col-4">
<select id="closeday" name ='intendedcloseday'></select>
</div>
<div class="col-4">
<select id="closemonth" name ='intendedclosemonth'></select>
</div>
<div class="col-4">
<select id="closeyear" name ='intendedcloseyear'></select>
</div>
</div>
 </div>
</div>
<div class ="textspacer"></div>
<div class="row">
<label class="col-5">Assessment_type</label>
<div class="col-7 columnspacer">
<select name ="assessment_type">
  <option selected value ="">[Choose Here]</option>
  <option value ="assignment">Assignment</option>
  <option value ="continous_assessment">Continous Assessment</option>
  <option value ="exam">Examination</option>
  <option value ="project">Project</option>
</select>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5">Target Class</label>
<div class="col-7 columnspacer">
<select name = "target_class">
<option selected disabled value ="">[Choose here]</option>
<option value ='prek'>Pre - K</option>
<option value ='gradek'>Grade K</option>
<option value ='grade1'>Grade 1</option>
<option value ='grade2'>Grade 2</option>
<option value ='grade3'>Grade 3</option>
<option value ='grade4'>Grade 4</option>
<option value ='grade5'>Grade 5</option>
<option value ='grade6'>Grade 6</option>
<option value ='grade7'>Grade 7</option>
<option value ='grade8'>Grade 8</option>
<option value ='grade9'>Grade 9</option>
<option value ='grade10'>Grade 10</option>
<option value ='grade11'>Grade 11</option>
<option value ='general'>General</option>
</select>
</div>
</div>
<div class="textspacer"></div>

<div class="row">
<label for="disabledSelect" class="col-5">Subject</label>
<div class="col-7 columnspacer">
  <select name="subject">
  <option value ="" selected disabled>[Choose here]</option>
  <option value = "biology">Biology</option>
  <option value = "caribbean_history">Caribbean History</option>
  <option value = "chemistry">Chemistry</option>
  <option value = "english">English</option>
  <option value = "food_nutrition">Food & Nutrition</option>
  <option value = "french">French</option>
  <option value = "general_science">General Science</option>
  <option value = "geography">Geography</option>
  <option value = "health_science">Health Science</option>
  <option value = "information_technology">Information Technology</option>
  <option value = "integrated_science">Integrated Science</option>
  <option value = "language_arts">Language Arts</option>
  <option value = "mathematics">Mathematics</option>
  <option value = "physics">Physics</option>
  <option value = "physical_education">Physical Education</option>
  <option value = "principles_of_business">Principles of Business</option>
  <option value = "social_studies">Social Studies</option>
  <option value = "spanish">Spanish</option>
  <option value = "visual_arts">Virtual Arts</option>
  <option value = "vocational">Vocational</option>
  <option value = "general">General Information</option>
  </select>
</div>
</div>
<div class ='spacer'></div>
<button type="submit" name="register" class="btn btn-success btn-block">Create Assessment</button>
</form>
</div>
</div>

<?php
}
require_once 'includes/teacherfooter.php';?>
