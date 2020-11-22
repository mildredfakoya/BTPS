<?php
require_once "includes/teacherheader.php";
$firstname = $row['firstname'];
$lastname =$row['lastname'];
$sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
$stmtcurrent = $user_home->runQuery($sqlcurrent);
$stmtcurrent->execute();
$rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);

$sqlassessment= "SELECT * FROM btps_new_assessment WHERE created_by_firstname = :userfirst AND created_by_lastname = :userlast AND term = :term AND academic_year = :academicyear";
$stmtfindassessment = $user_home->runQuery($sqlassessment);
$stmtfindassessment->bindValue(':userfirst', $firstname);
$stmtfindassessment->bindValue(':userlast', $lastname);
$stmtfindassessment->bindValue(':term', $rowcurrent['current_term']);
$stmtfindassessment->bindValue(':academicyear', $rowcurrent['academic_year']);
$stmtfindassessment->execute();
?>
<script>
$(document).ready(function(){
  $.dobPicker({
    yearSelector: '#academicyear', /* Required */
    yearDefault: 'Year', /* Optional */
    minimumAge: -2, /* Optional */
    maximumAge: 2 /* Optional */
  });
});
</script>
<div class='jumbotron'>
<h5 class = 'header'>Change an assessment setting</h5>
<table>
<tr>
<th>Assessment ID</th>
<th>Term</th>
<th>Academic Year</th>
<th>Access code</th>
<th>Target class</th>
<th>Intended access date</th>
<th>Intended close date</th>
<th>Assessment type</th>
<th>Subject</th>
<th class ="error">Change Setting</th>
</tr>
<?php
foreach($stmtfindassessment as $rowchange){
?>
<form method = 'post' action = 'updatesetting.php'>
  <tr>
    <td><input type ='text' name ='assessmentid' value ='<?php echo $rowchange['assessment_id'] ?>' readonly class ='borderless'/></td>
    <td>
      <select name ="term">
        <option value ="<?php echo $rowchange['term'] ?>" selected><?php echo $rowchange['term'] ?></option>
        <option value = "term_1" <?php if($rowchange['term'] == 'term_1') echo "selected" ?>>Term 1</option>
        <option value = "term_2" <?php if($rowchange['term'] == 'term_2') echo "selected" ?>>Term 2</option>
        <option value = "term_3" <?php if($rowchange['term'] == 'term_3') echo "selected" ?>>Term 3</option>
        <option value = "summer_school" <?php if($rowchange['term'] == 'summer_school') echo "selected" ?>>Summer School</option>
        <option value = "virtual_term" <?php if($rowchange['term'] == 'virtual_term') echo "selected" ?>>Virtual Term</option>
        <option value = "after_school" <?php if($rowchange['term'] == 'after_school') echo "selected" ?>>After School Program</option>
      </select>
    </td>
    <td>
      <select name ="academicyear" id ="academicyear">
            <option value ="<?php echo $rowchange['academic_year'] ?>"><?php echo $rowchange['academic_year'] ?></option>
          </select>
    </td>
    <td><input type ='text' name ='accesscode' value ='<?php echo $rowchange['access_code'] ?>'/></td>
    <td><select name ='class'>
      <option value ='<?php echo $rowchange["target_class"]?>' selected ><?php echo $rowchange["target_class"]?></option>
      <option value ='pre_k'>Pre K</option>
      <option value = 'grade_k'>Grade K</option>
      <option value = 'grade_1'>Grade 1</option>
      <option value ='grade_2'>Grade 2</option>
      <option value = 'grade_3'>Grade 3</option>
      <option value ='grade_4'>Grade 4</option>
      <option value = 'grade_5'>Grade 5</option>
      <option value = 'grade_6'>Grade 6</option>
      <option value ='grade_7'>Grade 7</option>
      <option value = 'grade_8'>Grade 8</option>
      <option value ='grade_9'>Grade 9</option>
      <option value ='grade_10'>Grade 10</option>
      <option value ='grade_11'>Grade 11</option>
    </select>
    </td>
    <td><input type ="datetime-local" name = 'accessdate' value ='<?php echo $rowchange['intended_access_date'] ?>'/></td>
    <td><input type ="datetime-local" name = 'closedate' value ='<?php echo $rowchange['intended_close_date'] ?>'/></td>
    <td><select name ="type">
     <option value ="<?php echo $rowchange['assessment_type']?>" selected><?php echo $rowchange['assessment_type']?></option>
     <option value ="assignment">Assignment</option>
     <option value ="continous_assessment">Continous Assessment</option>
     <option value ="exam">Exam</option>
     <option value ="project">Project</option>
    </select>
    </td>
    <td>
      <select name ="subject">
          <option selected disabled>[choose here]</option>
                                       <?php
                                       $sqltopic = "SELECT DISTINCT subject FROM btps_subject";
                                       $stmttopic = $user_home->runQuery($sqltopic);
                                       $stmttopic->execute();
                                       echo "<option value='" . $rowchange['subject'] . "' selected>" . $rowchange['subject'] . "</option>";
                                       while ($rowtopic = $stmttopic->fetch(PDO::FETCH_ASSOC)) {
                                           echo "<option value='" . $rowtopic['subject'] . "'>" . $rowtopic['subject'] . "</option>";
                                       }
                                       ?>
                                   </select>
    </td>
    <td><input type ='submit' class ='btn btn-secondary' name ='submit' value = 'EDIT'></td>
  </tr>

</form>

<?php
}

?>
</table>
</div>
<?php
require_once "includes/teacherfooter.php";
?>
