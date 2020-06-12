<?php
//echo $assessmentid;

 ?>
 <script>
 $(document).ready(function() {
   $('#summernote').summernote();
 });

 $(document).ready(function(){
   $("#multiquestion").validate({
  //specify the validation rules
     rules: {
       assessmentid: "required",
       questiontitle: "required",
       question: "required",
       option1: "required",
       option2: "required",
       option3: "required",
       option4: "required",
       answer: "required",
       topic: "required",
       feedback: "required",
     },

  // Specify the validation error messages
     messages: {
       assessmentid: "required",
       questiontitle: "required",
       question: "required",
       option1: "required",
       option2: "required",
       option3: "required",
       option4: "required",
       answer: "required",
       topic: "required",
       feedback: "required",
     },

  //specify how the form should be submitted
   submitHandler: function(form) {
     var r = confirm('Are you ready to save the information?');
  	    if(r==true){
  	      $.ajax({
  //specify file for form processing
  		       url:"savemutiquestion.php",
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
<h5>Create a multiple choice question</h5>
<div class ="mt-5 mb-5">
<form method = "post" novalidate = "novalidate" autocomplete="off" id = "multiquestion">
  Assessment ID: <input type = "text" name = "assessmentid" value = "<?php echo $assessmentid ?>" readonly borderless/><br/><br/>
  Question ID: <input type ="text" name ="questiontitle" value = "<?php echo $question_id?>" readonly><br/><br/>
  Question Text: <textarea id ="summernote" placeholder="Enter Question" name ="question" required>
 </textarea>

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

<h5>Answer Options</h5>
Option 1: <input type = "text" name = "option1" placeholder="Option A"/><br/><br/>
Option 2:<input type = "text" name = "option2" placeholder="Option B"><br/><br/>
Option 3:<input type = "text" name = "option3" placeholder="Option C"><br/><br/>
Option 4:<input type = "text" name = "option4" placeholder="Option D"><br/><br/>

<h5>Question Answer</h5><p class ="error">For multiple answers, (windows system):hold down the ctrl key and click on the options. (mac system):hold down the cmd key and select the options. </p>
<select name = "answer[]" multiple required>
  <option selected disabled>[Choose here]</option>
  <option value = "option1">Option 1</option>
  <option value = "option2">Option 2</option>
  <option value = "option3">Option 3</option>
  <option value = "option4">Option 4</option>
</select><br/><br/>

Answer feedback: <textarea placeholder="Answer explaination" name = "feedback"></textarea><br/><br/>
 <input type ='submit' name ='submit' value ='save' class ="btn btn-success"/>
</form>
</div>
</div>
