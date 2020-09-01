<?php
require_once 'includes/adminheader.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
$email = $row['email'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];

$sqlid="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
$stmtid = $user_home->runQuery($sqlid);
$stmtid->bindValue(':email', $email);
$stmtid->execute();
$rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
$list = $rowid['permissions'];
$permissions = explode(" ", $list);
if(!in_array("records", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<script>
$(document).ready(function(){
  $.dobPicker({
    daySelector: '#dobday', /* Required */
    monthSelector: '#dobmonth', /* Required */
    yearSelector: '#dobyear', /* Required */
    dayDefault: 'Day', /* Optional */
    monthDefault: 'Month', /* Optional */
    yearDefault: 'Year', /* Optional */
    minimumAge: 0, /* Optional */
    maximumAge: 30 /* Optional */


  });
});


$(document).ready(function(){

$("#personal").validate({
      rules: {
			dobday: "required",
			dobmonth: "required",
			dobyear: "required",
			gender: "required",
			access:"required"

        },

        // Specify the validation error messages
        messages: {
					dobday: "Please select day of birth",
					dobmonth: "Please select month of birth",
					dobyear: "Please select year of birth",
					gender: "please select a gender",
					access:"Please select access"
        },

        submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"updatepersonalinformation.php",
		  method:"post",
		  data:$('form').serialize(),
		  dataType:"text",
		   success:function(strMessage){
			  alert(strMessage);
			  location.reload();


		  }

	   })
	}
}
	})
     });

</script>
<h2 class ="header">Student's Information Form</h2>
<div class ="jumbotron">


<form  method ="post" novalidate ="novalidate" id ="extractstudent" autocomplete = "off">
<div class ="row">
<div class ="col-5"><label>Please enter student's email address</label></div>
<div class ="col-7 columnspacer"><input type ="email" name ="studentemail" required/></div>
</div>
<button class ='btn-large btn-info' type ="submit" name ="choose">Get file</button>

</form>
</div>
<?php
if(isset($_POST['choose'])){

		 $studentemail = !empty($_POST['studentemail']) ? $helper->test_input($_POST['studentemail']) : null;
		if(!empty($studentemail)){
			try{
				$encstudentemail = new AES($studentemail, $inputkey, $blocksize);
	 		 $emailn = $encstudentemail->encrypt();
	 		 $encstudentemail->setData($emailn);
			  $sqlid="SELECT * FROM ihs_students WHERE email= :email" ;
		    $stmtid = $user_home->runQuery($sqlid);
		    $stmtid->bindValue(':email', $emailn);
		    $stmtid->execute();
		    $rowid = $stmtid->fetch(PDO::FETCH_ASSOC);
			//IF THE CLIENT ALREADY HAS AN ACCOUNT, THEN INSERT THE NEW TEST INTO THE ihs_screenings table
			if($rowid){
				$created_by_firstname = $rowid['created_by_firstname'];
				$created_by_lastname = $rowid['created_by_lastname'];
				$createdfn = new AES($created_by_firstname, $inputkey, $blocksize);
				$createdln = new AES($created_by_lastname, $inputkey, $blocksize);
				$fndec =$createdfn->decrypt();
				$lndec =$createdln->decrypt();


				#students Information
				$student_firstname = $rowid['first_name'];
				$student_lastname = $rowid['last_name'];
				$student_email = $rowid['email'];
				$studentfn = new AES($student_firstname, $inputkey, $blocksize);
				$studentln = new AES($student_lastname, $inputkey, $blocksize);
				$studentemail = new AES($student_email, $inputkey, $blocksize);
				$studentfndec =$studentfn->decrypt();
				$studentlndec =$studentln->decrypt();
				$studentemaildec =$studentemail->decrypt();

				if($rowid['middle_name'] !=NULL || $rowid['middle_name']!=''){
            $student_middlename = $rowid['middle_name'];
						$studentmn = new AES($student_middlename, $inputkey, $blocksize);
						$studentmndec =$studentmn->decrypt();
				}else{
					$studentmndec = '';
				}

				?>

<div id="wrapper2">
<div id="tabContainer">
<div id="tabs">
  <ul>
		<li id="tabHeader_1">Account Information</li>
		<li id="tabHeader_2">Personal Information</li>
	 <li id="tabHeader_3">Academic Standing</li>

 </ul>
</div>
<div id="tabscontent">
  <nav class="tabpage" id="tabpage_1">
    <table>
			<tr>
				<th>This account was created at:</th>
				<th>This account was created by:</th>
				<th>Student's first name</th>
				<th>Student's middle name</th>
				<th>Student's last name</th>
				<th>Student's Email</th>
			</tr>
			<tr>
				<td><?php echo $rowid['created_at'] ?></td>
				<td><?php echo $fndec. ' '.$lndec?></td>
				<td><?php echo $studentfndec?></td>
				<td><?php echo $studentmndec?></td>
				<td><?php echo $studentlndec?></td>
				<td><?php echo $studentemaildec?></td>
			</tr>
  </table>
  </nav>
  <nav class="tabpage" id="tabpage_2">
<?php
$sqlaccess="SELECT * FROM ihs_users WHERE email= :email" ;
$stmtaccess = $user_home->runQuery($sqlaccess);
$stmtaccess->bindValue(':email', $emailn);
$stmtaccess->execute();
$rowaccess = $stmtaccess->fetch(PDO::FETCH_ASSOC);
?>
<form method ="post" id ="personal" novalidate ="novalidate" autocomplete="off">
<table>
  <tr>
  <th>Date of birth:</th>
	<th>Gender:</th>
	<th>Grade:</th>
	<th>Access_right: </th>
</tr>
  <tr>
	<td>
	  <div class ="row">
		<div class ="col-4">
		<select name ="dobday" id ="dobday">
		<option  value ="<?php echo $rowid['day_of_birth']?>" selected><?php echo $rowid['day_of_birth']?></option>
		</select></div>
	<div class ="col-4 columnspacer">
		<select name ="dobmonth" id ="dobmonth">
		<option  value ="<?php echo $rowid['month_of_birth']?>" selected><?php echo $rowid['month_of_birth']?></option>
		</select></div>
	<div class ="col-4 columnspacer">
    <select name ="dobyear" id ="dobyear">
		<option  value ="<?php echo $rowid['year_of_birth']?>" selected><?php echo $rowid['year_of_birth']?></option>
	 </select></div>
	</div>
	</td>
	<td>
	<input type ="radio" name ='gender' value="female" <?php if ($rowid['gender'] == "female") echo "checked"; ?>>Female<br/>
	<input type ="radio" name ='gender' value="male" <?php if ($rowid['gender'] == "male") echo "checked"; ?>>Male</td>
 <td>
<select name ="grade">
<option value ="<?php echo $rowid['grade'];?>" selected><?php echo $rowid['grade'];?></option>
<option value ="prek">Pre k</option>
<option value ="gradek">Grade K</option>
<option value ="grade1">Grade 1</option>
<option value ="grade2">Grade 2</option>
<option value ="grade3">Grade 3</option>
<option value ="grade4">Grade 4</option>
<option value ="grade5">Grade 5</option>
<option value ="grade6">Grade 6</option>
<option value ="grade7">Grade 7</option>
<option value ="grade8">Grade 8</option>
<option value ="grade9">Grade 9</option>
<option value ="grade10">Grade 10</option>
<option value ="grade11">Grade 11</option>
</select>
</td>
<td>
<select name ="access">
<option value ="<?php echo $rowaccess['access_status']?>" selected><?php echo $rowaccess['access_status']?></option>
<option value ="OK">OK</option>
<option value = "Restricted">Restricted</option>
</select>
</td>
</tr>

  <tr>
    <th>Address:</th>
    <th>Telephone number:</th>
    <th>Medical Conditions:</th>
    <th>Medications:</th>
  </tr>

  <tr>
    <td><input type ="text"  name = "address" value ="<?php echo $rowid['address']?>"/></td>
    <td><input type ="number"  name = "phone" value ="<?php echo $rowid['telephone']?>"/></td>
    <td><textarea name="conditions" cols="50" rows="4" ><?php echo $rowid['medical_conditions'] ?></textarea></td>
    <td><textarea name="medications" cols="50" rows="4"><?php echo $rowid['medications'] ?></textarea></td>
  </tr>

  <tr>
    <th>Emergency contact:</th>
    <th>Other Information:</th>
  </tr>

  <tr>
    <td><input type ="text"  name = "contact" value ="<?php echo $rowid['emergency_contact']?>"/></td>
    <td><textarea name="others" cols="50" rows="4"><?php echo $rowid['other_information'] ?></textarea></td>
  </tr>
</table>
<input type ="hidden" value ="<?php echo $rowid['email']?>" name = "hiddenpersonal">
<input type ="submit" value ="Update" class ="btn btn-primary">
</form>
</nav>

<nav class="tabpage" id="tabpage_3">
  under construction
</nav>

</div></div></div>
<?php
	}
// IF NO RECORD EXITS FOR THE CLIENT
else{
		echo "FAILURE!! Reason: NO record was found for the email address you entered. Please ensure the email address you entered is correct or create students account before proceeding.";
}
}
//IF THERE IS AN ERROR WITH THE DATABASE INSERTION
catch(PDOException $e)
	  {
	    die('SYSTEM FAILURE!!! Please ensure that you have not entered any special characters into the fields OR contact your administrator for assisstance');
		}

}
else{
		echo "Please fill in all the fields.";
}

}
}
require_once 'includes/adminfooter.php';
?>
