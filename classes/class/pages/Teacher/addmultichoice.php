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
     },

  //specify how the form should be submitted
   submitHandler: function(form) {
     var r = confirm('Are you ready to save the information?');
  	    if(r==true){
  	      $.ajax({
  //specify file for form processing
  		       url:"savemultiquestion.php",
  		       method:"post",
            data:$('form').serialize(),
  		       dataType:"text",
  		       success:function(strMessage){
  		        alert(strMessage);
  		         location.assign('addethnicity.php');
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
  Question number: <input type = "number" name = "questiontitle"/><br/><br/>
Question Text: <textarea id ="summernote" placeholder="Enter Question" name = "question">
</textarea>


<h5>Answer Options</h5>
<input type = "text" name = "option1"/ placeholder="Option A"/><br/><br/>
<input type = "text" name = "option2"/ placeholder="Option B"><br/><br/>
<input type = "text" name = "option3"/ placeholder="Option C"><br/><br/>
<input type = "text" name = "option4"/ placeholder="Option D"><br/><br/>

<h5>Question Answer</h5><p class ="error">For multiple answers, (windows system):hold down the ctrl key and click on the options. (mac system):hold down the cmd key and select the options. </p>
<select name = "answer[]" multiple>
  <option selected disabled>[Choose here]</option>
  <option value = "option1">Option 1</option>
  <option value = "option2">Option 2</option>
  <option value = "option3">Option 3</option>
  <option value = "option4">Option 4</option>
</select><br/><br/>
 <input type ='submit' name ='submit' value ='save' class ="btn btn-success"/>
</form>
</div>
</div>
