<script>
 $(document).ready(function() {
   $('#summernote').summernote({
     maximumImageFileSize: 102400
   });
 });

 $(document).ready(function(){
   $("#essayquestion").validate({
  //specify the validation rules
     rules: {
       assessmentid: "required",
       questiontitle: "required",
       question: "required",
       feedback: "required",
       topic : "required",
       guide : "required",
     },

  // Specify the validation error messages
     messages: {
       assessmentid: "required",
       questiontitle: "required",
       question: "required",
       feedback: "required",
       topic: "required",
       guide: "required",
     },

  //specify how the form should be submitted
   submitHandler: function(form) {
     var r = confirm('Are you ready to save the information?');
  	    if(r==true){
  	      $.ajax({
  //specify file for form processing
  		       url:"saveessay.php",
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
<div class ="jumbotron">
<h5>Create an Essay Question</h5>
<div class ="mt-5 mb-5">
<form method = "post" novalidate = "novalidate" autocomplete="off" id = "essayquestion">
  Assessment ID: <input type = "text" name = "assessmentid" value = "<?php echo $assessmentid ?>" readonly borderless/><br/><br/>
  Question ID: <input type ="text" name ="questiontitle" value = "<?php echo $question_id?>" readonly><br/><br/>
  Question Text: <textarea id ="summernote" placeholder="Enter Question" name ="question" required>
</textarea>

<h5>Answer Guide / Grading Rubric</h5>
<textarea placeholder="Enter Guide" name ="guide"></textarea>
<br/><br/>

Please select a topic title:
<select name ="topic">
  <option selected disabled>[choose here]</option>
                               <?php
                               $sqltopic = "SELECT * FROM btps_topics WHERE grade = :grade";
                               $stmttopic = $user_home->runQuery($sqltopic);
                               $stmttopic->bindValue(':grade' ,$_POST['class']);
                               #$stmttopic->bindValue(':subject' ,$_POST['subject']);
                               $stmttopic->execute();
                               while ($rowtopic = $stmttopic->fetch(PDO::FETCH_ASSOC)) {
                                   echo "<option value='" . $rowtopic['topics_covered'] . "'>" . $rowtopic['topics_covered'] . "</option>";
                               }
                               ?>
                           </select>


<br/><br/>

Answer feedback: <textarea placeholder="Answer explaination" name = "feedback"></textarea><br/><br/>
 <input type ='submit' name ='submit' value ='save' class ="btn btn-success"/>
</form>
</div>
</div>
