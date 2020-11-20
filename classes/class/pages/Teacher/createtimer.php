<?php
require_once "includes/teacherheader.php";
$email = $row['email'];

$sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
$stmtcurrent = $user_home->runQuery($sqlcurrent);
$stmtcurrent->execute();
$rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);


$sqlcheck= "SELECT * FROM btps_new_assessment WHERE email = :email AND  term = :term AND academic_year = :academicyear";
$stmtcheck = $user_home->runQuery($sqlcheck);
$stmtcheck->bindValue(':email', $email);
$stmtcheck->bindValue(':term', $rowcurrent['current_term']);
$stmtcheck->bindValue(':academicyear', $rowcurrent['academic_year']);
$stmtcheck->execute();
//$rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
?>
<script>
$(document).ready(function(){
$(".updatetime").validate({
        submitHandler: function(form) {
	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"updatetimer.php",
		  method:"post",
		  data:$('form').serialize(),
		  dataType:"text",
      success:function(x){
       alert(x);
       location.reload();
      }
    })
	}
}
})
});
</script>

<div class ='jumbotron'>
<table>
  <tr>
    <th>Assessment ID</th>
    <th>Assessment_type</th>
    <th>Subject</th>
    <th>Class</th>
    <th>Duration(in minutes)</th>
    <th>Format</th>
    <th></th>
  </tr>
<?php
foreach($stmtcheck as $rowcheck){
  echo "<tr><form method ='post' action ='updatetimer.php'>";
  echo "<td>".$rowcheck['assessment_id']."</td>";
  echo "<td>".$rowcheck['assessment_type']."</td>";
  echo "<td>".$rowcheck['subject']."</td>";
  echo "<td>".$rowcheck['target_class']."</td>";
  echo "<td><input type = 'text' name = 'duration' value ='".$rowcheck['duration']."'/></td>";
  echo "<td><select name ='style'>
  <option selected value='".$rowcheck['style']."'>".$rowcheck['style']."</option>
  <option value='RANDOMIZE'>Randomize</option>
  <option value ='NORMAL'>Normal</option></td>";
  echo "<input type ='hidden' name ='hiddenid' value ='".$rowcheck['assessment_id']."'>";
  echo "<td><input type ='submit' name ='submit' class ='btn btn-large btn-primary' value = 'SET FORMAT'/></td>";
  echo "</form></tr>";
}
?>
</table>
</div>
<?php
require_once "includes/teacherfooter.php";
?>
