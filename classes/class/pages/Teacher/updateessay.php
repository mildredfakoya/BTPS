<?php require_once 'includes/teacherheader.php';

$questionid = !empty($_POST['hiddenmulti']) ? $helper->test_input($_POST['hiddenmulti']) : null;
$sqltopic = "SELECT * FROM btps_essay WHERE question_id = :id";
$stmttopic = $user_home->runQuery($sqltopic);
$stmttopic->bindValue(':id' ,$questionid);
$stmttopic->execute();
$rowtopic = $stmttopic->fetch(PDO::FETCH_ASSOC);

date_default_timezone_set('America/dominica');
$date_created = date("y-m-d h:i:s");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$email = $row['email'];
$y = strtotime($date_created);
$year = date('Y', $y);
$month = date('m', $y);

?>

 <script>
 $(document).ready(function() {
   $('#summernote').summernote({
     maximumImageFileSize: 102400
   });
 });

 $(document).ready(function(){
   $("#multiquestion").validate({
  //specify the validation rules
     rules: {

       questiontitle: "required",
       question: "required",
       topic: "required",
       feedback: "required",
     },

  // Specify the validation error messages
     messages: {

       questiontitle: "required",
       question: "required",
       topic: "required",
       feedback: "required",
     },

  //specify how the form should be submitted
   submitHandler: function(form) {
     var r = confirm('Are you ready to save the information?');
  	    if(r==true){
  	      $.ajax({
  //specify file for form processing
  		       url:"insertessay.php",
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
<div class ="container">
<h5>Create a true or false question</h5>
<div class ="mt-5 mb-5">
<form method = "post" novalidate = "novalidate" autocomplete="off" id = "multiquestion">
  Question ID: <input type ="text" name ="questiontitle" value = "<?php echo $rowtopic['question_id']?>" readonly><br/><br/>
  Question Text: <textarea id ="summernote" placeholder="Enter Question" name ="question" required><?php echo $rowtopic['question_text']?>
 </textarea>

Please select a topic title:
<select name ="topiccovered">
  <option selected disabled>[choose here]</option>
                               <?php
                               $sqltopic2 = "SELECT * FROM btps_topics";
                               $stmttopic2 = $user_home->runQuery($sqltopic2);
                               $stmttopic2->execute();
                               echo "<option value='".$rowtopic['topic']."'selected>".$rowtopic['topic']. "</option>";
                               while ($rowtopic2 = $stmttopic2->fetch(PDO::FETCH_ASSOC)) {
                                   echo "<option value='" .$rowtopic2['topics_covered'] . "'>".$rowtopic2['topics_covered'] . "</option>";
                               }
                               ?>
                           </select>


<br/><br/>

Answer feedback: <textarea name = "feedback"><?php echo $rowtopic['feedback'] ?></textarea><br/><br/>
 <input type ='submit' name ='submit' value ='save' class ="btn btn-success"/>
</form>
</div>
</div>
