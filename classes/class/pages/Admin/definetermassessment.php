<?php
require_once 'includes/adminheader.php';
$email = $row['email'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];

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
  $.dobPicker({
    yearSelector: '#academicyear', /* Required */
    yearDefault: 'Year', /* Optional */
    minimumAge: -2, /* Optional */
    maximumAge: 2 /* Optional */


  });
});



$(document).ready(function(){

$("#definition").validate({
  rules: {
			academicyear: "required",
			term: "required",
			class: "required",
			assignment: "required",
			projects:"required",
      contassess:"required",
      exam: "required",
      amin: "required",
      amax: "required",
      bmin: "required",
      bmax: "required",
      cmin: "required",
      cmax: "required",
      dmin: "required",
      dmax:"required",
      emin: "required",
      emax: "required",
      academicyear:"required"
  },

// Specify the validation error messages
  messages: {
    academicyear: "Please select an academic year",
    term: "Please select a term",
    class: "Please select a class",
    assignment: "Please enter a percentage",
    projects:"Please enter a percentage",
    contassess:"Please enter a percentage",
    exam: "Please enter a percentage",
    amin: "Please enter the minimum value for an A grade",
    amax: "Please enter the maximum value for an A grade",
    bmin: "Please enter the minimum value for a B grade",
    bmax: "Please enter the maximum value for a B grade",
    cmin: "Please enter the minimum value for a C grade",
    cmax: "Please enter the maximum value for a C grade",
    dmin: "Please enter the minimum value for a D grade",
    dmax: "Please enter the maximum value for a D grade",
    emin: "Please enter the minimum value for an E grade",
    emax: "Please enter the maximum value for an E grade",
    academicyear: "Please select the academic year",
  },

        submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"updatetermdefinition.php",
		  method:"post",
		  data:$('form').serialize(),
		  dataType:"text",
		   success:function(strMessage){
			  alert(strMessage);
			  location.reload();


		  }

	   })
	}
}
	})
     });



</script>
<div class ='jumbotron'>
  <div class ="outer">
    <div class ="header"><h5>Create Grading Scheme for term</h5></div>
    <div class ="container">
<form method = "post" id ="definition" novalidate = "novalidate" autocomplete="off">

<div class ="row">
  <div class ="col-5"><h4>Academic year</h4></div>
  <div class ="col-7 columnspacer">  <select name ="academicyear" id ="academicyear">
        <option value ="academicyear">[Select Year]</option>
      </select></div>

</div>
<div class ='textspacer'></div>

        <div class ="row">
          <div class ="col-5"><h4>Term in Academic Year</h4></div>
          <div class ="col-7 columnspacer">
           <select name ="term">
             <option value ="" selected disabled>[Choose Here]</option>
             <option value = "term_1">Term 1</option>
             <option value = "term_2">Term 2</option>
             <option value = "term_3">Term 3</option>
             <option value = "summer_school">Summer School</option>
             <option value = "virtual_term">Virtual Term</option>
             <option value = "after_school">After School Program</option>
           </select>
          </div>
        </div>

      <div class ="textspacer"></div>

        <div class ="row">
          <div class ="col-5"><h4>Class</h4></div>
          <div class ="col-7 columnspacer">
            <select name ='class'>
              <option value ="" selected disabled>[Choose Here]</option>
              <option value ="guest_student">Guest Student</option>
              <option value ="pre_k">Pre K</option>
              <option value ="grade_k">Grade K</option>
              <option value ="grade_1">Grade 1</option>
              <option value ="grade_2">Grade 2</option>
              <option value ="grade_3">Grade 3</option>
              <option value ="grade_4">Grade 4</option>
              <option value ="grade_5">Grade 5</option>
              <option value ="grade_6">Grade 6</option>
              <option value ="grade_7">Grade 7</option>
              <option value ="grade_8">Grade 8</option>
              <option value ="grade_9">Grade 9</option>
              <option value ="grade_10">Grade 10</option>
              <option value ="grade_11">Grade 11</option>
            </select>
          </div>
        </div>
       <div class ="textspacer"></div>

        <div class ="row">
          <div class ="col-5"><h4>Percentage for Assignments</h4></div>
          <div class ="col-7 columnspacer"><input type = 'number' name ='assignment' /></div>
        </div>
      <div class ="textspacer"></div>


      <div class ="row">
        <div class ="col-5"><h4>Percentage for Projects</h4></div>
        <div class ="col-7 columnspacer"><input type = 'number' name ='projects' /></div>
      </div>
    <div class ="textspacer"></div>

    <div class ="row">
      <div class ="col-5"><h4>Percentage for Continous Assessments</h4></div>
      <div class ="col-7 columnspacer"><input type = 'number' name ='contassess' /></div>
    </div>
  <div class ="textspacer"></div>

  <div class ="row">
    <div class ="col-5"><h4>Percentage for Examination</h4></div>
    <div class ="col-7 columnspacer"><input type = 'number' name ='exam' /></div>
  </div>
<div class ="textspacer"></div>
<div class ="header"><h4>Define Grades</h4></div>
<div class ='container'>
        <div class ="row">
          <div class ="col-5">Grade A Range</div>
          <div class ="col-7 columnspacer"><input type ='number' name ='amin' placeholder ='A Minimum'><input type = 'number' name ='amax' placeholder ='A Maximum'></div>
        </div>
<div class ='textspacer'></div>

        <div class ="row">
          <div class ="col-5">Grade B Range</div>
          <div class ="col-7 columnspacer"><input type ='number' name ='bmin' placeholder ='B Minimum'><input type = 'number' name ='bmax' placeholder ='B Maximum'></div>
        </div>

<div class ='textspacer'></div>

        <div class ="row">
          <div class ="col-5">Grade C Range</div>
          <div class ="col-7 columnspacer"><input type ='number' name ='cmin' placeholder ='C Minimum'><input type = 'number' name ='cmax' placeholder ='C Maximum'></div>
        </div>
<div class ='textspacer'></div>

        <div class ="row">
          <div class ="col-5">Grade D Range</div>
          <div class ="col-7 columnspacer"><input type ='number' name ='dmin' placeholder ='D Minimum'><input type = 'number' name ='dmax' placeholder ='D Maximum'></div>
        </div>
<div class ='textspacer'></div>

        <div class ="row">
          <div class ="col-5">Grade E Range</div>
          <div class ="col-7 columnspacer"><input type ='number' name ='emin' placeholder ='E Minimum'><input type = 'number' name ='emax' placeholder ='E Maximum'></div>
        </div>
</div>
<input type ="submit" name ="submit" value ="Define Grading Scheme" class ="btn btn-success">
      </form>
    </div>
  </div>

</div>


<?php
}
require_once 'includes/adminfooter.php';
?>
