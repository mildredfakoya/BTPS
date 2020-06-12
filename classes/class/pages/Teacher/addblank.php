<script>
 $(document).ready(function() {
   $('#summernote').summernote();
 });

 $(document).ready(function(){
   $("#blankquestion").validate({
  //specify the validation rules
     rules: {
       assessmentid: "required",
       questiontitle: "required",
       question: "required",
       answer_keyword:"required",
       feedback: "required",
     },

  // Specify the validation error messages
     messages: {
       assessmentid: "required",
       questiontitle: "required",
       question: "required",
       answer_keyword:"required",
       feedback: "required",
     },

  //specify how the form should be submitted
   submitHandler: function(form) {
     var r = confirm('Are you ready to save the information?');
  	    if(r==true){
  	      $.ajax({
  //specify file for form processing
  		       url:"saveblank.php",
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
<h5>Create Fill in the blank Question</h5>
<div class ="mt-5 mb-5">
<form method = "post" novalidate = "novalidate" autocomplete="off" id = "blankquestion">
  Assessment ID: <input type = "text" name = "assessmentid" value = "<?php echo $assessmentid ?>" readonly borderless/><br/><br/>
  Question ID: <input type ="text" name ="questiontitle" value = "<?php echo $question_id?>" readonly><br/><br/>
  Question Text: <textarea id ="summernote" placeholder="Enter Question" name ="question" required>
</textarea>

<h5>Answer Keyword</h5>
Answer Keywords<input type ="text" name ="answer_keyword">
<br/><br/>

Answer feedback: <textarea placeholder="Answer explaination" name = "feedback"></textarea><br/><br/>
 <input type ='submit' name ='submit' value ='save' class ="btn btn-success"/>
</form>
</div>
</div>