<?php
require_once 'includes/teacherheader.php';
$email = $row['email'];

$sqltopics= "SELECT * FROM btps_topics WHERE email = :email";
$stmttopics = $user_home->runQuery($sqltopics);
$stmttopics->bindValue(':email',$email);
$stmttopics->execute();




if(isset($_POST['update'])){

  $id = !empty($_POST['hiddenid']) ? $helper->test_input($_POST['hiddenid']) : null;
  $sqltopic = "SELECT * FROM btps_topics WHERE id = :id";
  $stmttopic = $user_home->runQuery($sqltopic);
  $stmttopic->bindValue(':id' ,$id);
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
    $('.summernote').summernote({
      maximumImageFileSize: 102400
    });
  });
  </script>
  <script>

     $(document).ready(function(){
       $("#createtopic").validate({
      //specify the validation rules
       rules: {
         topic:"required",
         grade:"required",
         subject:"required",

         },

      // Specify the validation error messages
         messages: {
           topic:"required",
           grade:"required",
           subject:"required",

         },

      //specify how the form should be submitted
       submitHandler: function(form) {
         var r = confirm('Are you ready to save the information?');
      	    if(r==true){
      	      $.ajax({
      //specify file for form processing
      		       url:"inserttopics.php",
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


 $(document).ready(function(){

     $("#updatetopic").validate({
    //specify the validation rules
       rules: {

         topic: "required",
         grade: "required",
         subject: "required",
         notes: "required",

       },

    // Specify the validation error messages
       messages: {

         topic: "required",
         grade: "required",
         subject: "required",
         notes: "required",
       },

    //specify how the form should be submitted
     submitHandler: function(form) {
       var r = confirm('Are you ready to save the information?');
    	    if(r==true){
    	      $.ajax({
    //specify file for form processing
    		       url:"updatetopic.php",
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


$(document).ready(function(){
  $.dobPicker({
    yearSelector: '#academicyear', /* Required */
    yearDefault: 'Year', /* Optional */
    minimumAge: -2, /* Optional */
    maximumAge: 2 /* Optional */
  });
});


   </script>

   <div class ="container">
     <h3 class ="headeranimated">Update an entry</h3>
   <form method ="post" class ="form-group" novalidate ="novalidate" id ="updatetopic">
   <div class ="row">
     <div class ="col-4">
    <h5>Topic</h5>
     </div>
     <div class ="columnspacer col-8">
     <input type ="text" class="form-control" name ="topicupdate" value = "<?php echo $rowtopic['topics_covered'] ?>"/>
     </div>
   </div>
   <div class ="textspacer"></div>


           <div class ="row">
             <div class ="col-4"><h4>Term in Academic Year</h4></div>
             <div class ="col-8 columnspacer">
              <select name ="term">
                <option value ="<?php echo $rowtopic['term'] ?>" selected><?php echo $rowtopic['term'] ?></option>
                <option value = "term_1" <?php if($rowtopic['term'] == 'term_1') echo "selected" ?>>Term 1</option>
                <option value = "term_2" <?php if($rowtopic['term'] == 'term_2') echo "selected" ?>>Term 2</option>
                <option value = "term_3" <?php if($rowtopic['term'] == 'term_3') echo "selected" ?>>Term 3</option>
                <option value = "summer_school" <?php if($rowtopic['term'] == 'summer_school') echo "selected" ?>>Summer School</option>
                <option value = "virtual_term" <?php if($rowtopic['term'] == 'virtual_term') echo "selected" ?>>Virtual Term</option>
                <option value = "after_school" <?php if($rowtopic['term'] == 'after_school') echo "selected" ?>>After School Program</option>
              </select>
             </div>
           </div>
<div class ='textspacer'></div>

<div class ='row'>
  <div class ="col-4"><h5>Academic Year</h5></div>
  <div class ='col-8 columnspacer'>
   <select name ="academicyear" id ="academicyear">
         <option value ="academicyear"><?php echo $rowtopic['academic_year'] ?></option>
       </select></div>
</div>

   <div class="row">
     <div class ="col-4">
   <h5>Please select the target grade: </h5>
   </div>
   <div class ="col-8 columnspacer">
   <select name="gradeupdate" id ="grade">
   <option value ="<?php echo $rowtopic['grade'] ?>" selected><?php echo $rowtopic['grade'] ?></option>
   <option value = "pre_k">Pre-K</option>
   <option value = "grade_k">Grade K</option>
   <option value = "grade_1">Grade 1</option>
   <option value = "grade_2">Grade 2</option>
   <option value = "grade_3">Grade 3</option>
   <option value = "grade_4">Grade 4</option>
   <option value = "grade_5">Grade 5</option>
   <option value = "grade_6">Grade 6</option>
   <option value = "grade_7">Grade 7</option>
   <option value = "grade_8">Grade 8</option>
   <option value = "grade_9">Grade 9</option>
   <option value = "grade_10">Grade 10</option>
   <option value = "grade_11">Grade 11</option>
   <option value = "general">General</option>
   </select>
   </div>
   </div>
   <div class ="row">
     <div class ="col-4">
    <h5>Please select a subject</h5>
     </div>
     <div class ="columnspacer col-8">
       <select name ="subjectupdate">
         <option selected value = "<?php echo $rowtopic['subject'] ?>"><?php echo $rowtopic['subject'] ?></option>
         <?php
         $sqltopic = "SELECT DISTINCT subject FROM btps_subject";
         $stmttopic = $user_home->runQuery($sqltopic);
        $stmttopic->execute();
       while ($rowtopic = $stmttopic->fetch(PDO::FETCH_ASSOC)) {
          echo "<option value='" . $rowtopic['subject'] . "'>" . $rowtopic['subject'] . "</option>";
       }
     ?>
   </select>
     </div>
   </div>
   <div class ="textspacer"></div>
   <div class ="row">
     <div class ="col-4">
    <h5>Study Guide</h5>
     </div>
     <div class ="columnspacer col-8">
     <textarea class="summernote" name ="details"><?php echo htmlspecialchars_decode($rowtopic['notes'])?></textarea>
     </div>
   </div>
   <div class ="textspacer"></div>
      <input type ='hidden' name ='hiddenupdate' value ="<?php echo $id ?>"/>
     <button type ="submit" name ="update topic" class ="btn btn-success">Update</button>
   </form>

   </div>
<?php

}
?>

<div class ="jumbotron">
  <h5 class ="headeranimated">Created Topics</h5>
  <table>
<tr>
  <th>Date Created</th>
  <th>Term</th>
  <th>Aademic year</th>
  <th>Subject</th>
  <th>Class</th>
  <th>Topics</th>
  <th>Notes</th>
  <th>Update | Delete </th>
</tr>

<?php
foreach ($stmttopics as $key) {
echo "<form method ='post'><tr><td>". $key['created_at']. "</td>";
echo "<td>". $key['term']. "</td>";
echo "<td>". $key['academic_year']. "</td>";
echo "<td>". $key['subject']. "</td>";
echo "<td>". $key['grade']. "</td>";
echo "<td>". $key['topics_covered']. "</td>";
echo "<td>". htmlspecialchars_decode($key['notes']). "</td>";
echo "<td><input type ='submit' class ='btn btn-success' name ='update' value ='UPDATE'/><input type ='submit' class ='btn btn-danger' name ='delete' value ='DELETE'/><input type ='hidden' name ='hiddenid' value =".$key['id']."/></td></tr>";
echo "</form>";
}
?>
</table>
</div>

<script>
 //script for form validation and submission.
$(document).ready(function(){
  $("#createtopic").validate({
 //specify the validation rules
  rules: {
    topic:"required",
    grade:"required",
    subject:"required",

    },

 // Specify the validation error messages
    messages: {
      topic:"required",
      grade:"required",
      subject:"required",

    },

 //specify how the form should be submitted
  submitHandler: function(form) {
    var r = confirm('Are you ready to save the information?');
 	    if(r==true){
 	      $.ajax({
 //specify file for form processing
 		       url:"inserttopics.php",
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


 $(document).ready(function(){
   $.dobPicker({
     yearSelector: '#academicyear2', /* Required */
     yearDefault: 'Year', /* Optional */
     minimumAge: -2, /* Optional */
     maximumAge: 2 /* Optional */
   });
 });
</script>


<div class ="container">
  <h3 class ="headeranimated">Add new topic covered</h3>
<form method ="post" class ="form-group" novalidate ="novalidate" id ="createtopic">
<div class ="row">
  <div class ="col-4">
 <h5>Topic</h5>
  </div>
  <div class ="columnspacer col-8">
  <input type ="text" class="form-control" name ="topic" />
  </div>
</div>
<div class ="textspacer"></div>

<div class="row">
  <div class ="col-4">
<h5>Please select the target grade: </h5>
</div>
<div class ="col-8 columnspacer">
<select name="grade" id ="grade">
<option value ="" selected disabled>[Choose here]</option>
<option value = "pre_k">Pre-K</option>
<option value = "grade_k">Grade K</option>
<option value = "grade_1">Grade 1</option>
<option value = "grade_2">Grade 2</option>
<option value = "grade_3">Grade 3</option>
<option value = "grade_4">Grade 4</option>
<option value = "grade_5">Grade 5</option>
<option value = "grade_6">Grade 6</option>
<option value = "grade_7">Grade 7</option>
<option value = "grade_8">Grade 8</option>
<option value = "grade_9">Grade 9</option>
<option value = "grade_10">Grade 10</option>
<option value = "grade_11">Grade 11</option>
<option value = "general">General</option>
</select>
</div>
</div>


           <div class ="row">
             <div class ="col-4"><h4>Term in Academic Year</h4></div>
             <div class ="col-8 columnspacer">
              <select name ="term">
                <option value ="" selected disabled>[Choose Here]</option>
                <option value = "term_1">Term 1</option>
                <option value = "term_2">Term 2</option>
                <option value = "term_3">Term 3</option>
                <option value = "summer_school">Summer School</option>
                <option value = "virtual_term">Virtual Term</option>
                <option value = "after_school">After School Program</option>
              </select>
             </div>
           </div>
<div class ='textspacer'></div>

<div class ='row'>
  <div class ="col-4"><h5>Academic Year</h5></div>
  <div class ='col-8 columnspacer'>
   <select name ="academicyear2" id ="academicyear2">
         <option value ="academicyear2">[Choose Here]</option>
       </select></div>
</div>
<div class ="row">
  <div class ="col-4">
 <h5>Please select a subject</h5>
  </div>
  <div class ="columnspacer col-8">
    <select name ="subject">
      <option selected disabled>[choose here]</option>
      <?php
      $sqltopic = "SELECT DISTINCT subject FROM btps_subject";
      $stmttopic = $user_home->runQuery($sqltopic);
     $stmttopic->execute();
    while ($rowtopic = $stmttopic->fetch(PDO::FETCH_ASSOC)) {
       echo "<option value='" . $rowtopic['subject'] . "'>" . $rowtopic['subject'] . "</option>";
    }
  ?>
</select>
  </div>
</div>
<div class ="textspacer"></div>
<div class ="row">
  <div class ="col-4">
 <h5>Study Guide</h5>
  </div>
  <div class ="columnspacer col-8">
  <textarea class="summernote" name ="notes"></textarea>
  </div>
</div>
<div class ="textspacer"></div>
  <button type ="submit" name ="create topic" class ="btn btn-success">Create</button>
</form>

</div>
<?php
if(isset($_POST['delete'])){
    try{
        $sql = "DELETE FROM btps_topics WHERE id ='$_POST[hiddenid]'";
        $result = $user_home->runQuery4($sql);
       if ($result){
                       $helper->redirect('success.php?topicdeleted');
                     }
        else{
          echo "Update Failed";

        }

    }
    catch(PDOException $e)
        {
        die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
        }
    }

require_once 'includes/teacherfooter.php';?>
