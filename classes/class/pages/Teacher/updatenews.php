<script>
$(document).ready(function(){

$("#updatenews").validate({
      rules: {
      title:"required",
      grade: "required",
			news: "required",
      },

        // Specify the validation error messages
      messages: {
        title:"Please enter a title",
        grade: "Please enter a grade",
  			news: "Please enter a news",
        },

      submitHandler: function(form) {
  var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"insertupdate.php",
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
$sql2a ="SELECT * FROM ihs_news WHERE email= :email ORDER BY created_at ASC LIMIT 1";
	    $stmt2a = $user_home->runQuery($sql2a);
	    $stmt2a->bindValue(':email', $email);
	    $stmt2a->execute();
		  $row3 = $stmt2a->fetch(PDO::FETCH_ASSOC);
?>
<div class ="jumbotron">
<form method ="post" id ='updatenews' novalidate ='novalidate'>
<div class ='row'>
<div class ='col-3'><label><strong>TITLE</strong></label></div>
<div class ='col-3 columnspacer'><label><strong>GRADE</strong></label></div>
<div class ='col-6 columnspacer'><label><strong>NEWS</strong></label></div>
</div>
<div class ='textspacer'></div>
<div class ="row">
<div class ='col-3'><input type ="text" name ="topic" value ="<?php echo $row3['topic'];?>"/></div>
<div class ='col-3 columnspacer'><select name="class" id ="grade">
<option value ="<?php echo $row3['class'];?>" selected><?php echo $row3['class'];?></option>
<option value = "prek">Pre-K</option>
<option value = "gradek">Grade K</option>
<option value = "grade1">Grade 1</option>
<option value = "grade2">Grade 2</option>
<option value = "grade3">Grade 3</option>
<option value = "grade4">Grade 4</option>
<option value = "grade5">Grade 5</option>
<option value = "grade6">Grade 6</option>
<option value = "grade7">Grade 7</option>
<option value = "grade8">Grade 8</option>
<option value = "grade9">Grade 9</option>
<option value = "grade10">Grade 10</option>
<option value = "grade11">Grade 11</option>
<option value = "general">General</option>
</select></div>
<div class ='col-6 columnspacer'>
	<label><span class ='previous'><?php echo $row3['details'];?></span></label><br/>
  <textarea name ="details" cols= 50 rows =10 class ="form-control" value ='<?php echo $row3['details'];?>'><?php echo $row3['details'];?></textarea>
</div>
<div class ='textspacer'></div>
<input type ='hidden' name ='hidden' value ='<?php echo $row3['id'];?>'>
<button type ="submit" name ="create" class ="btn btn-success">Update</button>
</form>
</div>
</div>
