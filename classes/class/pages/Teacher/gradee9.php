<?php
require_once "includes/teacherheader.php";
$assessmentid = !empty($_POST['hiddenassessment']) ? $helper->test_input($_POST['hiddenassessment']) : null;
$email = !empty($_POST['hiddenemail']) ? $helper->test_input($_POST['hiddenemail']) : null;
if(!empty($email)){
  $emailn = new AES($email, $inputkey, $blocksize);
   $emaildec =$emailn->decrypt();
  $sqlgrade= "SELECT * FROM btps_student_exam_grade_9 WHERE assessment_id =:id and email =:email";
  $stmtgrade= $user_home->runQuery($sqlgrade);
  $stmtgrade->bindparam(':id', $assessmentid);
  $stmtgrade->bindparam(':email', $email);
  $stmtgrade->execute();
  #$rowgrade = $stmtgrade->fetch(PDO::FETCH_ASSOC);
  ?>
  <script>

  $(document).ready(function(){

  $(".submit").validate({


          submitHandler: function(form) {

  	var r = confirm('Are you ready to save the information?');
  	if(r==true){
  	$.ajax({
  		  url:"submitgradeexam9.php",
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
<div class ='row'>
<div class ='col-3'>Question ID</div>
<div class ='col-3 columnspacer'>Email</div>
<div class ='col-2 columnspacer'>Student's Answer</div>
<div class ='col-2 columnspacer'>Correct Answer</div>
<div class ='col-2 columnspacer'>Score</div>
</div>
<div class ='textspacer'></div>
  <?php
  foreach($stmtgrade as $rowgrade){
  ?>
  <form method = 'post' class ='submit'>
    <div class ='row'>
    <div class ='col-3'><input type ='text' name = 'questionid[]' value ="<?php echo $rowgrade['question_id'] ?>" readonly class ='borderless'></div>
    <div class ='col-3 columnspacer'><input type ='text' name = 'email' value ="<?php echo $emaildec?>" readonly class ='borderless'></div>
    <div class ='col-2 columnspacer'><?php echo $rowgrade['student_answer'] ?></div>
    <div class ='col-2 columnspacer'><?php echo $rowgrade['correct_answer'] ?></div>
    <div class ='col-2 columnspacer'><input type ='text' name = 'points[]' value ="<?php echo $rowgrade['score'] ?>"></div>
    </div>
    <div class ='textspacer'></div>
  <?php
  echo "<input type ='hidden' name ='assessment' value = '".$assessmentid."'>";
  echo "<input type ='hidden' name ='hidden' value = '".$rowgrade['email']."'>";
  echo "<input type ='hidden' name ='subject' value = '".$rowgrade['subject']."'>";

  }
  echo "<input type ='submit' name ='submit' value ='GRADE' class ='btn btn-danger'>";
  echo "</form>";
}
?>

</div>
<?php

require_once "includes/teacherfooter.php";
?>
