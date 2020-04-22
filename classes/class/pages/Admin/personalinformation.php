<?php
require_once 'includes/supervisorheader.php';
if(!in_array("users_account", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{

?>
		<div class ='jumbotron'>
		<div class ='outer'>
		<div class ='heading'><h3>Update personal Information : (for general population)</h3></div>
		<div class='container'>
		<form method ="post">
		<div class ="row">
		<div class ='col-5'><label>Please Enter Client's Unique ID</label></div>
		<div class ='col-7 columnspacer'><input  type ='text' name ='uniqueid' /></div>
		</div>
		<div class ="spacer"></div>
		<button type ="submit" name ="choose" class ='btnblk'>Get</button>
		</form>
		</div>
		</div>
		<div class = "spacer"></div>

		<?php
		if(isset($_POST['choose'])){
		$uniqueid = !empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;
		if($uniqueid==''||$uniqueid==null){
        echo '<p class ="error">Please enter client\'s Unique ID</p>';
		}
		else {

		try{

			$sql = "SELECT COUNT(unique_id) AS num FROM ihs_testing WHERE unique_id= :uniqueid";
			$stmt1 = $user_home->runQuery($sql);
			$stmt1->bindValue(':uniqueid', $uniqueid);
			$stmt1->execute();
			$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
			if($row1['num'] > 0){

			$sql ="SELECT * FROM ihs_testing WHERE unique_id = :uniqueid";
			$stmt = $user_home->runQuery($sql);
			$stmt->bindValue(':uniqueid', $uniqueid);
			$stmt->execute();
			$rowname = $stmt->fetch(PDO::FETCH_ASSOC);
			$firstname = $rowname['first_name'];
			$middlename = $rowname['middle_name'];
			$lastname = $rowname['last_name'];
			$mmaidenname = $rowname['mother_maiden_name'];
			if($firstname!=null||$firstname!==""){
			$firstenc = new AES($firstname, $inputkey, $blocksize);
			$decfirst = $firstenc->decrypt();
			}
			else {
				$decfirst ="";
			}
			if($middlename!=null||$middlename!==""){
			$middleenc = new AES($middlename, $inputkey, $blocksize);
			$decmiddle = $middleenc->decrypt();
			}
			else {
				$decmiddle ="";
			}
			if($lastname!=null||$lastname!==""){
			$lastenc = new AES($lastname, $inputkey, $blocksize);
			$declast = $lastenc->decrypt();
			}
			else {
				$declast ="";
			}
			if($mmaidenname!=null||$mmaidenname!==""){
			$mmaidennameenc = new AES($mmaidenname, $inputkey, $blocksize);
			$decmmaidenname = $mmaidennameenc->decrypt();
			}
			else {
				$decmmaidenname ="";
			}
		    ?>


		    <div class ='spacer'></div>
			<div class ='outer'>
			<div class ='heading'><h3>Search result</h3></div>
			<div class ='container'>
			<div id="wrapper2">
			<div id="tabContainer">
			<div id="tabs">
			<ul>
			<li id="tabHeader_1">Name</li>
			<li id="tabHeader_2">Gender</li>
			<li id="tabHeader_3">Date of Birth</li>
			<li id="tabHeader_4">Ethnicity</li>
			<li id="tabHeader_5">Country of Birth</li>
			<li id="tabHeader_6">Unique ID</li>

			</ul>
			</div>
			<div id="tabscontent">
			<nav class="tabpage" id="tabpage_1">
<script>
$(document).ready(function(){

$("#updatename").validate({
      rules: {
			firstname: "required",
      mmaidenname: "required",
			lastname: "required",
        },

        // Specify the validation error messages
      messages: {
			firstname: "*",
            mmaidenname: "*",
			lastname: "*",
        },

        submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"updatename.php",
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

			<form method ='post' id ='updatename' novalidate = "novalidate">
			<div class ="row">
			<div class ='col-3'><label>FIRST NAME</label></div>
			<div class ='col-3 columnspacer'><label>MIDDLE NAME</label></div>
			<div class ='col-3 columnspacer'><label>LAST NAME</label></div>
			<div class ='col-3 columnspacer'><label>MOTHER'S MAIDEN NAME</label></div>

			</div>
			<div class ='textspacer'></div>
			<div class ="row">
			<div class ='col-3'><input type ='text' name ='gfirstname' value ="<?php echo $decfirst; ?>" /></div>
			<div class ='col-3 columnspacer'><input type ='text' name ='gmiddlename' value ="<?php echo $decmiddle; ?>" /></div>
			<div class ='col-3 columnspacer'><input type ='text' name ='glastname' value ="<?php echo $declast; ?>" /></div>
			<div class ='col-3 columnspacer'><input type ='text' name ='gmmaidenname' value ="<?php echo $decmmaidenname; ?>" /></div>
			</div>
			<input type ='hidden' name ='hidden1' value = <?php echo $uniqueid?>>
			<button type ="submit" name ="changename" class ='btnblk'>Update</button>
			</form>
			</nav>



<nav class="tabpage" id="tabpage_2">
<script>
$(document).ready(function(){

$("#updategender").validate({
      rules: {
			gender: "required",

        },

        // Specify the validation error messages
        messages: {
			gender: "*",

        },

        submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"updategender.php",
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



			<form method ='post' novalidate ='novalidate' id ='updategender'>
			<div class ="row">
			<div class ="col-5"><label>Gender</label></div>
			<div class ="col-7 columnspacer">
			<select name ='gender'>
			<option value ='<?php echo $rowname['gender']?>' selected>[Choose Here]</option>
			<option value = 'female'<?php if($rowname['gender']=='female') echo 'selected'?>>Female</option>
			<option value = 'male' <?php if($rowname['gender']=='male') echo 'selected'?>>Male</option>
			</select>
			</div>
			</div>
			<input type ='hidden' name ='hidden2' value = <?php echo $uniqueid?>>
			<button type ='submit' name ='changegender' class ='btnblk'>Update</button>
			</form>
			</nav>



			<nav class="tabpage" id="tabpage_3">
			<script>
$(document).ready(function(){

$("#updatedob").validate({
      rules: {
			dobday: "required",
			dobmonth: "required",
			dobyear: "required",
			testingcode: "required",

        },

        // Specify the validation error messages
        messages: {
			day: "*",
			month: "*",
			year: "*",
			testingcode: "*",
        },

        submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"updatedob.php",
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
			</script>
			<form method ='post' novalidate ='novalidate' id ='updatedob'>
			<div class ="row">
			<div class ='col-6'>
			<div class ='row'>
			<div class ="col-5"><label>Date of Birth</label></div>
			<div class ="col-7 columnspacer">

			<label><span class ='previous'><?php echo $rowname['day']." ".$rowname['month']." ".$rowname['year'];?></span></label><br/>
			<select name ="dobday" id ="dobday">
			<option  value ="<?php echo $rowname['day']?>" selected>Day</option>
			</select><br/>
			<select name ="dobmonth" id ="dobmonth">
			<option  value ="<?php echo $rowname['month']?>" selected>Month</option>
			</select><br/>
			<select name ="dobyear" id ="dobyear">
			<option  value ="<?php echo $rowname['year']?>" selected>Year</option>
			</select></div>


			</div>
			</div>

			<div class ='col-6 columnspacer'>
			<div class ='row'>
			<div class ='col-5'><label>Testing Code</label></div>
			<div class ='col-7 columnspacer'><input type ='text' name ='testingcode' value ="<?php echo $rowname['testingcode'] ?>"></div>
			</div>
			</div>
			</div>
			<div class ="spacer"></div>
			<input type ='hidden' name ='hidden3' value = <?php echo $uniqueid?>>
			<button type ='submit' name ='changedob' class ='btnblk'>Update</button>
			</form>
			</nav>




			<nav class="tabpage" id="tabpage_4">

<script>
$(document).ready(function(){

$("#updateethnicity").validate({
      rules: {
			ethnicity: "required",


        },

        // Specify the validation error messages
        messages: {
			ethnicity: "*",

        },

        submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"updateethnicity.php",
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

			<?php
			$sqleth ="SELECT * FROM ihs_ethnicity WHERE unique_id = :uniqueid";
			$stmteth = $user_home->runQuery($sqleth);
			$stmteth->bindValue(':uniqueid', $uniqueid);
			$stmteth->execute();
			$roweth = $stmteth->fetch(PDO::FETCH_ASSOC);
			?>
			<form method ='post' novalidate ='novalidate' id ='updateethnicity'>
			<div class ="row">
	       <label class ="col-5">Ethnicity</label>
	       <div class="col-7 columnspacer">
		   <label><span class ='previous'><?php echo $roweth['ethnicity'];?></span></label><br/>
		   <select name ='ethnicity'>
     <option selected value ='<?php echo $roweth['ethnicity'];?>'><?php echo $roweth['ethnicity'];?></option>
       <?php
         $sqlethnicity = "SELECT * FROM ethnicity";
       $stmt = $user_home->runQuery($sqlethnicity);
       $stmt->execute();
       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

       echo "<option value='".$row['ethnicity']."'>".$row['ethnicity']."</option>";
       }
     ?>
     </select>
			</div>
			</div>
			<div class="textspacer"></div>
			<input type ='hidden' name ='hidden4' value = <?php echo $uniqueid?>>
			<button type ='submit' name ='changeethnicity' class ='btnblk'>Update</button>
			</form>
			</nav>


			<nav class="tabpage" id="tabpage_5">

<script>
$(document).ready(function(){

$("#updatecountry").validate({
      rules: {
			country: "required",


        },

        // Specify the validation error messages
        messages: {
			country: "*",

        },

        submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
		  url:"updatecountry.php",
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
			<?php
			$sqlres ="SELECT * FROM ihs_residence WHERE unique_id = :uniqueid";
			$stmtres = $user_home->runQuery($sqlres);
			$stmtres->bindValue(':uniqueid', $uniqueid);
			$stmtres->execute();
			$rowres = $stmtres->fetch(PDO::FETCH_ASSOC);
			?>
			<form method ='post' novalidate ='novalidate' id ='updatecountry'>
			 <div class ="row">
			<label class ="col-5">Country of Birth</label>
			<div class="col-7 columnspacer">

		    <label><span class ='previous'><?php echo $rowres['country_of_birth'];?></span></label><br/>
				<select name ='country'>
				<option selected value ='<?php echo $rowres['country_of_birth'];?>'>[Choose here]</option>
		         <?php
			    $sqlcountry = "SELECT * FROM countries";
				$stmtcountry = $user_home->runQuery($sqlcountry);
				$stmtcountry->execute();
				while($rowcountry = $stmtcountry->fetch(PDO::FETCH_ASSOC)) {

				echo "<option value='".$rowcountry['country_name']."'>".$rowcountry['country_name']."</option>";
        }
        ?>
		        </select>

		</div>
	  </div>
			<input type ='hidden' name ='hidden5' value = <?php echo $uniqueid?>>
			<button type ='submit' name ='changecountry'class ='btnblk'>Update</button>
			</form>
			</nav>

			<nav class="tabpage" id="tabpage_6">

<script>
$(document).ready(function(){

$("#updateuniqueid").validate({
			rules: {
			uniqueid: "required",


				},

				// Specify the validation error messages
				messages: {
			uniqueid: "Please enter the unique ID of the client",

				},

				submitHandler: function(form) {

	var r = confirm('Are you ready to save the information?');
	if(r==true){
	$.ajax({
			url:"updateuniqueid.php",
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
			<?php
			$sqluuid ="SELECT * FROM ihs_uuid WHERE unique_id = :uniqueid";
			$stmtuuid = $user_home->runQuery($sqluuid);
			$stmtuuid->bindValue(':uniqueid', $uniqueid);
			$stmtuuid->execute();
			$rowuuid = $stmtuuid->fetch(PDO::FETCH_ASSOC);
			$uuid = $rowuuid['uuid'];
			?>
			<form method ='post' novalidate ='novalidate' id ='updateuniqueid'>
			 <div class ="row">
			<label class ="col-5">Unique ID</label>
			<div class="col-7 columnspacer">

				<label><span class ='previous'><?php echo $rowuuid['unique_id'];?></span></label><br/>
				<input type ="text" name ="uniqueid" value ="<?php echo $rowuuid['unique_id']; ?>"/>
		</div>
		</div>
			<input type ='hidden' name ='hidden' value = <?php echo $uuid?>>
			<button type ='submit' name ='changeuniqueid'class ='btnblk'>Update</button>
			</form>
			</nav>
			</div>
			</div>
			</div>

			<?php
		}
		else{

			echo "<p class ='error'>No record was found for the unique ID you entered</p>";
		}
		}

	 catch(PDOException $e)
		{
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

		}

		}
		}

		?>

		</div>
		</div>

		</div>
		</div>
<?php
}
require_once 'includes/supervisorfooter.php';?>
