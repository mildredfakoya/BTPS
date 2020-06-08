<?php
include_once "includes/teacherheader.php";
if(isset($_POST['submittype'])){
$questiontype = !empty($_POST['questiontype']) ? $helper->test_input($_POST['questiontype']) : null;
$assessmentid = $_POST['assessmentid'];
if(!empty($questiontype)){
  if($questiontype =="multichoice"){
  // header('refresh:2;addmultichoice.php');
  echo "<div class ='container'>";
  include "addmultichoice.php";
  echo "</div>";
  }

  if($questiontype =="true_false"){
     header('refresh:2;addboolean.php');
    }

if($questiontype =="essay"){
       header('refresh:2;addessay.php');
      }

     if($questiontype =="blank"){
         header('refresh:2;addblank.php');
        }

      if($questiontype =="matching"){
           header('refresh:2;addmatching.php');
      }
}
else{
header('refresh:2;getassessment.php');
}
}
?>
