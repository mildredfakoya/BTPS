<?php
include "includes/admininit.php";
include_once 'includes/adminhead.php';
include_once 'includes/adminnav.php';
if(!in_array("system_configuration", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
#get the name of the logged in user.
$firstname =$row['firstname'];
$lastname =$row['lastname'];
$email =$row['email']
try{
  # initialize a serial number counter that will increment after every iteration
  $counter = 0;
  # query the sites table for the list of available sites
  $sqldistrict = "SELECT * FROM ihs_video_uploads ORDER BY created_at";
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

   echo "<form method='post'><div class ='row'>";
   echo "<div class ='col-2'>". $counter."</div>";
   echo "<div class ='col-2 columnspacer'><label>".$rowget['created_at']."</label></div>";
   echo "<div class ='col-2 columnspacer'><input type ='text' name ='title' value ='". $rowget['title']."'/></div>";
   echo "<div class ='col-2 columnspacer'>";
   echo '<select name="grade" id ="grade">';
   echo '<option value ='.$rowget["grade"]'selected>[Choose here]</option>';
   echo '<option value = "prek">Pre-K</option>';
   echo '<option value = "gradek">Grade K</option>';
   echo '<option value = "grade1">Grade 1</option>';
   echo '<option value = "grade2">Grade 2</option>';
   echo '<option value = "grade3">Grade 3</option>';
   echo '<option value = "grade4">Grade 4</option>';
   echo '<option value = "grade5">Grade 5</option>';
   echo '<option value = "grade6">Grade 6</option>';
   echo '<option value = "grade7">Grade 7</option>';
   echo '<option value = "grade8">Grade 8</option>';
   echo '<option value = "grade9">Grade 9</option>';
   echo '<option value = "grade10">Grade 10</option>';
   echo '<option value = "grade11">Grade 11</option>';
   echo '<option value = "general">General</option>';
   echo '</select>';
   echo "</div>";
   echo "<div class ='col-2 columnspacer'>";
   echo "<select name='subject' id ='subject'>";
   echo "<option value ='.$rowget['subject'].'selected>[Choose here]</option>";
   echo '<option value = "biology">Biology</option>';
   echo '<option value = "caribbean_history">Caribbean History</option>';
   echo '<option value = "chemistry">Chemistry</option>';
   echo '<option value = "english">English</option>';
   echo '<option value = "food_nutrition">Food & Nutrition</option>';
   echo '<option value = "french">French</option>';
   echo '<option value = "general_science">General Science</option>';
   echo '<option value = "geography">Geography</option>';
   echo '<option value = "health_science">Health Science</option>';
   echo '<option value = "information_technology">Information Technology</option>';
   echo '<option value = "integrated_science">Integrated Science</option>';
   echo '<option value = "language_arts">Language Arts</option>';
   echo '<option value = "mathematics">Mathematics</option>';
   echo '<option value = "physics">Physics</option>';
   echo '<option value = "physical_education">Physical Education</option>';
   echo '<option value = "principles_of_business">Principles of Business</option>';
   echo '<option value = "social_studies">Social Studies</option>';
   echo '<option value = "spanish">Spanish</option>';
   echo '<option value = "visual_arts">Virtual Arts</option>';
   echo '<option value = "general">General Information</option>';
   echo '</select></div>';
   echo "<input type='hidden' name='date' value='".$rowget['created_at']."'>";
   echo "<div class ='col-2 columnspacer'><input type='submit' name='deletedistrict' value='Delete' class ='btn btn-danger' style ='width:100%'/></div>";
   echo "</div><div class ='textspacer'></div></form>";
	 }
echo "</div>";
}
catch(PDOException $e)
    {
    die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
    }

if(isset($_POST['deletedistrict'])){
      date_default_timezone_set('America/dominica');
      $districtname = $_POST['title'];
      $districtcode =$_POST['grade'];
      $districtname = $_POST['subject'];

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





}
include_once 'includes/adminfooter.php';
?>
