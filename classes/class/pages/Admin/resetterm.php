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
if(!in_array("records", $permissions)){
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
$("#resetterm").validate({
rules: {
  term: "required",
  academicyear : "required"
},

// Specify the validation error messages
messages: {
  term: "required",
  academicyear : "required",
},

submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"insertreset.php",
		  method:"post",
		  data:$('form').serialize(),
		  dataType:"text",
		  success:function(strMessage){
		  alert(strMessage);
		  location.assign('resetterm.php');
		  },
	   })
	}
}
})
});

</script>
<div class ="container">
  <div class ="outer">
    <div class ="header"><h4>Define a new term and academic year</h4></div>
    <form method ="post" novalidate id ="resetterm">
    <div class ="container">
      <div class ='row'>
      <div class ="col-5"><strong>Academic Year</strong></div>
      <div class ='col-7 columnspacer'>
      <select name ="academicyear" id ="academicyear">
      <option value ="academicyear">[Select Year]</option>
      </select></div>
      </div>
    <div class ="textspacer"></div>
    <div class ="row">
      <div class ="col-5"><strong>Term</strong></div>
      <div class ="col-7 columnspacer"><select name ="term">
        <option value ="" selected disabled>[Choose Here]</option>
        <option value = "term_1">Term 1</option>
        <option value = "term_2">Term 2</option>
        <option value = "term_3">Term 3</option>
        <option value = "summer_school">Summer School</option>
        <option value = "virtual_term">Virtual Term</option>
        <option value = "after_school">After School Program</option>
      </select></div>
    </div>
  </div>
  <input type ="submit" name ="resetterm" value = "Reset Term" class ="btn btn-large btn-danger">
</form>
</div>
</div>

<?php


}
require_once 'includes/adminfooter.php';
