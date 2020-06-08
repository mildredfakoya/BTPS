<?php
ob_start();
// include header files
require_once "includes/teacherheader.php";
if(!in_array("assessment", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<div class ='container'>
    <div class ='jumbotron'>
        <h1>Continue to adding assessment questions</h1>
        <p>You are here means that you have successfully created an accessment. Please enter the assessment ID to retrieve the assessment.</p>

		<!-- Form to collect users unique id-->
        <form method ="post" action ='setquestions.php' autocomplete="off">
            <label>Please enter an assessment ID</label>
            <input type ="password" name ="id" />
	        <input type ='submit' name ='submit' value ='Set questions'class ="btn btn-success"/>
        </form>
    </div>
</div>
<?php
}
require_once 'includes/teacherfooter.php';?>
