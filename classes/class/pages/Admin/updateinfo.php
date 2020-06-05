<?php
require_once 'includes/admininit.php';
require_once 'includes/adminhead.php';
require_once 'includes/adminnav.php';
?>
<script>
$(document).ready(function(){

$("#updateinfo").validate({
  rules: {
    grade :"required",
  agerange:"required",
  information:"required"

    },

 // Specify the validation error messages
    messages: {
      grade: "required",
      agerange:"required",
      information:"required"

    },


      submitHandler: function(form) {
  var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"insertinfoupdate.php",
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
<?php

$email = $row['email'];
$sql2a ="SELECT * FROM btps_info WHERE email= :email ORDER BY created_at DESC Limit 1";
	    $stmt2a = $user_home->runQuery($sql2a);
	    $stmt2a->bindValue(':email', $email);
	    $stmt2a->execute();
		  $row3 = $stmt2a->fetch(PDO::FETCH_ASSOC);
?>
<div class ="jumbotron">
  <p class ="error">Only the last information enetered is displayed for update. If you desire to update other files in the past, <a href ="http://localhost/BTPS/classes/class/pages/Admin/information.php">click here</a> to recreate the information</p>
<form method ="post" id ='updateinfo' novalidate ='novalidate'>
<div class ='row'>
<div class ='col-3'><label><strong>Grade</strong></label></div>
<div class ='col-3 columnspacer'><label><strong>Age range</strong></label></div>
<div class ='col-6 columnspacer'><label><strong>Information</strong></label></div>
</div>
<div class ='textspacer'></div>
<div class ="row">
<div class ='col-3'><select name="grade" id ="grade">
<option value ="<?php echo $row3['grade'];?>" selected><?php echo $row3['grade'];?></option>
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
</select></div>
<div class ='col-3 columnspacer'><input type ="text" name ="agerange" value ="<?php echo $row3['ages'];?>"/></div>
<div class ='col-6 columnspacer'>
	<label><span class ='previous'><?php echo $row3['information'];?></span></label><br/>
  <textarea name ="information" cols= 50 rows =10 class ="form-control" value ='<?php echo $row3['information'];?>'><?php echo $row3['information'];?></textarea>
</div>
<div class ='textspacer'></div>
<input type ='hidden' name ='hidden' value ='<?php echo $row3['id'];?>'>
<button type ="submit" name ="create" class ="btn btn-success">Update</button>
</form>
</div>
</div>
<?php
require_once 'includes/adminfooter.php'; ?>
