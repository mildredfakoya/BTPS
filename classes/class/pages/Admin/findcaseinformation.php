<?php
ob_start();
require_once "includes/supervisorheader.php";
if(!in_array("users_account", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{

$firstnameErr=$lastnameErr=$explastnameErr=$findantenatalErr="";
$firstname=$lastname=$explastname=$findantenatal="";
$inputkey = "marketdayanyigba";
$blocksize = 256;
?>
       <script src ='scripts/validatefindcaseinfo.js'></script>
	   <div class='jumbotron'>
		<div class ='outer'>
		<div class ='heading'>
		<h3>Retrieve Client's Unique ID</h3></div>
		<div class ="container">
		<fieldset>
		<legend>Find General population Record</legend>
		<form method="post" name ="findid" onSubmit="return validatefirst();">
		Please enter Client's First Name: <input type="text"  maxlength ="50" name="firstname" value ="<?php echo $firstname;?>"><span class ="error" id ="firstname"><?php echo $firstnameErr;?></span><br/>
        <button class ='btnblk' type="submit" name="find">Search by First Name</button><div class ="spacer"></div>
		</form>
		<form method="post" name ="findbylast" onSubmit="return validatelast();">
		Please enter Client's Last Name: <input type="text"  maxlength ="50" name="lastname" value ="<?php echo $lastname;?>"><span class ="error" id ="lastname"><?php echo $lastnameErr;?></span><br/>
        <button class ='btnblk' type="submit" name="findlast" >Search by Last Name</button><div class ="spacer"></div>
		</form>
	    </fieldset>

	    <fieldset>
	    <legend>Find Exposed Infant ID</legend>
	    <form method="post" name ="findexposed" onSubmit="return validateexposed();">
		Please enter Infant's Last Name: <input type="text"  maxlength ="50" name="explastname" value ="<?php echo $explastname;?>"><span class ="error" id ="explastname"><?php echo $explastnameErr;?></span><br/>
        <button class ='btnblk' type="submit" name="findexplast" >Retrieve Exposed Infant's ID</button><div class ="spacer"></div>
		</form>
	    </fieldset>


      <fieldset>
	    <legend>Find Antenatal Client's Unique ID</legend>
	    <form method="post" name ="antenatal" onSubmit="return validateform();">
		  Please enter client's First Name: <input type="text"  maxlength ="50" name="antefirstname" value ="<?php echo $findantenatal;?>"><span class ="error" id ="antefirstname"><?php echo $findantenatalErr;?></span><br/>
        <button class ='btnblk' type="submit" name="btnantenatal" >Find</button><div class ="spacer"></div>
		</form>
	    </fieldset>

	    <div class ="spacer"></div>
	  <?php

if(isset($_POST['find'])){
	if (empty($_POST["firstname"])) {
        $firstnameErr = "Please provide Client's first name";
    }
    else {
        $firstname =  strtolower(!empty($_POST['firstname']) ? $helper->test_input($_POST['firstname']) : null);
		$encfirst = new AES($firstname,$inputkey, $blocksize);
		$firstn = $encfirst->encrypt();
		$encfirst->setData($firstn);


	try{


		$sql2 ="SELECT COUNT(first_name) AS num FROM ihs_testing WHERE first_name= :firstname";
	    $stmt2 = $user_home->runQuery($sql2);
	    $stmt2->bindValue(':firstname', $firstn);
	    $stmt2->execute();
	    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	    if($row2['num'] > 0){



		$sql3 = "SELECT*FROM ihs_testing WHERE first_name='$firstn'";
        $result3 = $user_home->runQuery2($sql3);





		echo "<div class ='outer'><div class ='heading'><h3>Search Result</h3></div>";
		echo "<div class ='container'>";
    echo "<h1>Copy the UNIQUE ID that matches the provided verification information.</h1>";
		echo "<div class ='row'>";

		echo "<div class ='col-2 columnspacer effect'><label>First Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Middle Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Last Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Date of Birth</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Unique id</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Unique id Type</label></div>";
		echo "</div><div class ='textspacer'></div>";
		foreach($result3 as $row2) {

		$encfirst = $row2['first_name'];
		$enclast =$row2['last_name'];
		$encmiddle=$row2['middle_name'];
		if($encfirst != ""){
		$firstn = new AES($encfirst, $inputkey, $blocksize);
		$dec=$firstn->decrypt();
		}
		else {
			$dec ="";
		}

		if($enclast !=""){
		   $lastn = new AES($enclast, $inputkey, $blocksize);
		   $decl=$lastn->decrypt();
		}
		else {
			$decl ="";
		}
		if($encmiddle !=""){
		      $middlen = new AES($encmiddle, $inputkey, $blocksize);
			  $decmd=$middlen->decrypt();
		}
		else {
			$decmd ="";
		}

		$d = $row2['month'];
		 switch($d){
			 case "01":
			 $d = "January";
			 break;
			 case "02":
			 $d = "February";
			 break;
			 case "03":
			 $d = "March";
			 break;
			 case "04":
			 $d = "April";
			 break;
			 case "05":
			 $d = "May";
			 break;
			 case "06":
			 $d = "June";
			 break;
			 case "07":
			 $d = "July";
			 break;
			 case "08":
			 $d = "August";
			 break;
			 case "09":
			 $d = "September";
			 break;
			 case "10":
			 $d = "October";
			 break;
			 case "11":
			 $d = "November";
			 break;
			 case "12":
			 $d = "December";
			 break;
			 Default:
			 $d ="No Month Selected";
			 }

		echo "<div class ='row'>";
		echo "<div class ='col-2 columnspacer effect'>".$dec."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$decmd."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$decl."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['year']." ".$d." ".$row2['day']."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['unique_id']."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['type']."</div></div>";
		}
		echo "</div></div></div>";
		}
		else{
			$user_home->redirect('failure.php?nonefound');
		}
	}

catch(PDOException $e)
    {
   die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
    }

}

}

if(isset($_POST['findlast'])){
	if (empty($_POST["lastname"])) {
        $lastnameErr = "Please provide Client's last name";
    }
    else {
        $lastname=  strtolower(!empty($_POST['lastname']) ? $helper->test_input($_POST['lastname']) : null);
		$enclast = new AES($lastname,$inputkey, $blocksize);
		$lastn = $enclast->encrypt();
		$enclast->setData($lastn);


	try{


		$sql2 ="SELECT COUNT(last_name) AS num FROM ihs_testing WHERE last_name= :lastname";
	    $stmt2 = $user_home->runQuery($sql2);
	    $stmt2->bindValue(':lastname', $lastn);
	    $stmt2->execute();
	    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	    if($row2['num'] > 0){



		$sql3 = "SELECT*FROM ihs_testing WHERE last_name='$lastn'";
        $result3 = $user_home->runQuery2($sql3);



		echo "<div class ='outer'>";
		echo "<div class ='heading'><h3>Search Result</h3></div><div class ='container'>";
    echo "<h1>Copy the UNIQUE ID that matches the provided verification information.</h1>";
		echo "<div class ='row'>";
		echo "<div class ='col-2 effect'><label>First Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Middle Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Last Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Date of Birth</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Unique id</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Unique id Type</label></div>";
		echo "</div><div class ='textspacer'></div>";
		foreach($result3 as $row2) {

		$encfirst = $row2['first_name'];
		$enclast =$row2['last_name'];
		$encmiddle=$row2['middle_name'];
		if($encfirst != ""){
		$firstn = new AES($encfirst, $inputkey, $blocksize);
		$dec=$firstn->decrypt();
		}
		else {
			$dec ="";
		}

		if($enclast !=""){
		   $lastn = new AES($enclast, $inputkey, $blocksize);
		   $decl=$lastn->decrypt();
		}
		else {
			$decl ="";
		}
		if($encmiddle !=""){
		      $middlen = new AES($encmiddle, $inputkey, $blocksize);
			  $decmd=$middlen->decrypt();
		}
		else {
			$decmd ="";
		}

		$d = $row2['month'];
		 switch($d){
			 case "01":
			 $d = "January";
			 break;
			 case "02":
			 $d = "February";
			 break;
			 case "03":
			 $d = "March";
			 break;
			 case "04":
			 $d = "April";
			 break;
			 case "05":
			 $d = "May";
			 break;
			 case "06":
			 $d = "June";
			 break;
			 case "07":
			 $d = "July";
			 break;
			 case "08":
			 $d = "August";
			 break;
			 case "09":
			 $d = "September";
			 break;
			 case "10":
			 $d = "October";
			 break;
			 case "11":
			 $d = "November";
			 break;
			 case "12":
			 $d = "December";
			 break;
			 Default:
			 $d ="No Month Selected";
			 }

		echo "<div class ='row'>";
		echo "<div class ='col-2  effect'>".$dec."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$decmd."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$decl."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['year']." ".$d." ".$row2['day']."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['unique_id']."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['type']."</div></div>";
		}
		echo '</div>';
		echo '</div>';
		}
		else{
			$user_home->redirect('failure.php?nonefound');
		}
	}

catch(PDOException $e)
    {
    die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
    }

}

}






if(isset($_POST['findexplast'])){
	if (empty($_POST["explastname"])) {
        $explastnameErr = "Please provide Client's last name";
    }
    else {
        $explastname=  strtolower(!empty($_POST['explastname']) ? $helper->test_input($_POST['explastname']) : null);
		$encexplast = new AES($explastname,$inputkey, $blocksize);
		$explastn = $encexplast->encrypt();
		$encexplast->setData($explastn);


	try{


		$sql2 ="SELECT COUNT(ilname) AS num FROM ihs_register_exposed WHERE ilname= :lastname";
	    $stmt2 = $user_home->runQuery($sql2);
	    $stmt2->bindValue(':lastname', $explastn);
	    $stmt2->execute();
	    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	    if($row2['num'] > 0){



		$sql3 = "SELECT*FROM ihs_register_exposed WHERE ilname='$explastn'";
        $result3 = $user_home->runQuery2($sql3);



		echo "<div class ='outer'>";
		echo "<div class ='heading'><h3>Search Result</h3></div><div class ='container'>";
    echo "<h1>Copy the UNIQUE ID that matches the provided verification information.</h1>";
		echo "<div class ='row'>";

		echo "<div class ='col-2 columnspacer effect'><label>First Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Middle Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Last Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Date of Birth</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Unique id</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Mother's Unique ID</label></div>";
		echo "</div><div class ='textspacer'></div>";
		foreach($result3 as $row2) {

		$encfirst = $row2['ifname'];
		$enclast =$row2['ilname'];
		$encmiddle=$row2['imname'];
		if($encfirst != ""){
		$firstn = new AES($encfirst, $inputkey, $blocksize);
		$dec=$firstn->decrypt();
		}
		else {
			$dec ="";
		}

		if($enclast !=""){
		   $lastn = new AES($enclast, $inputkey, $blocksize);
		   $decl=$lastn->decrypt();
		}
		else {
			$decl ="";
		}
		if($encmiddle !=""){
		      $middlen = new AES($encmiddle, $inputkey, $blocksize);
			  $decmd=$middlen->decrypt();
		}
		else {
			$decmd ="";
		}

		$d = $row2['month'];
		 switch($d){
			 case "01":
			 $d = "January";
			 break;
			 case "02":
			 $d = "February";
			 break;
			 case "03":
			 $d = "March";
			 break;
			 case "04":
			 $d = "April";
			 break;
			 case "05":
			 $d = "May";
			 break;
			 case "06":
			 $d = "June";
			 break;
			 case "07":
			 $d = "July";
			 break;
			 case "08":
			 $d = "August";
			 break;
			 case "09":
			 $d = "September";
			 break;
			 case "10":
			 $d = "October";
			 break;
			 case "11":
			 $d = "November";
			 break;
			 case "12":
			 $d = "December";
			 break;
			 Default:
			 $d ="No Month Selected";
			 }

		echo "<div class ='row'>";
		echo "<div class ='col-2 columnspacer effect'>".$dec."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$decmd."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$decl."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['year']." ".$d." ".$row2['day']."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['unique_id']."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['muniqueid']."</div></div>";
		}
		echo '</div>';
		echo '</div>';
		}
		else{
			$user_home->redirect('failure.php?nonefound');
		}
	}

catch(PDOException $e)
    {
    die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
    }

}

}


if(isset($_POST['btnantenatal'])){
	if (empty($_POST["antefirstname"])) {
        $findantenatalErr = "Please provide Client's first name";
    }
    else {
    $antefirstname =  strtolower(!empty($_POST['antefirstname']) ? $helper->test_input($_POST['antefirstname']) : null);
		$encantefirst = new AES($antefirstname,$inputkey, $blocksize);
		$antefirstn = $encantefirst->encrypt();
		$encantefirst->setData($antefirstn);


	try{


		  $sql2 ="SELECT COUNT(first_name) AS num FROM antenatal_reg WHERE first_name= :firstname";
	    $stmt2 = $user_home->runQuery($sql2);
	    $stmt2->bindValue(':firstname', $antefirstn);
	    $stmt2->execute();
	    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	    if($row2['num'] > 0){



		  $sql3 = "SELECT*FROM antenatal_reg WHERE first_name='$antefirstn'";
        $result3 = $user_home->runQuery2($sql3);





		echo "<div class ='outer'><div class ='heading'><h3>Search Result</h3></div>";
		echo "<div class ='container'>";
    echo "<h1>Copy the UNIQUE ID that matches the provided verification information.</h1>";
		echo "<div class ='row'>";

		echo "<div class ='col-2 columnspacer effect'><label>First Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Middle Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Last Name</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Date of Birth</label></div>";
		echo "<div class ='col-2 columnspacer effect'><label>Unique id</label></div>";
		echo "</div><div class ='textspacer'></div>";
		foreach($result3 as $row2) {

		$encfirst = $row2['first_name'];
		$enclast =$row2['last_name'];
		$encmiddle=$row2['middle_name'];
		if($encfirst != ""){
		$firstn = new AES($encfirst, $inputkey, $blocksize);
		$dec=$firstn->decrypt();
		}
		else {
			$dec ="";
		}

		if($enclast !=""){
		   $lastn = new AES($enclast, $inputkey, $blocksize);
		   $decl=$lastn->decrypt();
		}
		else {
			$decl ="";
		}
		if($encmiddle !=""){
		      $middlen = new AES($encmiddle, $inputkey, $blocksize);
			  $decmd=$middlen->decrypt();
		}
		else {
			$decmd ="";
		}

		$d = $row2['month_of_birth'];
		 switch($d){
			 case "01":
			 $d = "January";
			 break;
			 case "02":
			 $d = "February";
			 break;
			 case "03":
			 $d = "March";
			 break;
			 case "04":
			 $d = "April";
			 break;
			 case "05":
			 $d = "May";
			 break;
			 case "06":
			 $d = "June";
			 break;
			 case "07":
			 $d = "July";
			 break;
			 case "08":
			 $d = "August";
			 break;
			 case "09":
			 $d = "September";
			 break;
			 case "10":
			 $d = "October";
			 break;
			 case "11":
			 $d = "November";
			 break;
			 case "12":
			 $d = "December";
			 break;
			 Default:
			 $d ="No Month Selected";
			 }

		echo "<div class ='row'>";
		echo "<div class ='col-2 columnspacer effect'>".$dec."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$decmd."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$decl."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['year_of_birth']." ".$d." ".$row2['day_of_birth']."</div>";
		echo "<div class ='col-2 columnspacer effect'>".$row2['unique_id']."</div>";

		}
		echo "</div></div></div>";
		}
		else{
			$user_home->redirect('failure.php?nonefound');
		}
	}

catch(PDOException $e)
    {
   die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
    }

}

}

	  ?>
	  </div></div></div>
<?php
}
require_once "includes/supervisorfooter.php";?>
