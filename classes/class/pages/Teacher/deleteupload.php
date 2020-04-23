<?php
$firstname  = $row['firstname'];
$lastname  = $row['lastname'];
try{
  # initialize a serial number counter that will increment after every iteration
  $counter = 0;
  # query the sites table for the list of available sites
  $sqldistrict = "SELECT * FROM ihs_video_uploads where created_by_firstname = $firstname and created_by_lastname = $lastname ORDER BY created_at";
  $stmtdistrict = $user_home->runQuery($sqldistrict);
  $stmtdistrict->execute();

# create a table that will hold the rows returned from the query
 echo "<div class ='jumbotron'>";
 echo "<h2>Files uploaded by me</h2><div class ='spacer'></div><div class ='spacer'></div>";
 echo "<div class ='row'>";
 echo "<div class ='col-2'><label><strong>S/No.</strong></label></div>";
 echo "<div class ='col-2 columnspacer'><label><strong>Date created</strong></label></div>";
 echo "<div class ='col-2` columnspacer'><label><strong>Title </strong></label></div>";
  echo "<div class ='col-2 columnspacer'><label><strong>Grade </strong></label></div>";
   echo "<div class ='col-2 columnspacer'><label><strong>Subject</strong></label></div>";
 echo "<div class ='col-2 columnspacer'><label><strong>DELETE </strong></label></div>";
 echo "</div><div class ='textspacer'></div>";
 foreach($stmtdistrict as $rowget){
   $counter++;
?>
  <form method='post'>
    <div class ='row'>
      <div class ='col-2'><?php echo $counter?></div>
      <div class ='col-2 columnspacer'><label><?php echo $rowget['created_at']?></label></div>
      <div class ='col-2 columnspacer'><input type ='text' name ='title' value ="<?php echo $rowget['title']?>"/></div>
      <div class ='col-2 columnspacer'>
      <select name="grade" id ="grade">
         <option value ='<?php echo $rowget["grade"]?>' selected>[Choose here]</option>
         <option value = "prek">Pre-K</option>
         <option value = "gradek">Grade K</option>
         <option value = "grade1">Grade 1</option>
         <option value = "grade2">Grade 2</option>
         <option value = "grade3">Grade 3</option>
         <option value = "grade4">Grade 4</option>
         <option value = "grade5">Grade 5</option>
         <option value = "grade6">Grade 6</option>
         <option value = "grade7">Grade 7</option>
         <option value = "grade8">Grade 8</option>
         <option value = "grade9">Grade 9</option>
         <option value = "grade10">Grade 10</option>
         <option value = "grade11">Grade 11</option>
         <option value = "general">General</option>
       </select>
   </div>
   <div class ='col-2 columnspacer'>
   <select name='subject' id ='subject'>
     <option value ='<?php echo $rowget['subject']?>' selected>[Choose here]</option>
     <option value = "biology">Biology</option>
     <option value = "caribbean_history">Caribbean History</option>
     <option value = "chemistry">Chemistry</option>
     <option value = "english">English</option>
     <option value = "food_nutrition">Food & Nutrition</option>
     <option value = "french">French</option>
     <option value = "general_science">General Science</option>
     <option value = "geography">Geography</option>
     <option value = "health_science">Health Science</option>
     <option value = "information_technology">Information Technology</option>
     <option value = "integrated_science">Integrated Science</option>
     <option value = "language_arts">Language Arts</option>
     <option value = "mathematics">Mathematics</option>
     <option value = "physics">Physics</option>
     <option value = "physical_education">Physical Education</option>
     <option value = "principles_of_business">Principles of Business</option>
     <option value = "social_studies">Social Studies</option>
     <option value = "spanish">Spanish</option>
     <option value = "visual_arts">Virtual Arts</option>
     <option value = "general">General Information</option>
    </select>
  </div>
  <input type='hidden' name='date' value='<?php echo $rowget['created_at']?>'>
   <div class ='col-2 columnspacer'><input type='submit' name='deletedistrict' value='Delete' class ='btn btn-danger' style ='width:100%'/></div>
  </div><div class ='textspacer'></div></form>
  <?php
	 }
echo "</div>";
}
catch(PDOException $e)
    {
    die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
    }

if(isset($_POST['deletedistrict'])){
      date_default_timezone_set('America/dominica');
    	try{
        $sql = "DELETE FROM ihs_video_uploads WHERE created_at='$_POST[date]'";
        $result = $user_home->runQuery4($sql);



        if ($result){
               $helper->redirect('success.php?deleted');
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
?>
