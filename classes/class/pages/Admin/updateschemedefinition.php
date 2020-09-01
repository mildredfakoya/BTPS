<?php
require_once 'includes/adminheader.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;


$definitioncode= !empty($_POST['definitioncode']) ? $helper->test_input($_POST['definitioncode']) : null;

#Get the row with the definition code in a form and let the form processing happen on the same page.
$sqlgetform = "SELECT * FROM 	assessmentdefinitions WHERE definition_code = :definition_code";
$stmtgetform = $user_home->runQuery($sqlgetform);
$stmtgetform->bindValue(':definition_code', $definitioncode);
$stmtgetform->execute();
$rowgetform = $stmtgetform->fetch(PDO::FETCH_ASSOC);
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
<div class ='jumbotron'>
  <form method ='post'>
 <table>
<tr>
  <th>Definition code</th>
  <th>Term</th>
  <th>Academic Year</th>
  <th>Class</th>
  <th>Assignment</th>
  <th>Project</th>
  <th>Continous assessments</th>
  <th>Exam</th>
</tr>

<tr>
  <td><?php echo$rowgetform['definition_code'] ?></td>
  <td><select name ='term'>
    <option value ="" selected disabled>[Choose Here]</option>
    <option value = "term_1" <?php if($rowgetform['term'] =='term_1') echo 'selected';?>>Term 1</option>
    <option value = "term_2" <?php if($rowgetform['term'] =='term_2') echo 'selected';?>>Term 2</option>
    <option value = "term_3" <?php if($rowgetform['term'] =='term_3') echo 'selected';?>>Term 3</option>
    <option value = "summer_school" <?php if($rowgetform['term'] =='summer_school') echo 'selected';?>>Summer School</option>
    <option value = "virtual_term" <?php if($rowgetform['term'] =='virtual_term') echo 'selected';?>>Virtual Term</option>
    <option value = "after_school" <?php if($rowgetform['term'] =='after_school') echo 'selected';?>>After School Program</option>
  </select></td>
  <td><select name ="academicyear" id ="academicyear">
        <option value ='<?php echo $rowgetform['academic_year'] ?>'><?php echo $rowgetform['academic_year'] ?></option>
      </select></td>
  <td><select name ='class'>
    <option value ="<?php echo $rowgetform['class'] ?>" selected disabled><?php echo $rowgetform['class'] ?></option>
    <option value ="guest_student" <?php if($rowgetform['class'] =='guest_student') echo 'selected';?>>Guest Student</option>
    <option value ="pre_k" <?php if($rowgetform['class'] =='pre_k') echo 'selected';?>>Pre K</option>
    <option value ="grade_k" <?php if($rowgetform['class'] =='grade_k') echo 'selected';?>>Grade K</option>
    <option value ="grade_1" <?php if($rowgetform['class'] =='grade_1') echo 'selected';?>>Grade 1</option>
    <option value ="grade_2" <?php if($rowgetform['class'] =='grade_2') echo 'selected';?>>Grade 2</option>
    <option value ="grade_3" <?php if($rowgetform['class'] =='grade_3') echo 'selected';?>>Grade 3</option>
    <option value ="grade_4" <?php if($rowgetform['class'] =='grade_4') echo 'selected';?>>Grade 4</option>
    <option value ="grade_5" <?php if($rowgetform['class'] =='grade_5') echo 'selected';?>>Grade 5</option>
    <option value ="grade_6" <?php if($rowgetform['class'] =='grade_6') echo 'selected';?>>Grade 6</option>
    <option value ="grade_7" <?php if($rowgetform['class'] =='grade_7') echo 'selected';?>>Grade 7</option>
    <option value ="grade_8" <?php if($rowgetform['class'] =='grade_8') echo 'selected';?>>Grade 8</option>
    <option value ="grade_9" <?php if($rowgetform['class'] =='grade_9') echo 'selected';?>>Grade 9</option>
    <option value ="grade_10" <?php if($rowgetform['class'] =='grade_10') echo 'selected';?>>Grade 10</option>
    <option value ="grade_11" <?php if($rowgetform['class'] =='grade_11') echo 'selected';?>>Grade 11</option>
  </select></td>
  <td><input type ='number' name ='assignment' value ='<?php echo $rowgetform['assignment'] ?>'></td>
  <td><input type ='number' name ='projects' value ='<?php echo $rowgetform['projects'] ?>'></td>
  <td><input type ='number' name ='contassess' value ='<?php echo $rowgetform['contassess'] ?>'></td>
  <td><input type ='number' name ='exam' value ='<?php echo $rowgetform['exam'] ?>'></td>
</tr>
<tr>
  <th>Max value for A grade</th>
  <th>Min value for A grade</th>
  <th>Max value for B grade</th>
  <th>Min value for B grade</th>
  <th>Max value for C grade</th>
  <th>Min value for C grade</th>
  <th>Max value for D grade</th>
  <th>Min value for D grade</th>

</tr>
<tr>
  <td><input type ='number' name ='amax' value ="<?php echo $rowgetform['amax'] ?>"></td>
  <td><input type ='number' name ='amin' value ="<?php echo $rowgetform['amin'] ?>"></td>
  <td><input type ='number' name ='bmax' value ="<?php echo $rowgetform['bmax'] ?>"></td>
  <td><input type ='number' name ='bmin' value ="<?php echo $rowgetform['bmin'] ?>"></td>
  <td><input type ='number' name ='cmax' value ="<?php echo $rowgetform['cmax'] ?>"></td>
  <td><input type ='number' name ='cmin' value ="<?php echo $rowgetform['cmin'] ?>"></td>
  <td><input type ='number' name ='dmax' value ="<?php echo $rowgetform['dmax'] ?>"></td>
  <td><input type ='number' name ='dmin' value ="<?php echo $rowgetform['dmin'] ?>"></td>

<tr>
  <th>Max value for E grade</th>
  <th>Min value for E grade</th>
</tr>
<tr>
  <td><input type ='number' name ='emax' value ="<?php echo $rowgetform['emax'] ?>"></td>
  <td><input type ='number' name ='emin' value ="<?php echo $rowgetform['emin'] ?>"></td>
</tr>
</tr>

</table>
<input type ='hidden' name ='hiddencode' value ='<?php echo $rowgetform['definition_code'] ?>'>
<input type ="submit" name="updateform" value ="Update Definitions" class ="btn btn-large btn-secondary"><br/><br/>
<input type ="submit" name="deleteform" value ="Delete Definitions" class ="btn btn-large btn-danger">
  </form>
</div>


<?php

if(isset($_POST['updateform'])){
  $definitioncode = !empty($_POST['hiddencode']) ? $helper->test_input($_POST['hiddencode']) : null;
  $term = !empty($_POST['term']) ? $helper->test_input($_POST['term']) : null;
  $academicyear = !empty($_POST['academicyear']) ? $helper->test_input($_POST['academicyear']) : null;
  $class = !empty($_POST['class']) ? $helper->test_input($_POST['class']) : null;
  $assignment = !empty($_POST['assignment']) ? $helper->test_input($_POST['assignment']) : null;
  $projects = !empty($_POST['projects']) ? $helper->test_input($_POST['projects']) : null;
  $contassess = !empty($_POST['contassess']) ? $helper->test_input($_POST['contassess']) : null;
  $exam = !empty($_POST['exam']) ? $helper->test_input($_POST['exam']) : null;
  $amax = !empty($_POST['amax']) ? $helper->test_input($_POST['amax']) : null;
  $amin = !empty($_POST['amin']) ? $helper->test_input($_POST['amin']) : null;
  $bmax = !empty($_POST['bmax']) ? $helper->test_input($_POST['bmax']) : null;
  $bmin = !empty($_POST['bmin']) ? $helper->test_input($_POST['bmin']) : null;
  $cmax = !empty($_POST['cmax']) ? $helper->test_input($_POST['cmax']) : null;
  $cmin = !empty($_POST['cmin']) ? $helper->test_input($_POST['cmin']) : null;
  $dmax = !empty($_POST['dmax']) ? $helper->test_input($_POST['dmax']) : null;
  $dmin = !empty($_POST['dmin']) ? $helper->test_input($_POST['dmin']) : null;
  $emax = !empty($_POST['emax']) ? $helper->test_input($_POST['emax']) : null;
  $emin = !empty($_POST['emin']) ? $helper->test_input($_POST['emin']) : null;




  try{
    $sqlupdate= "UPDATE assessmentdefinitions SET term = '$term', academic_year ='$academicyear',
    class ='$class', assignment = '$assignment', projects ='$projects', contassess = '$contassess',
    amax = '$amax', amin = '$amin', bmax = '$bmax', bmin = '$bmin', cmax = '$cmax', cmin = '$cmin',
    dmax = '$dmax', dmin = '$dmin', emax ='$emax', emin = '$emin' WHERE definition_code = '$definitioncode'";
    $result = $user_home->runQuery4($sqlupdate);
    if ($result){
                    $helper->redirect('success.php?definitionupdated');
                  }
    else{
    echo "Failure!! Grading scheme was not updated";

    }

  }
  catch(PDOException $e)
      {
      //die('SYSTEM FAILURE! CONTACT YOUR ADMINISTRATOR');
      echo $e->getMessage();
  	}
}

if(isset($_POST['deleteform'])){
  try{
     $sql = "DELETE FROM assessmentdefinitions WHERE definition_code = '$_POST[hiddencode]'";
     $result = $user_home->runQuery4($sql);
    if ($result){
                    $helper->redirect('success.php?definitiondeleted');
                  }
     else{
       echo "The file was not deleted";

     }

 }
 catch(PDOException $e)
     {
     die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
     }
}
require_once 'includes/adminfooter.php';
?>
