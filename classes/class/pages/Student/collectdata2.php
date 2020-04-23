<?php
ob_start();
// include header files
require_once "includes/testingheader.php";
if(!in_array("general_population_screenings", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<div class ='container'>
    <div class ='jumbotron'>
        <h1>Continue to Screening</h1>
        <p>You are here means that you have successfully created an account / selected the site and type(s) of screening for the client. Please enter the unique ID for the client to retrieve automatically generated forms for the client for further data collection</p>
        <p class ="text-danger">Note: for a previously screened client, update the information on the form from the previous screening. Information are not overwritten. Only the most recent information will be retained on the form. Use the <a href ="screeninghistory.php"><strong>Screening History</strong></a> link to view the client's screening history.</p>
		<!-- Form to collect users unique id-->
        <form method ="post" action ='collectinfo.php' autocomplete="off">
            <label>Please enter client's unique ID</label>
            <input type ="password" name ="uniqueid" />
	        <input type ='submit' name ='submit' value ='Collect Information'class ="btn btn-success"/>
        </form>
    </div>
</div>
<?php
}
require_once 'includes/testingfooter.php';?>
