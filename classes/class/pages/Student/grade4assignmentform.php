<?php
require_once "includes/studentinit.php";
?>

<div class ="container">
<?php
echo "<h3>".$subject."---".$assessmentid."</h3>";

#for multichoice Questions
$sqlmulti= "SELECT * FROM btps_multichoice WHERE assessment_id = :id ORDER BY id";
$stmtmulti = $user_home->runQuery($sqlmulti);
$stmtmulti->bindValue(':id', $assessmentid);
$stmtmulti->execute();

#for true or false questions
$sqlbool= "SELECT * FROM btps_boolean WHERE assessment_id = :id ORDER BY id";
$stmtbool = $user_home->runQuery($sqlbool);
$stmtbool->bindValue(':id', $assessmentid);
$stmtbool->execute();


# for essay Questions

$sqlessay= "SELECT * FROM btps_essay WHERE assessment_id = :id ORDER BY id";
$stmtessay = $user_home->runQuery($sqlessay);
$stmtessay->bindValue(':id', $assessmentid);
$stmtessay->execute();

#for fill in the blank Questions
$sqlblank= "SELECT * FROM btps_blank WHERE assessment_id = :id ORDER BY id";
$stmtblank = $user_home->runQuery($sqlblank);
$stmtblank->bindValue(':id', $assessmentid);
$stmtblank->execute();

if($stmtmulti){
    $counter = 1;
foreach($stmtmulti as $rowmulti)
{
  $a = $counter++;
?>
<form method = 'post' novalidate id = 'multisubmit'>
<div class = 'outer'>
  <div class ="headinghome"><?php echo $a.")"; ?> </div>
<div class ="container" style = "background-color:white">
<p class ="header">  Question ID : <?php echo $rowmulti['question_id'] ?></p>
<p><?php echo htmlspecialchars_decode($rowmulti['question_text'])?></p>
A. <input type ='checkbox' value ='option1'> <?php echo htmlspecialchars_decode($rowmulti['option1'])?><br/><br/>
B. <input type ='checkbox' value ='option2'> <?php echo htmlspecialchars_decode($rowmulti['option2'])?><br/><br/>
C. <input type ='checkbox' value ='option3'> <?php echo htmlspecialchars_decode($rowmulti['option3'])?><br/><br/>
D. <input type ='checkbox' value ='option4'> <?php echo htmlspecialchars_decode($rowmulti['option4'])?><br/><br/>
<input type = 'hidden' name ="submithidden" value = '<?php $rowmulti['question_id'] ?>'>
<input type = 'submit' name ="submitquestion" value = "Submit question <?php  echo $a?>">
</div>
</div>
<div class ="spacer"></div>
</form>
<?php

}

}

if($stmtbool){
foreach($stmtbool as $rowbool)
{
  $a++;
?>
<form method = 'post' novalidate id = 'boolsubmit'>
<div class = 'outer'>
  <div class ="headinghome"><?php echo $a.")"; ?> </div>
<div class ="container" style = "background-color:white">
<p class ="header">  Question ID : <?php echo $rowbool['question_id'] ?></p>
<p><?php echo htmlspecialchars_decode($rowbool['question_text'])?></p>
A. <input type ='checkbox' value ='option1'> <?php echo htmlspecialchars_decode($rowbool['option1'])?><br/><br/>
B. <input type ='checkbox' value ='option2'> <?php echo htmlspecialchars_decode($rowbool['option2'])?><br/><br/>

<input type = 'hidden' name ="submithidden" value = '<?php $rowbool['question_id'] ?>'>
<input type = 'submit' name ="submitquestion" value = "Submit question <?php  echo $a?>">
</div>
</div>
<div class ="spacer"></div>
</form>

<?php
}

}

if($stmtessay){
foreach($stmtessay as $rowessay)
{
  $a++;
?>
<form method = 'post' novalidate id = 'essaysubmit'>
<div class = 'outer'>
  <div class ="headinghome"><?php echo $a.")"; ?> </div>
<div class ="container" style = "background-color:white">
<p class ="header">  Question ID : <?php echo $rowessay['question_id'] ?></p>
<p><?php echo htmlspecialchars_decode($rowessay['question_text'])?></p>
<textarea name ="studentanswer"></textarea>
<input type = 'hidden' name ="submithidden" value = '<?php $rowessay['question_id'] ?>'>
<input type = 'submit' name ="submitquestion" value = "Submit question <?php  echo $a?>">
</div>
</div>
<div class ="spacer"></div>
</form>

<?php
}

}

if($stmtblank){
foreach($stmtblank as $rowblank)
{
    $a++;
?>
<form method = 'post' novalidate id = 'blanksubmit'>
<div class = 'outer'>
  <div class ="headinghome"><?php echo $a.")"; ?> </div>
<div class ="container" style = "background-color:white">
<p class ="header">  Question ID : <?php echo $rowblank['question_id'] ?></p>
<p><?php echo htmlspecialchars_decode($rowblank['question_text'])?></p>
<input type = "text" name ="studentanswer"/><br/><br/>
<input type = 'hidden' name ="submithidden" value = '<?php $rowblank['question_id'] ?>'>
<input type = 'submit' name ="submitquestion" value = "Submit question <?php  echo $a?>">
</div>
</div>
<div class ="spacer"></div>
</form>

<?php
}

}
?>





</div>
<div class ="spacer"></div>
