<?php
require_once 'includes/supervisorheader.php';
if(!in_array("supervise_screenings", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
		<div class ='jumbotron'>

		<form method ="post">
		<div class ="outer">
		<div class ='heading'>
		<h3>Supervise Screenings</h3>
		</div>
		<div class ="container">
		<label>Please select a reporting site</label>
		 <select name='site'>
					<option selected disabled value ="">[Choose here]</option>

					<?php
					$sqlsite ="SELECT * FROM sites";
					$stmtsite =$user_home->runQuery($sqlsite);
					$stmtsite->execute();
					while($rowsite =$stmtsite->fetch(PDO::FETCH_ASSOC)){
					echo "<option value ='".$rowsite['site_name']."'>".$rowsite['site_name']."</option>";
					}
					?>
					</select>


		<button class ='btnblk' type ="submit" name ="choose">Get</button>
		</form>
		</div>



 <?php

 if(isset($_POST['choose'])){
	  $site = !empty($_POST['site']) ? $helper->test_input($_POST['site']) : null;
	if($site==''||$site==null){
        echo '<p class ="error">Please select a testing site</p>';
    }
    else {

		try{
		$sql ="SELECT * FROM ihs_screenings WHERE address_of_site = :site ORDER BY date_created DESC";
		$stmt = $user_home->runQuery($sql);

    //Bind the provided username to our prepared statement.
		 $stmt->bindValue(':site', $site);

    //Execute.
		$stmt->execute();
		$counter = 0;
        echo "<div class ='outer'>";
        echo "<div class ='heading'><h3>Search Result</h3></div>";
		echo "<div class ='container'>";
        echo "<div class ='row'>";
		echo "<p class ='col-1 effect'><label>No.</label></p>";
		echo "<p class ='col-2 effect columnspacer'><label>Date Created</label></p>";
		echo "<p class ='col-2 columnspacer effect'><label>Name of Reporter</label></p>";
		echo "<p class ='col-3 columnspacer effect'><label>Address Of Site</label></p>";
		echo "<p class ='col-2 columnspacer effect'><label>Unique ID</label></p>";
		echo "<p class ='col-2'></p>";


		echo "</div><div class ='textspacer'></div>";


	   foreach($stmt as $row){
		   $counter++;
	   echo "<form method ='post'>";
	   $date_created = $row['date_created'];
	   $d = strtotime($date_created);
	   $id = $row['unique_id'];
	   $firstname =$row['created_by_firstname'];
	   $lastname =$row['created_by_lastname'];

	   $encfirst = new AES($firstname, $inputkey, $blocksize);
	   $decfirst = $encfirst->decrypt();
	   $enclast = new AES($lastname, $inputkey, $blocksize);
	   $declast = $enclast->decrypt();

		echo "<div class ='row'>";
		echo "<p class ='col-1 effect'>".$counter."</p>";
		echo "<p class ='col-2 effect columnspacer'>".date("d-M-Y h:i:s", $d)."</p>";
		echo "<p class ='col-2 columnspacer effect'>".$decfirst." ".$declast."</p>";
		echo "<p class ='col-3 columnspacer effect'>".$row['address_of_site']."</p>";
		echo "<p class ='col-2 columnspacer effect'><input type ='text' name ='uniqueid' class ='borderless' readonly value =".$id."></p>";
		echo "<p class ='col-2 columnspacer'><button type ='submit' name ='info' class ='btnblk'>Info</button></p>";

		echo "</div>";
		echo "<div class ='textspacer'></div>";
		echo "</form>";
		}
		echo "<div class ='textspacer'></div>";



		}
		catch(PDOException $e)
		{
		die("SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR");

		}
		}
		echo "</div></div>";
}



 if(isset($_POST['info'])){
        $uniqueid = !empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;
		try{

	 	 $sql3 = "SELECT*FROM ihs_hiv WHERE unique_id=:uniqueid";
         $stmt3 = $user_home->runQuery($sql3);
		 $stmt3->bindValue(':uniqueid', $uniqueid);
	     $stmt3->execute();
	     $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

	?>


	<div id="wrapper">

	<div id="tabContainer">
    <div id="tabs">
      <ul>
		<li id="tabHeader_1">HIV Screening Information</li>
		<li id="tabHeader_2">Syphilis TP test</li>
		<li id="tabHeader_3">Tuberculosis Screening Information</li>
		<li id="tabHeader_4">Other Screening Information</li>
		<li id="tabHeader_5">Screening Notes</li>
      </ul>
    </div>
   <div id="tabscontent">
	<nav class="tabpage" id="tabpage_1">
		<div class ='row'>
		<div class ='col-5 effect'><label>Unique ID</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['unique_id']?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>HIV Rapid Test KIT 1</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['type1']?></div>
		</div>

		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-5 effect'><label>Test Result 1</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result1'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Test  date (yyyy/mm/dd)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result1year']." ".$row3['result1month'].' '.$row3['result1day'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>HIV Rapid Test KIT 2</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['type2']?></div>
		</div>

		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-5 effect'><label>Test Result 2</label></div>
		<div class ='col-7 effect'><?php echo $row3['result2'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Test  date (yyyy/mm/dd)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result2year']." ".$row3['result2month'].' '.$row3['result2day'];?></div>
		</div>
		<div class ='textspacer'></div>




		<h3>HIV 1/2 Antigen / Antibody</h3>


		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-5 effect'><label>Antigen Result</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result4'];?></div>
		</div>
		<div class ='textspacer'></div>


		<div class ='row'>
		<div class ='col-5 effect'><label>Antibody Result</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result5'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Test  date (yyyy/mm/dd)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['resultyear']." ".$row3['resultmonth'].' '.$row3['resultday'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Date Created</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['date_created']?></div>
		</div>

		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-5 effect'><label>Date Last Updated</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['date_last_updated'];?></div>
		</div>
		<div class ='textspacer'></div>



	<?php

		}


	 catch(PDOException $e)
		{
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

		}
		echo '</nav>';


 echo '<nav class="tabpage" id="tabpage_2">';

        $uniqueid = !empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;
		try{

	 	 $sql3 = "SELECT*FROM ihs_sti WHERE unique_id=:uniqueid";
         $stmt3 = $user_home->runQuery($sql3);
		 $stmt3->bindValue(':uniqueid', $uniqueid);
	     $stmt3->execute();
	     $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
	?>


		<div class ='row'>
		<div class ='col-5 effect'><label>Unique ID</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['unique_id']?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Type of test performed</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['typeoftest']?></div>
		</div>

		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Test result</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['rprresult'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Test date(yyyy/mm/dd)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['rpryear']." ".$row3['rprmonth'].' '.$row3['rprday'];?></div>
		</div>
		<div class ='textspacer'></div>



	<?php

		}


	 catch(PDOException $e)
		{
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

		}
		echo "</nav>";

		 echo '<nav class="tabpage" id="tabpage_3">';

        $uniqueid = !empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;
		try{

	 	 $sql3 = "SELECT*FROM ihs_tb WHERE unique_id=:uniqueid";
         $stmt3 = $user_home->runQuery($sql3);
		 $stmt3->bindValue(':uniqueid', $uniqueid);
	     $stmt3->execute();
	     $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
	?>


		<div class ='row'>
		<div class ='col-5 effect'><label>Unique ID</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['unique_id']?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Mantoux Test</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['typeoftest1']?></div>
		</div>

		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Mantoux Result</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['mantouxresult'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Mantoux Date(yyyy/mm/dd)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['mantouxyear']." ".$row3['mantouxmonth'].' '.$row3['mantouxday'];?></div>
		</div>
		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-5 effect'><label>Sputum Test</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['typeoftest2']?></div>
		</div>

		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Sputum Result</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['sputumresult'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Sputum date(yyyy/mm/dd)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['sputumyear']." ".$row3['sputummonth'].' '.$row3['sputumday'];?></div>
		</div>
		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-5 effect'><label>TB IgG /IgM combo - Test 3</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['typeoftest3'];?></div>
		</div>
			<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Result 3</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result3'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>result 3 date(yyyy/mm/dd)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result3year']." ".$row3['result3month'].' '.$row3['result3day'];?></div>
		</div>
		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-5 effect'><label>TB IgG /IgM combo - Test 4</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['typeoftest4'];?></div>
		</div>
			<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Result 4</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result4'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>result 4 date(yyyy/mm/dd)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['result4year']." ".$row3['result4month'].' '.$row3['result4day'];?></div>
		</div>
		<div class ='textspacer'></div>

	<?php

		}


	 catch(PDOException $e)
		{
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

		}
		echo "</nav>";


echo '<nav class="tabpage" id="tabpage_4">';

        $uniqueid = !empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;
		try{

	 	 $sql3 = "SELECT*FROM ihs_other_test WHERE unique_id=:uniqueid";
         $stmt3 = $user_home->runQuery($sql3);
		 $stmt3->bindValue(':uniqueid', $uniqueid);
	     $stmt3->execute();
	     $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

			 $sqlchlamydia = "SELECT * FROM ihs_chlamydia WHERE unique_id= :uniqueid AND (test_result !=NULL || test_result !='') ORDER BY date_created DESC limit 1";
 		  $stmtchlamydia = $user_home->runQuery($sqlchlamydia);
 		  //Bind the provided username to our prepared statement.
 		  $stmtchlamydia->bindValue(':uniqueid', $uniqueid);
 		  //Execute.
 		  $stmtchlamydia->execute();
 		  //Fetch the row.
 		  $rowchlamydia = $stmtchlamydia->fetch(PDO::FETCH_ASSOC);


 		  $sqlgonorrhea = "SELECT * FROM ihs_gonorrhea WHERE unique_id= :uniqueid AND (test_result !=NULL || test_result !='') ORDER BY date_created DESC limit 1";
 		  $stmtgonorrhea = $user_home->runQuery($sqlgonorrhea);
 		  //Bind the provided username to our prepared statement.
 		  $stmtgonorrhea->bindValue(':uniqueid', $uniqueid);
 		  //Execute.
 		  $stmtgonorrhea->execute();
 		  //Fetch the row.
 		  $rowgonorrhea = $stmtgonorrhea->fetch(PDO::FETCH_ASSOC);

 		  $sqlhepb = "SELECT * FROM ihs_hepb WHERE unique_id= :uniqueid AND (test_result !=NULL || test_result !='') ORDER BY date_created DESC limit 1";
 		  $stmthepb = $user_home->runQuery($sqlhepb);
 		  //Bind the provided username to our prepared statement.
 		  $stmthepb->bindValue(':uniqueid', $uniqueid);
 		  //Execute.
 		  $stmthepb->execute();
 		  //Fetch the row.
 		  $rowhepb = $stmthepb->fetch(PDO::FETCH_ASSOC);

 		  $sqlhepc = "SELECT * FROM ihs_hepc WHERE unique_id= :uniqueid AND (test_result !=NULL || test_result !='') ORDER BY date_created DESC limit 1";
 		  $stmthepc = $user_home->runQuery($sqlhepc);
 		  //Bind the provided username to our prepared statement.
 		  $stmthepc->bindValue(':uniqueid', $uniqueid);
 		  //Execute.
 		  $stmthepc->execute();
 		  //Fetch the row.
 		  $rowhepc = $stmthepc->fetch(PDO::FETCH_ASSOC);

 		  $sqlhtlv = "SELECT * FROM ihs_htlv WHERE unique_id= :uniqueid AND (test_result !=NULL || test_result !='') ORDER BY date_created DESC limit 1";
 		  $stmthtlv = $user_home->runQuery($sqlhtlv);
 		  //Bind the provided username to our prepared statement.
 		  $stmthtlv->bindValue(':uniqueid', $uniqueid);
 		  //Execute.
 		  $stmthtlv->execute();
 		  //Fetch the row.
 		  $rowhtlv = $stmthtlv->fetch(PDO::FETCH_ASSOC);

 		  $sqlhpv = "SELECT * FROM ihs_hpv WHERE unique_id= :uniqueid AND (test_result !=NULL || test_result !='') ORDER BY date_created DESC limit 1";
 		  $stmthpv = $user_home->runQuery($sqlhpv);
 		  //Bind the provided username to our prepared statement.
 		  $stmthpv->bindValue(':uniqueid', $uniqueid);
 		  //Execute.
 		  $stmthpv->execute();
 		  //Fetch the row.
 		  $rowhpv = $stmthpv->fetch(PDO::FETCH_ASSOC);

 		  $sqlpap = "SELECT * FROM ihs_pap_smear WHERE unique_id= :uniqueid AND (test_result !=NULL || test_result !='') ORDER BY date_created DESC limit 1";
 		  $stmtpap = $user_home->runQuery($sqlpap);
 		  //Bind the provided username to our prepared statement.
 		  $stmtpap->bindValue(':uniqueid', $uniqueid);
 		  //Execute.
 		  $stmtpap->execute();
 		  //Fetch the row.
 		  $rowpap = $stmtpap->fetch(PDO::FETCH_ASSOC);



		 $firstname = $row3['created_by_firstname'];
		 $lastname = $row3['created_by_lastname'];

			if(!empty($firstname)){
			$firstenc = new AES($firstname, $inputkey, $blocksize);
			$decfirst = $firstenc->decrypt();
			}
			else {
				$decfirst ="";
			}

			if(!empty($lastname)){
			$lastenc = new AES($lastname, $inputkey, $blocksize);
			$declast = $lastenc->decrypt();
			}
			else {
				$declast ="";
			}

			$ufirstname = $row3['updated_by_firstname'];
			$ulastname = $row3['updated_by_lastname'];

			if(!empty($ufirstname)){
			$ufirstenc = new AES($ufirstname, $inputkey, $blocksize);
			$udecfirst = $ufirstenc->decrypt();
			}
			else {
				$udecfirst ="";
			}

			if(!empty($ulastname))
			{
			$ulastenc = new AES($ulastname, $inputkey, $blocksize);
			$udeclast = $ulastenc->decrypt();
			}
			else {
				$udeclast ="";
			}


	?>


		<div class ='row'>
		<div class ='col-5 effect'><label>Unique ID</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['unique_id']?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Type of HIV Test</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['hiv_type']?></div>
		</div>

		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Result of HIV test</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['hiv_result'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Date of HIV test / result (dd/mm/yyyy)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['hiv_result_day']." ".$row3['hiv_result_month'].' '.$row3['hiv_result_year'];?></div>
		</div>
		<div class ='textspacer'></div>




		<div class ='row'>
		<div class ='col-5 effect'><label>Type of STI Test</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['sti_type']?></div>
		</div>

		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>STI Result</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['sti_result'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>STI Titre</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['sti_titre'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>STI test / result DATE (dd/mm/yyyy)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['sti_test_day']." ".$row3['sti_test_month'].' '.$row3['sti_test_year'];?></div>
		</div>
		<div class ='textspacer'></div>


		<div class ='row'>
		<div class ='col-5 effect'><label>Type of Syphilis Test</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['syphilis_type']?></div>
		</div>

		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Syphilis test Result</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['syphilis_result'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Syphilis titre</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['syphilis_titre'];?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Syphilis test / result dates (dd/mm/yyyy)</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['syphilis_day']." ".$row3['syphilis_month'].' '.$row3['syphilis_year'];?></div>
		</div>
		<div class ='textspacer'></div>


				<div class ='row'>
				<div class ='col-5 effect'><label>Type of Chlamydia Test</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowchlamydia['type_of_test']?></div>
				</div>

				<div class ='textspacer'></div>
				<div class ='row'>
				<div class ='col-5 effect'><label>Chlamydia Result</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowchlamydia['test_result'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>Chlamydia test / result date (dd/mm/yyyy)</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowchlamydia['day_recorded']." ".$rowchlamydia['month_recorded'].' '.$rowchlamydia['year_recorded'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>Type of Gonorrhea Test</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowgonorrhea['type_of_test']?></div>
				</div>

				<div class ='textspacer'></div>
				<div class ='row'>
				<div class ='col-5 effect'><label>Gonorrhea Result</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowgonorrhea['test_result'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>Gonorrhea test / result date (dd/mm/yyyy)</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowgonorrhea['day_recorded']." ".$rowgonorrhea['month_recorded'].' '.$rowgonorrhea['year_recorded'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>Type of Hepatitis B Test</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhepb['type_of_test']?></div>
				</div>

				<div class ='textspacer'></div>
				<div class ='row'>
				<div class ='col-5 effect'><label>Hepatitis B Result</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhepb['test_result'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>Hepatitis B test / result date (dd/mm/yyyy)</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhepb['day_recorded']." ".$rowhepb['month_recorded'].' '.$rowhepb['year_recorded'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>Type of Hepatitis C Test</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhepc['type_of_test']?></div>
				</div>

				<div class ='textspacer'></div>
				<div class ='row'>
				<div class ='col-5 effect'><label>Hepatitis C Result</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhepc['test_result'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>Hepatitis C test / result date (dd/mm/yyyy)</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhepc['day_recorded']." ".$rowhepc['month_recorded'].' '.$rowhepc['year_recorded'];?></div>
				</div>
				<div class ='textspacer'></div>



				<div class ='row'>
				<div class ='col-5 effect'><label>Type of HTLV Test</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhtlv['type_of_test']?></div>
				</div>

				<div class ='textspacer'></div>
				<div class ='row'>
				<div class ='col-5 effect'><label>HTLV 1 / 2 Result</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhtlv['test_result'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>HTLV 1 / 2 test / result date (dd/mm/yyyy)</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhtlv['day_recorded']." ".$rowhtlv['month_recorded'].' '.$rowhtlv['year_recorded'];?></div>
				</div>
				<div class ='textspacer'></div>


				<div class ='row'>
				<div class ='col-5 effect'><label>Type of HPV Test</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhpv['type_of_test']?></div>
				</div>

				<div class ='textspacer'></div>
				<div class ='row'>
				<div class ='col-5 effect'><label>HPV Result</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhpv['test_result'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>HPV test / result date (dd/mm/yyyy)</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowhpv['day_recorded']." ".$rowhpv['month_recorded'].' '.$rowhpv['year_recorded'];?></div>
				</div>
				<div class ='textspacer'></div>


				<div class ='row'>
				<div class ='col-5 effect'><label>Type of Pap test</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowpap['type_of_test']?></div>
				</div>

				<div class ='textspacer'></div>
				<div class ='row'>
				<div class ='col-5 effect'><label>Pap Smear Result</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowpap['test_result'];?></div>
				</div>
				<div class ='textspacer'></div>

				<div class ='row'>
				<div class ='col-5 effect'><label>Pap smear test / result date (dd/mm/yyyy)</label></div>
				<div class ='col-7 columnspacer effect'><?php echo $rowpap['day_recorded']." ".$rowpap['month_recorded'].' '.$rowpap['year_recorded'];?></div>
				</div>
				<div class ='textspacer'></div>


	<?php

		}


	 catch(PDOException $e)
		{
		die("SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR");

		}
		echo "</nav>";


		 echo '<nav class="tabpage" id="tabpage_5">';

        $uniqueid = !empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;
		try{

	 	 $sql3 = "SELECT*FROM ihs_screening_notes WHERE unique_id=:uniqueid";
         $stmt3 = $user_home->runQuery($sql3);
		 $stmt3->bindValue(':uniqueid', $uniqueid);
	     $stmt3->execute();
	     $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
	?>


		<div class ='row'>
		<div class ='col-5 effect'><label>Unique ID</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['unique_id']?></div>
		</div>
		<div class ='textspacer'></div>
		<div class ='row'>
		<div class ='col-5 effect'><label>Notes</label></div>
		<div class ='col-7 columnspacer effect'><?php echo $row3['notes']?></div>
		</div>

		<div class ='textspacer'></div>

	<?php

		}


	 catch(PDOException $e)
		{
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

		}
		echo "</nav>";

 }
 ?>


		</div>
		</div>
		</div>
		</div>
		</div>

<?php
}
require_once 'includes/supervisorfooter.php';?>
