<?php
require_once 'includes/supervisorheader.php';
if(!in_array("supervise_screenings", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>

		<div class ='jumbotron'>

		<div class='outer'>
		<div class ='heading'>
		<h3>Tuberculosis Screenings / updates tracking</h3>
		</div>
		<div class ='container'>
		<?php
		try{
		$sql ='SELECT * FROM ihs_tb_screenings ORDER BY  tb_screening_result, unique_id DESC';
		$stmt = $user_home->runQuery($sql);
		$stmt->execute();
		$counter =0;


		echo "<div class ='row'>";
		echo "<p class ='col-2 effect'><label>No.</label></p>";
		echo "<p class ='col-2 effect columnspacer'><label>UNIQUE ID</label></p>";
		echo "<p class ='col-2 columnspacer effect'><label>DATE SCREENED</label></p>";
		echo "<p class ='col-2 columnspacer effect'><label>SCREENED BY</label></p>";
		echo "<p class ='col-2 columnspacer effect'><label>TYPE OF TEST</label></p>";
		echo "<p class ='col-2 columnspacer effect'><label>TEST RESULT</label></p>";
		echo "</div><div class ='textspacer'></div>";

		foreach($stmt as $row)
	{
		$counter++;
       $firstname = $row['created_by_firstname'];
	   $lastname = $row['created_by_lastname'];
	   $encfirst = new AES($firstname, $inputkey, $blocksize);
	   $decfirst = $encfirst->decrypt();

	   $enclast = new AES($lastname, $inputkey, $blocksize);
	   $declast = $enclast->decrypt();
		echo "<div class ='row'>";
		echo "<p class ='col-2 effect'>". $counter."</p>";
		echo "<p class ='col-2 effect columnspacer'>". $row['unique_id']."</p>";
		echo "<p class ='col-2 columnspacer effect'>". $row['date_created']."</p>";
		echo "<p class ='col-2 columnspacer effect'>". $decfirst." ".$declast."</p>";
		echo "<p class ='col-2 columnspacer effect'>". $row['type_of_test']."</p>";
		echo "<p class ='col-2 columnspacer effect'>". $row['tb_screening_result']."</p>";
		echo "</div><div class ='textspacer'></div>";
	}
}
catch(PDOException $e){
die("SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR");

}


		?>

		</div>
		</div>
		</div>
<?php
}
require_once 'includes/supervisorfooter.php';?>
