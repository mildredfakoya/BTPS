<?php include "includes/studentheader.php";
# The original page before form processing;
date_default_timezone_set("America/dominica");
$email = $row['email'];
$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("grade_10", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{

?>

<script>

function myFunction() {
  $("form").submit();
}


$(document).ready(function() {
  $('.summernote').summernote({
    maximumImageFileSize: 102400
  });
});
$(document).ready(function() {
  $(".submit").validate({

        submitHandler: function(form) {

	$.ajax({
		  url:"submitexam10.php",
		  method:"post",
		  data:$('form').serialize(),
		  dataType:"text",
      success:function(){
       //alert('Submitted');
       location.assign('grade10.php');
}

	   })

}
	})
     });

</script>

<?php
#for processing exams
if(isset($_POST['getass'])){
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  date_default_timezone_set('America/dominica');
  $datecreated = date("y-m-d h:i:sa");
  $assessmentid= !empty($_POST['assessmentidass']) ? $helper->test_input($_POST['assessmentidass']) : null;
  $subject= !empty($_POST['subjectass']) ? $helper->test_input($_POST['subjectass']) : null;
  $accesscode=!empty($_POST['accesscodeass']) ? $helper->test_input($_POST['accesscodeass']) : null;
  if(!empty($assessmentid) && !empty($subject)&&!empty($accesscode) ){
    $sqlaccess="SELECT * FROM btps_new_assessment WHERE assessment_id= :assessmentid" ;
    $stmtaccess = $user_home->runQuery($sqlaccess);
    $stmtaccess->bindValue(':assessmentid', $assessmentid);
    $stmtaccess->execute();
    $rowaccess = $stmtaccess->fetch(PDO::FETCH_ASSOC);


    #for multichoice Questions
    $sqlmulti= "SELECT * FROM btps_multichoice WHERE assessment_id = :id ORDER BY id";
    $stmtmulti = $user_home->runQuery($sqlmulti);
    $stmtmulti->bindValue(':id', $assessmentid);
    $stmtmulti->execute();

    #for true or false
    $sqlbool= "SELECT * FROM btps_boolean WHERE assessment_id = :id ORDER BY id";
    $stmtbool = $user_home->runQuery($sqlbool);
    $stmtbool->bindValue(':id', $assessmentid);
    $stmtbool->execute();

    # for essay Questions

    $sqlessay= "SELECT * FROM btps_essay WHERE assessment_id = :id ORDER BY id";
    $stmtessay = $user_home->runQuery($sqlessay);
    $stmtessay->bindValue(':id', $assessmentid);
    $stmtessay->execute();

    #for fill in the blank Questions
    $sqlblank= "SELECT * FROM btps_blank WHERE assessment_id = :id ORDER BY id";
    $stmtblank = $user_home->runQuery($sqlblank);
    $stmtblank->bindValue(':id', $assessmentid);
    $stmtblank->execute();


if($rowaccess['access_code'] == $accesscode){

  $sqltimer= "SELECT * FROM btps_student_timer WHERE assessment_id = :id AND email = :email";
  $stmttimer = $user_home->runQuery($sqltimer);
  $stmttimer->bindValue(':id', $assessmentid);
  $stmttimer->bindValue(':email' ,$email);
  $stmttimer->execute();
  $rowtimer =$stmttimer->fetch(PDO::FETCH_ASSOC);
  if(!empty($rowtimer)){

      echo "<div class ='alert alert-success'>Our Records show that you have previously submitted this assessment. For further assisstance, contact administration</div>";


    }
else{


       $duration = $rowaccess['duration'];
      if(!empty($duration)||$duration !=NULL){
        $value = 60;
       $duration = $duration * $value; //convert to seconds
    }
    else{
      $duration = 86400;
    }

    $_SESSION['start'] = date("Y-m-d H:i:s a");
    $starttime = date("H:i:s a");

    $endtime = date("H:i:s a", time() + $duration);
    //$_SESSION['expire'] = strtotime($starttime + $duration);
    $status = 'STARTED';
    $sqlsubmit = "INSERT INTO btps_student_timer(assessment_id, email, start_time, duration, status)
    VALUES(:assessment_id, :email, :start_time, :duration, :status)";
    $stmtsubmit = $user_home->runQuery($sqlsubmit);
    $stmtsubmit->bindValue(':email' ,$email);
    $stmtsubmit->bindValue(':assessment_id' ,$assessmentid);
    $stmtsubmit->bindValue(':start_time' ,$_SESSION['start']);
    $stmtsubmit->bindValue(':duration' ,$duration);
    $stmtsubmit->bindValue(':status' ,$status);
    $resultsubmit = $stmtsubmit->execute();

     ?>
     <div class ="container">
       <h3>Start time : <?php echo $starttime ?></h3>
       <h3>End time : <?php echo $endtime?></h3>
       <h4>Seconds until your time expires</h4>
     <h5 id = "timeRemaining" style ="font-size:'large'"></h5>

    </div>
     <script>



     var LOG_OUT = <?php echo $duration ?>;
     var secondscounter = 0;

    window.setInterval(checktime, 1000);

     function checktime() {
         secondscounter++;
         var oPanel = document.getElementById("timeRemaining");
         if (oPanel)
             oPanel.innerHTML = (LOG_OUT - secondscounter) + "";
             if (secondscounter >= LOG_OUT) {
                $("form").submit();
             }
         }
     </script>
     <div class ="header" style ='background-color:green'><h5><?php echo $subject." ".$rowaccess['assessment_type']?></h5></div>
     <div class ="jumbotron">
     <?php

// for multi choice questions
if($stmtmulti){
echo '<div class ="container">';
echo "<h5 class = 'headeranimated'> Multiple Choice </h5><br/>";
//echo '<form method ="post" class="submit" novalidate>';
$counter = 1;
foreach($stmtmulti as $rowmulti){
  $sqlcheck= "SELECT * FROM btps_student_exam_grade_10 WHERE email = :email AND assessment_id = :id AND question_id = :qid";
  $stmtcheck = $user_home->runQuery($sqlcheck);
  $stmtcheck->bindValue(':qid', $rowmulti['question_id']);
  $stmtcheck->bindValue(':id', $assessmentid);
  $stmtcheck->bindValue(':email', $email);
  $stmtcheck->execute();
  $rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);

?>

  <form method = "post" name = "submitform" class ="submit">
  <div class ="header">Question <?php echo $counter++ ?></div>
  <div class ="jumbotron"><div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowmulti['question_text']) ?></strong></p>
  </div>
  <input type ="radio" name ="answer[]" value = "" <?php if ($rowcheck['student_answer'] == "" || $rowcheck['student_answer'] == NULL) echo "checked"; ?>/>This is a default selection if no answer is selected<br/><br/>
  <b>Option 1:</b>    <input type ="radio" name ="answer[]" value = 'option1' <?php if ($rowcheck['student_answer'] == "option1") echo "checked"; ?>/> <?php echo $rowmulti['option1'] ?><br/><br/>
  <b>Option 2:</b>    <input type ="radio" name ="answer[]" value = "option2" <?php if ($rowcheck['student_answer'] == "option2") echo "checked"; ?>/> <?php echo $rowmulti['option2'] ?><br/><br/>
  <b>Option 3:</b>    <input type ="radio" name ="answer[]" value = "option3" <?php if ($rowcheck['student_answer'] == "option3") echo "checked"; ?>/> <?php echo $rowmulti['option3'] ?><br/><br/>
  <b>Option 4:</b>    <input type ="radio" name ="answer[]" value = "option4" <?php if ($rowcheck['student_answer'] == "option4") echo "checked"; ?>/> <?php echo $rowmulti['option4'] ?><br/><br/>
  <input type ='hidden' name ='hiddentime' value =<?php echo $starttime?>>
  <input type ='hidden' name ='hiddenid[]' value =<?php echo $rowmulti['question_id']?>>
  <input type ='hidden' name ='hiddenanswer[]' value =<?php echo $rowmulti['answer']?>>
  <input type ='hidden' name ='hiddenfeedback[]' value =<?php echo $rowmulti['feedback']?>>
  <input type ='hidden' name ='hiddentopic[]' value =<?php echo $rowmulti['topic']?>>
  <input type ='hidden' name ='hiddenassessment[]' value =<?php echo $assessmentid?>>
  <input type ='hidden' name ='hiddensubject[]' value =<?php echo $subject?>>
  <!--<input type ='submit' class ='btn btn-danger' name ='submit' value ='Submit'>-->
  </form>
  <?php
  if($rowcheck['student_answer'] == NULL ||$rowcheck['student_answer'] ==''){
  echo "<div class ='alert alert-danger'><p>No submission exists for this question</p></div>";
  }
  else{
    echo "<div class ='alert alert-success'><p>You have previously submitted this question. Your selected answer is: ".$rowcheck['student_answer']."</p></div>";
  }
  echo "</div><div class ='spacer'></div>";
  }
  ?>

  <div class ='spacer'></div>
  <?php

  }

//end of multichoice question
?>

<?php
// for fill in the blank questions
if($stmtblank){
  echo '<div class ="container">';
  echo "<h5 class = 'headeranimated'>Fill in the blank </h5>";
foreach($stmtblank as $rowblank){
  $sqlcheck= "SELECT * FROM btps_student_exam_grade_10 WHERE email = :email AND assessment_id = :id AND question_id = :qid";
  $stmtcheck = $user_home->runQuery($sqlcheck);
  $stmtcheck->bindValue(':qid', $rowblank['question_id']);
  $stmtcheck->bindValue(':id', $assessmentid);
  $stmtcheck->bindValue(':email', $email);
  $stmtcheck->execute();
  $rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
?>
 <form method ="post" name = "submitform" class ="submit">
  <div class ="header">Question <?php echo $counter++ ?></div>
  <div class ="jumbotron">
  <div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowblank['question_text']) ?></strong></p>
  </div><br/><br/>
  <textarea class ="summernote" name ="answer[]">
    <?php
    if($rowcheck['student_answer']==NULL || $rowcheck['student_answer']==''){
        echo '';
    }else{
      echo $rowcheck['student_answer'];
    }
    ?>
  </textarea><br/><br/>
  <input type ='hidden' name ='hiddentime' value =<?php echo $starttime?>>
  <input type ='hidden' name ='hiddenid[]' value =<?php echo $rowblank['question_id']?>>
  <input type ='hidden' name ='hiddenanswer[]' value =<?php echo $rowblank['answer_keyword']?>>
  <input type ='hidden' name ='hiddenfeedback[]' value =<?php echo $rowblank['feedback']?>>
  <input type ='hidden' name ='hiddentopic[]' value =<?php echo $rowblank['topic']?>>
  <input type ='hidden' name ='hiddenassessment[]' value =<?php echo $assessmentid?>>
  <input type ='hidden' name ='hiddensubject[]' value =<?php echo $subject?>>
<!--  <input type ='submit' class ='btn btn-danger' name ='submit' value ='Submit'>-->
  </form>
  <?php
  if($rowcheck['student_answer'] == NULL ||$rowcheck['student_answer'] ==''){
  echo "<div class ='alert alert-danger'><p>No submission exists for this question</p></div>";
  }




  echo "</div><div class ='spacer'></div>";
  }
  ?>

  <div class ='spacer'></div>
  <?php

  }
//end of fill in the blank Questions

//essay questions
if($stmtessay){
  echo '<div class ="container">';
  echo "<h5 class = 'headeranimated'>Essay / Comprehension</h5>";
foreach($stmtessay as $rowessay){
  $sqlcheck= "SELECT * FROM btps_student_exam_grade_10 WHERE email = :email AND assessment_id = :id AND question_id = :qid";
  $stmtcheck = $user_home->runQuery($sqlcheck);
  $stmtcheck->bindValue(':qid', $rowessay['question_id']);
  $stmtcheck->bindValue(':id', $assessmentid);
  $stmtcheck->bindValue(':email', $email);
  $stmtcheck->execute();
  $rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
?>
  <form method = "post" name = "submitform" class ="submit">
  <div class ="header">Question <?php echo $counter++ ?></div>
  <div class ="jumbotron">
  <div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowessay['question_text']) ?></strong></p>
  </div><br/><br/><textarea class ="summernote" name ="answer[]">
    <?php
    if($rowcheck['student_answer']==NULL || $rowcheck['student_answer']==''){
      echo NULL;
    }else{
      echo $rowcheck['student_answer'];
    }
    ?>
  </textarea><br/><br/>
  <input type ='hidden' name ='hiddentime' value =<?php echo $starttime?>>
    <input type ='hidden' name ='hiddenid[]' value ='<?php echo $rowessay['question_id']?>'>
  <input type ='hidden' name ='hiddenanswer[]' value ='<?php echo $rowessay['answer_guide']?>'>
  <input type ='hidden' name ='hiddenfeedback[]' value ='<?php echo $rowessay['feedback']?>'>
  <input type ='hidden' name ='hiddentopic[]' value ='<?php echo $rowessay['topic']?>'>
  <input type ='hidden' name ='hiddenassessment[]' value ='<?php echo $assessmentid?>'>
  <input type ='hidden' name ='hiddensubject[]' value ='<?php echo $subject?>'>
  <!--<input type ='submit' class ='btn btn-danger' value ='Submit'>-->
  </form>
  <?php
  if(empty($rowcheck['student_answer'])|| $rowcheck['student_answer'] == NULL || $rowcheck['student_answer'] ==''){
  echo "<div class ='alert alert-danger'><p>No submission exists for this question</p></div>";
  }


  echo "</div><div class ='spacer'></div>";
  }
  ?>

  <div class ='spacer'></div>
  <?php

  }


// true or false question

if($stmtbool){
  echo '<div class ="container">';
  echo "<h5 class = 'headeranimated'> True or False </h5>";
foreach($stmtbool as $rowbool){
  $sqlcheck= "SELECT * FROM btps_student_exam_grade_10 WHERE email = :email AND assessment_id = :id AND question_id = :qid";
  $stmtcheck = $user_home->runQuery($sqlcheck);
  $stmtcheck->bindValue(':qid', $rowbool['question_id']);
  $stmtcheck->bindValue(':id', $assessmentid);
  $stmtcheck->bindValue(':email', $email);
  $stmtcheck->execute();
  $rowcheck = $stmtcheck->fetch(PDO::FETCH_ASSOC);
?>
<form method = "post" name = "submitform" class ="submit">
  <div class ="header">Question <?php echo $counter++ ?></div>
  <div class ="jumbotron">
  <div class ="container" style="background-color:white"><p><strong><?php echo htmlspecialchars_decode($rowbool['question_text']) ?></strong></p>
  </div><br/><br/>
  <input type ="radio" name ="answer[]" value = "" <?php if((!$rowcheck['student_answer']||$rowcheck['student_answer'] == "") || ($rowcheck['student_answer'] == NULL)){echo "checked";} ?>/>This is a default selection if no answer is selected<br/><br/>
  <b>Option 1:</b>    <input type ="radio" name ="answer[]" value = 'option1' <?php if ($rowcheck['student_answer'] == "option1") echo "checked"; ?>/> <?php echo $rowbool['option1'] ?><br/><br/>
  <b>Option 2:</b>    <input type ="radio" name ="answer[]" value = "option2" <?php if ($rowcheck['student_answer'] == "option2") echo "checked"; ?>/> <?php echo $rowbool['option2'] ?><br/><br/>
<input type ='hidden' name ='hiddentime' value =<?php echo $starttime?>>
    <input type ='hidden' name ='hiddenid[]' value ='<?php echo $rowbool['question_id']?>'>
  <input type ='hidden' name ='hiddenanswer[]' value ='<?php echo $rowbool['answer']?>'>
  <input type ='hidden' name ='hiddenfeedback[]' value ='<?php echo $rowbool['feedback']?>'>
  <input type ='hidden' name ='hiddentopic[]' value ='<?php echo $rowbool['topic']?>'>
  <input type ='hidden' name ='hiddenassessment[]' value ='<?php echo $assessmentid?>'>
  <input type ='hidden' name ='hiddensubject[]' value ='<?php echo $subject?>'>
  <!--<input type ='submit' class ='btn btn-danger'  value ='Submit'>-->
  </form>
  <?php
    if($rowcheck['student_answer'] != NULL ||$rowcheck['student_answer'] !=''){
  echo "<div class ='alert alert-success'><p>You have previously submitted this question. Your selected answer is: ".$rowcheck['student_answer']."</p></div>";
  }
  else{
  echo "<div class ='alert alert-danger'><p>No submission exists for this question</p></div>";
  }
  echo "</div><div class ='spacer'></div>";
  }
  ?>
  </div>
  <div class ='spacer'></div>
  <?php

  }
  //end of true or false

echo "<button onclick='myFunction()' class ='btn btn-large btn-danger'>SUBMIT</button>";
}

} //end of if access code is correct
else{
      echo "The access code you entered is not correct. Please enter the correct access code and try again";
    }
  }
  else{
      echo "Please fill in all required fields";
  }
}


?>
</div>
</div>
</div>
<?php include "includes/studentfooter.php";
}
?>
