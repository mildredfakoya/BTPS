<?php
include_once "includes/teacherheader.php";
function random_strings($length_of_string)
{
    // String of all alphanumeric character and some special characters
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz&!#@$';
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
}

$question_id = random_strings(10);

if(isset($_POST['submittype'])){
$questiontype = !empty($_POST['questiontype']) ? $helper->test_input($_POST['questiontype']) : null;
$assessmentid = $_POST['assessmentid'];
if(!empty($questiontype)){
  if($questiontype =="multichoice"){
  echo "<div class ='container'>";
  include "addmultichoice.php";
  echo "</div>";
  }

  if($questiontype =="true_false"){
    echo "<div class ='container'>";
    include "addboolean.php";
    echo "</div>";
    }

if($questiontype =="essay"){
  echo "<div class ='container'>";
  include "addessay.php";
  echo "</div>";
      }

  if($questiontype =="blank"){
    echo "<div class ='container'>";
    include "addblank.php";
    echo "</div>";
  }

}
else{
header('refresh:2;getassessment.php');
}
}
?>
