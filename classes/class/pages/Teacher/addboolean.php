<?php
//echo $assessmentid;

 ?>
 <script>
 $(document).ready(function() {
   $('#summernote').summernote();
 });

 $(document).ready(function(){
   $("#booleanquestion").validate({
  //specify the validation rules
     rules: {
       assessmentid: "required",
       questiontitle: "required",
       question: "required",
       option1: "required",
       option2: "required",
       answer: "required",
       feedback: "required",
     },

  // Specify the validation error messages
     messages: {
       assessmentid: "required",
       questiontitle: "required",
       question: "required",
       option1: "required",
       option2: "required",
       answer: "required",
       feedback: "required",
     },

  //specify how the form should be submitted
   submitHandler: function(form) {
     var r = confirm('Are you ready to save the information?');
  	    if(r==true){
  	      $.ajax({
  //specify file for form processing
  		       url:"saveboolean.php",
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
<h5>Create True or False / Yes or No Questions</h5>
<div class ="mt-5 mb-5">
<form method = "post" novalidate = "novalidate" autocomplete="off" id = "booleanquestion">
Assessment ID: <input type = "text" name = "assessmentid" value = "<?php echo $assessmentid ?>" readonly borderless/><br/><br/>
Question ID: <input type ="text" name ="questiontitle" value = "<?php echo $question_id?>" readonly><br/><br/>
Question Text: <textarea id ="summernote" placeholder="Enter Question" name ="question" required>
</textarea>


<h5>Answer Options</h5>
Option 1: <input type = "text" name = "option1" Value="False/No" readonly/><br/><br/>
Option 2: <input type = "text" name = "option2" Value="True/Yes" readonly><br/><br/>


<h5>Question Answer</h5>
<select name = "answer" required>
  <option selected disabled>[Choose here]</option>
  <option value = "option1">Option 1</option>
  <option value = "option2">Option 2</option>
</select><br/><br/>

Answer feedback: <textarea placeholder="Answer explaination" name = "feedback"></textarea><br/><br/>
 <input type ='submit' name ='submit' value ='save' class ="btn btn-success"/>
</form>
</div>
</div>
