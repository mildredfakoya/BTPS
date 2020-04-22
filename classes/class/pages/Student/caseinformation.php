<?php
require_once "includes/testingheader.php";
//decrypt the name of the user
$reporterfirstname =$row['firstname'];
$reporterlastname =$row['lastname'];
$firstn =new AES($reporterfirstname, $inputkey, $blocksize);
$dec =$firstn->decrypt();
$lastn =new AES($reporterlastname, $inputkey, $blocksize);
$decl =$lastn->decrypt();
if(!in_array("general_population_screenings", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<script>
//script for form validation and submission.
$(document).ready(function(){
$("#inserttest").validate({
rules: {
      accountday: "required",
      accountmonth: "required",
      accountyear: "required",
      reportercontact: "required",
			facilitytype: "required",
			firstname: "required",
			lastname: "required",
			gender: "required",
			mmaidenname: "required",
			testingcode: "required",
			uniqueid: "required",
			type: "required",
},

// Specify the validation error messages
messages: {
      accountday: "Please select a day",
      accountmonth: "Please select a month",
      accountyear: "Please select a year",
			reportercontact: "please enter a value",
			facilitytype: "please select a type",
			firstname: "please enter a value",
			lastname: "please enter a value",
			gender: "please select a value",
			mmaidenname: "please enter a value ",
			testingcode: "please enter a value",
			uniqueid: "please enter a value",
			type: "please select a value",
},

submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"inserttest.php",
		  method:"post",
		  data:$('form').serialize(),
		  dataType:"text",
		  success:function(strMessage){
		  alert(strMessage);
		  location.reload();
		  },
	   })
	}
}
})
});

//script for date picker

$(document).ready(function(){
  $.dobPicker({
    daySelector: '#dobday', /* Required */
    monthSelector: '#dobmonth', /* Required */
    yearSelector: '#dobyear', /* Required */
    dayDefault: 'Day', /* Optional */
    monthDefault: 'Month', /* Optional */
    yearDefault: 'Year', /* Optional */
    minimumAge: 0, /* Optional */
    maximumAge: 100 /* Optional */

});
});

$(document).ready(function(){
  $.dobPicker({
    daySelector: '#accountday', /* Required */
    monthSelector: '#accountmonth', /* Required */
    yearSelector: '#accountyear', /* Required */
    dayDefault: 'Day', /* Optional */
    monthDefault: 'Month', /* Optional */
    yearDefault: 'Year', /* Optional */
    minimumAge: 0, /* Optional */
    maximumAge: 100 /* Optional */


  });
});

</script>
<script src ='scripts/validatecaseinfo.js'></script>

<!--The User Interface Form -->
<div class ="container row">
<div class ="col-5 jumbotron">
<h4>Please read before filling the form</h4>
<p>Ask the client if the client has been screened since the inception of system use. If the client has been screened previously, use the ID number that was used to create the client's account to retrieve the previous records for updates. <br/>
If the ID number is not found, contact your supervisor with the client's information (first name, middle name, last name, date of birth, type of ID used previously) for unique ID retrieval</p>
<p class ='error'>Note: The testing code is generated automatically using the following algorithm: The standard 6 digit code is maintained.</p>
<ol>
<li>The first letter of first name (Given name)</li>
<li>The first letter of mother's maiden name</li>
<li>The first letter of last name (surname at birth)</li>
<li>Year of birth: First digit of the last 2 numbers</li>
<li>Year of birth: Second digit of the last 2 numbers</li>
<li>Gender: M for male  / F for Female</li>
</ol>
<p class ='error'>For example: A client named <i>Green Brown</i>, mother's maiden name unknown, gender - male and year of birth 1983 will generate the code:GUB83M </p>
<p class ="subtitle">For unknown names, write unknown and the letter u will be used. For unknown date of birth, YY will be used in place of the last two digit of the year of birth</p>
<h4>Unique ID numbers</h4>
<p>The unique ID should be unique to the client. It is with the unique ID that the client's information can be retrieved. It is preferable to enter the ID number of any Government issued photo ID.<br/>
It is important to avoid the use of testing codes as the client's unique ID except when it is the only option left.<br/>
It is also important to verify the identity of the client being screened with a photo ID.</p>
</div>
<div class ="col-7 columnspacer">
<h1>Create Client's Account</h1>
<p><em>Note: This is a one time registration. For subsequent screenings for the same client, use the <strong><a href ="selectscreening.php">New and subsequent screenings link</a>.</strong></em></p>
<p class ="error">If this is a pregnant client, please use the <a href ="registerantenatal.php"><strong>Antenatal Registration link</strong></a>.</p>
<form method ="post" name ="testing" id ='inserttest' novalidate ="novalidate" autocomplete ="off">
<h4>Reporter's Information</h4>
<div class="row">
<label class="col-5">Date of first account creation</label>
<div class="col-7 columnspacer">
<div class="row">
<div class="col-4">
<select id="accountday" name ='accountday'></select>
</div>
<div class="col-4">
<select id="accountmonth" name ='accountmonth'></select>
</div>
<div class="col-4">
<select id="accountyear" name ='accountyear'></select>
</div>
</div>
 </div>
</div>
<div class ="textspacer"></div>
<div class="row">
<label class="col-5">Name of Reporter</label>
<div class="col-7 columnspacer">
First Name: <input type ="text" name ="firstnameofreporter" id ="firstnameofreporter" value ="<?php echo $dec?>"  class ='borderless' readonly/><br/>
Last Name: <input type ="text" name ="lastnameofreporter" id ="lastnameofreporter" value ="<?php echo $decl?>" class ='borderless' readonly/>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5">Contact of Reporter</label>
<div class="col-7 columnspacer">
<input type="text" name ="reportercontact"  maxlength = 35/>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5">Facility Type</label>
<div class="col-7 columnspacer">
<select name = "facilitytype">
<option selected disabled value ="">[Choose here]</option>
<option value ='ANC/PMTCT Clinic'>ANC/PMTCT Clinic</option>
<option value ='Infectious Disease Clinic'>Infectious Disease Clinic</option>
<option value ='Testing and Counselling Site'>T&C Site</option>
<option value ='Public Laboratory'>Public Laboratory</option>
<option value ='Private Health Clinic'>Private Health Clinic</option>
<option value ='Private Laboratory'>Private Laboratory</option>
<option value ='Blood Bank'> Blood Bank</option>
<option value ='Other'>Other</option>
</select>
</div>
</div>
<div class="textspacer"></div>

<h4>Client's Information</h4>
<div class="row">
<label class="col-5">First Name</label>
<div class="col-7 columnspacer">
<input type="text" name ="firstname" maxlength = 50/>
</div>
</div>

<div class="textspacer"></div>
<div class="row">
<label class="col-5">Middle Name</label>
<div class="col-7 columnspacer">
<input type="text" name ="middlename" maxlength = 50/>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5">Last Name</label>
<div class="col-7 columnspacer">
<input type="text" name ="lastname" maxlength = 50/>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5">Date of Birth</label>
<div class="col-7 columnspacer">
<div class="row">
<div class="col-4">
<select id="dobday" name ='day'></select>
</div>
<div class="col-4">
<select id="dobmonth" name ='month'></select>
</div>
<div class="col-4">
<select id="dobyear" name ='year'></select>
<p id ='year' class ='warning'>Year of Birth is Required to Generate Testing Code. Leaving this field Blank will use an YY for testing code generation</p>
</div>
</div>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5 ">Gender</label>
<div class="col-7 columnspacer">
<select name ="gender">
<option selected disabled value ="">[Choose Here]</option>
<option value ="female">Female</option>
<option value ="male">Male</option>
</select>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5">Mother's Maiden Name</label>
<div class="col-7 columnspacer">
<input type="text" name ="mmaidenname" maxlength = 50/>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5">Testing Code</label>
<div class="col-7 columnspacer">
<input type="text" name ="testingcode" onfocus="code();"  readonly maxlength = 20 />
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label class="col-5">Unique ID</label>
<div class="col-7 columnspacer">
<input type="text" name ="uniqueid" maxlength = 35/>
</div>
</div>
<div class="textspacer"></div>
<div class="row">
<label for="disabledSelect" class="col-5">Unique ID type</label>
<div class="col-7 columnspacer">
<select id="disabledSelect" name ="type">
<option disabled selected value ="">[Choose here]</option>
<option value ="driver's license">Driver's License</option>
<option value ="international passport">International Passport</option>
<option value ="generated testing code">Generated Testing Code</option>
<option value ="HIS number">HIS number</option>
<option value ="hospital registration number">Hospital Registration Number</option>
<option value ="social security number">Social Security Number</option>
<option value ="MP ID">MP ID</option>
<option value ="national ID">National ID</option>
<option  value ="other">Other</option>
</select>
</div>
</div>
<div class ='spacer'></div>
<button type="submit" name="register" class="btn btn-success btn-block">Create Account</button>
</form>
</div>
</div>

<?php
}
require_once 'includes/testingfooter.php';?>
