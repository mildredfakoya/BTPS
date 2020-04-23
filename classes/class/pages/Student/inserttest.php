<?php
ob_start();
require_once 'includes/testinginit.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
$firstname =$row['firstname'];
$lastname =$row['lastname'];
$firstn =new AES($firstname, $inputkey, $blocksize);
$dec =$firstn->decrypt();
$lastn =new AES($lastname, $inputkey, $blocksize);
$decl =$lastn->decrypt();

// SET THE TIME ZONE
date_default_timezone_set('America/dominica');
//AUTOMATICALLY SET THE DATE OF CREATION AND THE USER.
$date_created = date("y-m-d h:i:s");
$createdbyfirstname = $row['firstname'];
$createdbylastname = $row['lastname'];
$monthoftest = !empty($_POST['accountmonth']) ? $helper->test_input($_POST['accountmonth']) : null;
$yearoftest = !empty($_POST['accountyear']) ? $helper->test_input($_POST['accountyear']) : null;
$reporterfirstname = $row['firstname'];
$reporterlastname = $row['lastname'];
if(empty($_POST["firstname"])){
		 $firstn ="";
}
else{
	 $firstname = strtolower(!empty($_POST['firstname']) ? $helper->test_input($_POST['firstname']) : null);
	 $encfirst = new AES($firstname,$inputkey, $blocksize);
	 $firstn = $encfirst->encrypt();
	 $encfirst->setData($firstn);
}
if(empty($_POST["middlename"])){
	$middlen ="";
}
else{
	 $middlename = strtolower(!empty($_POST['middlename']) ? $helper->test_input($_POST['middlename']) : null);
	 $encmiddle = new AES($middlename,$inputkey, $blocksize);
	 $middlen = $encmiddle->encrypt();
	 $encmiddle->setData($middlen);
}

if (empty($_POST["lastname"])) {
        $lastn = "";
}
else {
    $lastname= strtolower(!empty($_POST['lastname']) ? $helper->test_input($_POST['lastname']) : null);
		$enclast= new AES($lastname,$inputkey, $blocksize);
		$lastn = $enclast->encrypt();
		$enclast->setData($lastn);
}
    // CONTINUE GETTING THE REST OF THE FORM DATA
    $reportercontact= !empty($_POST['reportercontact']) ? $helper->test_input($_POST['reportercontact']) : null;
    $facilitytype= !empty($_POST['facilitytype']) ? $helper->test_input($_POST['facilitytype']) : null;
	  $day= !empty($_POST['day']) ? $helper->test_input($_POST['day']) : null;
	  $month= !empty($_POST['month']) ? $helper->test_input($_POST['month']) : null;

	if (empty($_POST["year"])) {
        $year = "yyyy";
    }

    else {

        $year= !empty($_POST['year']) ? $helper->test_input($_POST['year']) : null;

    }
        $gender= !empty($_POST['gender']) ? $helper->test_input($_POST['gender']) : null;

	if (empty($_POST["mmaidenname"])) {
        $mmaidenn = "unknown";
    }
    else {
    $mmaidenname=  strtolower(!empty($_POST['mmaidenname']) ? $helper->test_input($_POST['mmaidenname']) : null);
		$encmaiden = new AES($mmaidenname,$inputkey, $blocksize);
		$mmaidenn = $encmaiden->encrypt();
		$encmaiden->setData($mmaidenn);
    }
	//CHECK IF THE TESTING CODE WAS NOT AUTOMATICALLY GENERATED ON THE CLIENT SIDE AND GENERATE IT BEFORE POSTING TO THE DATABASE
	if (empty($_POST["testingcode"])) {
		$a = substr($firstname, 0, 1);
		$b = substr($mmaidenname, 0, 1);
		$c = substr($lastname, 0, 1);
		$d = substr($year, 2);
		$e = substr($gender, 0, 1);
    $testingcode = $a.$b.$c.$d.$e;
    }
    else {
        $testingcode= !empty($_POST['testingcode']) ? $helper->test_input($_POST['testingcode']) : null;
    }

  $uniqueid= !empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;
	$type= !empty($_POST['type']) ? $helper->test_input($_POST['type']) : null;
	// AUTOMATICALLY GENERATED SYSTEM UNIVERSAL ID FOR CLIENT.
	$code = bin2hex(random_bytes(20));


try{
			//CHECK IF THE CLIENT HAS A UUID / HAS BEEN TESTED PREVIOUSLY PRESENTING THE SAME ID CARD AND USING THE NUMBER AS THE UNIQUE ID.
		$sqlid="SELECT * FROM ihs_uuid WHERE unique_id= :uniqueid" ;
	    $stmtid = $user_home->runQuery($sqlid);
	    $stmtid->bindValue(':uniqueid', $uniqueid);
	    $stmtid->execute();
	    $rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
		//IF THE CLIENT HAS BEEN TESTED PREVIOUSLY USING THE SAME UNIQUE ID, DISPAY A MESSAGE FOR THE USER.
		if($rowid){
			echo "New record cannot be created for this client.
      Reason : Client has been tested previously and already has an account created. If this is the same client, skip this form and go to the next link. If this is a different client, use another ID number. Click ok, to exit this message.";
			}

		else{


	// IF NO RECORD EXITS FOR THE CLIENT

	// insert into the uuid table
		 $sqluuid = "INSERT INTO ihs_uuid(date_created, created_by_firstname, created_by_lastname, unique_id, uuid)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :uuid)";
     $stmtuuid = $user_home->runQuery($sqluuid);
		 $stmtuuid->bindValue(':date_created' ,$date_created);
		 $stmtuuid->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmtuuid->bindValue(':created_by_lastname', $createdbylastname);
		 $stmtuuid->bindValue(':unique_id',$uniqueid);
	   $stmtuuid->bindValue(':uuid',$code);
		 $resultuuid = $stmtuuid->execute();



		//insert into the testing table
	   $sql = "INSERT INTO ihs_testing(date_created, created_by_firstname, created_by_lastname, first_name, middle_name, last_name, mother_maiden_name, day, month, year, testingcode, unique_id, type, gender, name_of_reporter_first, name_of_reporter_last, contact_of_reporter, date_of_report, month_of_test, facility_type)VALUES(:date_created, :created_by_firstname, :created_by_lastname,:first_name, :middle_name, :last_name, :mother_maiden_name, :day, :month, :year, :testingcode, :unique_id, :type, :gender, :name_of_reporter_first, :name_of_reporter_last, :contact_of_reporter, :date_of_report, :monthoftest, :facility_type)";
     $stmt = $user_home->runQuery($sql);
		 $stmt->bindValue(':date_created' ,$date_created);
		 $stmt->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt->bindValue(':created_by_lastname', $createdbylastname);
	     $stmt->bindValue(':day',$day);
	     $stmt->bindValue(':month',$month);
	     $stmt->bindValue(':year',$year);
	     $stmt->bindValue(':testingcode', $testingcode);
	     $stmt->bindValue(':unique_id',$uniqueid);
	     $stmt->bindValue(':type', $type);
	     $stmt->bindValue(':gender', $gender);
		 $stmt->bindValue(':first_name', $firstn);
		 $stmt->bindValue(':middle_name', $middlen);
		 $stmt->bindValue(':last_name', $lastn);
		 $stmt->bindValue(':mother_maiden_name', $mmaidenn);
		 $stmt->bindValue(':name_of_reporter_first', $reporterfirstname);
		 $stmt->bindValue(':name_of_reporter_last', $reporterlastname);
		 $stmt->bindValue(':contact_of_reporter', $reportercontact);
		 $stmt->bindValue(':facility_type', $facilitytype);
		 $stmt->bindValue(':date_of_report', $yearoftest);
		 $stmt->bindValue(':monthoftest', $monthoftest);
		 $result = $stmt->execute();

		 //insert into the address table
		 $sql1 = "INSERT INTO ihs_address(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt1 = $user_home->runQuery($sql1);
		 $stmt1->bindValue(':date_created' ,$date_created);
		 $stmt1->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt1->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt1->bindValue(':unique_id',$uniqueid);
		 $stmt1->bindValue(':month', $monthoftest);
		 $stmt1->bindValue(':year', $yearoftest);
		 $result1 = $stmt1->execute();

		 //insert into the age table
		 $sql2 = "INSERT INTO ihs_age(date_created, created_by_firstname, created_by_lastname, unique_id, day, month, year, month_created, currentyear)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :day, :month, :year, :monthcreated, :currentyear)";
		 $stmt2 = $user_home->runQuery($sql2);
		 $stmt2->bindValue(':date_created', $date_created);
		 $stmt2->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt2->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt2->bindValue(':unique_id', $uniqueid);
		 $stmt2->bindValue(':day', $day);
		 $stmt2->bindValue(':month', $month);
		 $stmt2->bindValue(':year', $year);
		 $stmt2->bindValue(':monthcreated', $monthoftest);
		 $stmt2->bindValue(':currentyear', $yearoftest);
		 $result2 = $stmt2->execute();

		 //insert into the education table
		 $sql3 ="INSERT INTO ihs_education(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id,:month, :year)";
		 $stmt3 =$user_home->runQuery($sql3);
		 $stmt3->bindValue(':date_created', $date_created);
		 $stmt3->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt3->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt3->bindValue(':unique_id', $uniqueid);
		 $stmt3->bindValue(':month', $monthoftest);
		 $stmt3->bindValue(':year', $yearoftest);
		 $result3 = $stmt3->execute();

		  //insert into the ethnicity table
		 $sql4 ="INSERT INTO ihs_ethnicity(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt4 =$user_home->runQuery($sql4);
		 $stmt4->bindValue(':date_created', $date_created);
		 $stmt4->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt4->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt4->bindValue(':unique_id', $uniqueid);
		 $stmt4->bindValue(':month', $monthoftest);
		 $stmt4->bindValue(':year', $yearoftest);
		 $result4 = $stmt4->execute();

		  //insert into the gender table
		 $sql5 ="INSERT INTO ihs_gender(date_created, created_by_firstname, created_by_lastname, unique_id, month, year, gender)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year, :gender)";
		 $stmt5=$user_home->runQuery($sql5);
		 $stmt5->bindValue(':date_created', $date_created);
		 $stmt5->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt5->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt5->bindValue(':unique_id', $uniqueid);
		 $stmt5->bindValue(':month', $monthoftest);
		 $stmt5->bindValue(':year', $yearoftest);
		 $stmt5->bindValue(':gender', $gender);
		 $result5 = $stmt5->execute();

		  //insert into the gender identity table
		 $sql6 ="INSERT INTO ihs_gender_identity(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt6=$user_home->runQuery($sql6);
		 $stmt6->bindValue(':date_created', $date_created);
		 $stmt6->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt6->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt6->bindValue(':unique_id', $uniqueid);
		 $stmt6->bindValue(':month', $monthoftest);
		 $stmt6->bindValue(':year', $yearoftest);
		 $result6 = $stmt6->execute();

		 //insert into the ids table
		 $sql7 ="INSERT INTO ihs_ids(date_created, created_by_firstname, created_by_lastname, unique_id)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id)";
		 $stmt7=$user_home->runQuery($sql7);
		 $stmt7->bindValue(':date_created', $date_created);
		 $stmt7->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt7->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt7->bindValue(':unique_id', $uniqueid);
		 $result7 =$stmt7->execute();

		  //insert into the marital status table
		 $sql8 ="INSERT INTO ihs_marital_status(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt8=$user_home->runQuery($sql8);
		 $stmt8->bindValue(':date_created', $date_created);
		 $stmt8->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt8->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt8->bindValue(':unique_id', $uniqueid);
		 $stmt8->bindValue(':month', $monthoftest);
		 $stmt8->bindValue(':year', $yearoftest);
		 $result8= $stmt8->execute();

		  //insert into the occupation table
		 $sql9="INSERT INTO ihs_occupation(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt9=$user_home->runQuery($sql9);
		 $stmt9->bindValue(':date_created', $date_created);
		 $stmt9->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt9->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt9->bindValue(':unique_id', $uniqueid);
		 $stmt9->bindValue(':month', $monthoftest);
		 $stmt9->bindValue(':year', $yearoftest);
		 $result9= $stmt9->execute();

		  //insert into the pregnancy table
		 $sql10 ="INSERT INTO ihs_pregnancy(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt10=$user_home->runQuery($sql10);
		 $stmt10->bindValue(':date_created', $date_created);
		 $stmt10->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt10->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt10->bindValue(':unique_id', $uniqueid);
		 $stmt10->bindValue(':month', $monthoftest);
		 $stmt10->bindValue(':year', $yearoftest);
		 $result10=$stmt10->execute();

		  //insert into the reside table
		 $sql11 ="INSERT INTO ihs_reside(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt11=$user_home->runQuery($sql11);
		 $stmt11->bindValue(':date_created', $date_created);
		 $stmt11->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt11->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt11->bindValue(':unique_id', $uniqueid);
		 $stmt11->bindValue(':month', $monthoftest);
		 $stmt11->bindValue(':year', $yearoftest);
		 $result11= $stmt11->execute();

		  //insert into the residence table
		 $sql12 ="INSERT INTO ihs_residence(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt12=$user_home->runQuery($sql12);
		 $stmt12->bindValue(':date_created', $date_created);
		 $stmt12->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt12->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt12->bindValue(':unique_id', $uniqueid);
		 $stmt12->bindValue(':month', $monthoftest);
		 $stmt12->bindValue(':year', $yearoftest);
		 $result12= $stmt12->execute();

		  //insert into the risk factors table
		 $sql13 ="INSERT INTO ihs_risk_factors(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt13=$user_home->runQuery($sql13);
		 $stmt13->bindValue(':date_created', $date_created);
		 $stmt13->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt13->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt13->bindValue(':unique_id', $uniqueid);
		 $stmt13->bindValue(':month', $monthoftest);
		 $stmt13->bindValue(':year', $yearoftest);
		 $result13= $stmt13->execute();

		  //insert into the sexual activity table
		 $sql14 ="INSERT INTO ihs_sexual_activity(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month,:year)";
		 $stmt14=$user_home->runQuery($sql14);
		 $stmt14->bindValue(':date_created', $date_created);
		 $stmt14->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt14->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt14->bindValue(':unique_id', $uniqueid);
		 $stmt14->bindValue(':month', $monthoftest);
		 $stmt14->bindValue(':year', $yearoftest);
		 $result14= $stmt14->execute();

		  //insert into the sexual orientation table
		 $sql15 ="INSERT INTO ihs_sexual_orientation(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month,:year)";
		 $stmt15=$user_home->runQuery($sql15);
		 $stmt15->bindValue(':date_created', $date_created);
		 $stmt15->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt15->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt15->bindValue(':unique_id', $uniqueid);
		 $stmt15->bindValue(':month', $monthoftest);
		 $stmt15->bindValue(':year', $yearoftest);
		 $result15= $stmt15->execute();

		 //insert into the sexual partner table
		 $sql16 ="INSERT INTO ihs_sexual_partner(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt16=$user_home->runQuery($sql16);
		 $stmt16->bindValue(':date_created', $date_created);
		 $stmt16->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt16->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt16->bindValue(':unique_id', $uniqueid);
		 $stmt16->bindValue(':month', $monthoftest);
		 $stmt16->bindValue(':year', $yearoftest);
		 $result16= $stmt16->execute();

		 //insert into the status table
		 $sql17 ="INSERT INTO ihs_status(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt17=$user_home->runQuery($sql17);
		 $stmt17->bindValue(':date_created', $date_created);
		 $stmt17->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt17->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt17->bindValue(':unique_id', $uniqueid);
		 $stmt17->bindValue(':month', $monthoftest);
		 $stmt17->bindValue(':year', $yearoftest);
		 $result17 = $stmt17->execute();


		 //insert into the hiv table
		 $sql18 ="INSERT INTO ihs_hiv(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt18=$user_home->runQuery($sql18);
		 $stmt18->bindValue(':date_created', $date_created);
		 $stmt18->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt18->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt18->bindValue(':unique_id', $uniqueid);
		 $stmt18->bindValue(':month', $monthoftest);
		 $stmt18->bindValue(':year', $yearoftest);
		 $result18 = $stmt18->execute();


		 //insert into the tb table
		 $sql19 ="INSERT INTO ihs_tb(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt19=$user_home->runQuery($sql19);
		 $stmt19->bindValue(':date_created', $date_created);
		 $stmt19->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt19->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt19->bindValue(':unique_id', $uniqueid);
		 $stmt19->bindValue(':month', $monthoftest);
		 $stmt19->bindValue(':year', $yearoftest);
		 $result19 = $stmt19->execute();



		 //insert into the sti table
		 $sql20 ="INSERT INTO ihs_sti(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt20=$user_home->runQuery($sql20);
		 $stmt20->bindValue(':date_created', $date_created);
		 $stmt20->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt20->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt20->bindValue(':unique_id', $uniqueid);
		 $stmt20->bindValue(':month', $monthoftest);
		 $stmt20->bindValue(':year', $yearoftest);
		 $result20 = $stmt20->execute();

		  //insert into the comorbidities and others table
		 $sql21 ="INSERT INTO ihs_comorbidities_others(date_created, created_by_firstname, created_by_lastname, unique_id, month, year)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt21=$user_home->runQuery($sql21);
		 $stmt21->bindValue(':date_created', $date_created);
		 $stmt21->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt21->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt21->bindValue(':unique_id', $uniqueid);
		 $stmt21->bindValue(':month', $monthoftest);
		 $stmt21->bindValue(':year', $yearoftest);
		 $result21 = $stmt21->execute();


		  //insert into the others table
		 $sql22 ="INSERT INTO ihs_other_test(date_created, created_by_firstname, created_by_lastname, unique_id)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id)";
		 $stmt22=$user_home->runQuery($sql22);
		 $stmt22->bindValue(':date_created', $date_created);
		 $stmt22->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt22->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt22->bindValue(':unique_id', $uniqueid);
		 $result22 = $stmt22->execute();


		 	  //screening notes table
		 $sql23 ="INSERT INTO ihs_screening_notes(date_created, created_by_firstname, created_by_lastname, unique_id, month_created, year_created)VALUES(:date_created, :created_by_firstname, :created_by_lastname, :unique_id, :month, :year)";
		 $stmt23=$user_home->runQuery($sql23);
		 $stmt23->bindValue(':date_created', $date_created);
		 $stmt23->bindValue(':created_by_firstname', $createdbyfirstname);
		 $stmt23->bindValue(':created_by_lastname', $createdbylastname);
		 $stmt23->bindValue(':unique_id', $uniqueid);
		 $stmt23->bindValue(':year', $yearoftest);
		 $stmt23->bindValue(':month', $monthoftest);
		 $result23 = $stmt23->execute();

	if($resultuuid||$result||$result1||$result2||$result3||$result4||$result5||$result6||$result7||$result8||$result9||$result10||$result11||$result12||$result13||$result14||$result15||$result16||$result17||$result18||$result19||$result20||$result21||$result22||$result23){
	     echo "Test has been started successfully";
	}
	else{
    echo "Failure! Failed to create test. Please try again later.";

	}


}

}
//IF THERE IS AN ERROR WITH THE DATABASE
catch(PDOException $e)
    {
    die('SYSTEM FAILURE!!! Please make sure special characters like _, ., /, $ are not contained in your inputs. CONTACT YOUR ADMINISTRATOR IF THE PROBLEM PERSISTS');
	}
?>
