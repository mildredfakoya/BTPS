<?php
require_once "includes/teacherheader.php";
$firstname = $row['firstname'];
$lastname =$row['lastname'];
$sqlassessment= "SELECT * FROM btps_new_assessment WHERE created_by_firstname = :userfirst AND created_by_lastname = :userlast";
$stmtfindassessment = $user_home->runQuery($sqlassessment);
$stmtfindassessment->bindValue(':userfirst', $firstname);
$stmtfindassessment->bindValue(':userlast', $lastname);
$stmtfindassessment->execute();
?>
<div class='jumbotron'>
<h5 class = 'header'>Change an assessment setting</h5>
<table>
<tr>
<th>Assessment ID</th>
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
