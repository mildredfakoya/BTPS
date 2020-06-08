<?php require_once 'includes/teacherinit.php';
$assessmentid = !empty($_POST['assessmentid']) ? $helper->test_input($_POST['assessmentid']) : null;
$questiontitle = !empty($_POST['questiontitle']) ? $helper->test_input($_POST['questiontitle']) : null;
$question = !empty($_POST['question']) ? $helper->test_input($_POST['question']) : null;
$option1 = !empty($_POST['option1']) ? $helper->test_input($_POST['option1']) : null;
$option2 = !empty($_POST['option2']) ? $helper->test_input($_POST['option2']) : null;
$option3 = !empty($_POST['option3']) ? $helper->test_input($_POST['option3']) : null;
$option4 = !empty($_POST['option4']) ? $helper->test_input($_POST['option4']) : null;
$answer = !empty($_POST['answer']) ? $helper->test_input($_POST['answer']) : null;
$ = !empty($_POST['']) ? $helper->test_input($_POST['']) : null;
//$ = !empty($_POST['']) ? $helper->test_input($_POST['']) : null;

?>


<?php
require_once 'includes/teacherinit.php';
?>
