<?php
require_once 'includes/adminheader.php';
if(!in_array("users_account", $permissions)){
$user_home->redirect('../../errors.php?nop');

}
else{
$firstname=$lastname=$email=$cemail=$password=$cpassword =$role ="";
$firstnameErr=$lastnameErr=$emailErr=$cemailErr=$passwordErr=$cpasswordErr=$roleErr ="";
?>
<div class ='jumbotron'>
<?php
if(isset($_POST['register']))
{


	date_default_timezone_set('America/dominica');
	$created_at = date("y-m-d h:i:s");
	$created_by_firstname = $row['firstname'];
	$created_by_lastname = $row['lastname'];

	if (empty($_POST["firstname"])){
        $firstnameErr = "*required";
    }

    else {
    $firstname= strtolower(!empty($_POST['firstname']) ? $helper->test_input($_POST['firstname']) : null);
		$encfirst = new AES($firstname, $inputkey, $blocksize);
		$firstn = $encfirst->encrypt();
		$encfirst->setData($firstn);

    }



	 if (empty($_POST["lastname"])) {
        $lastnameErr = "*required";
    }
    else {
    $lastname= strtolower(!empty($_POST['lastname']) ? $helper->test_input($_POST['lastname']) : null);
		$enclast= new AES($lastname, $inputkey, $blocksize);
		$lastn = $enclast->encrypt();
		$enclast->setData($lastn);
    }


	 if (empty($_POST["email"])){
        $emailErr = "*required";
    }
    else {
    $email= strtolower(!empty($_POST['email']) ? $helper->test_input($_POST['email']) : null);
		$encemail= new AES($email, $inputkey, $blocksize);
		$emailn = $encemail->encrypt();
		$encemail->setData($emailn);

    }


	 if (empty($_POST["cemail"])){
        $cemailErr = "*required";
    }
    else {
		$cemail = strtolower(!empty($_POST['cemail']) ? $helper->test_input($_POST['cemail']) : null);

    }

	 if (empty($_POST["password"])){
        $passwordErr = "*required";
    }
    else {
    $password= strtolower(!empty($_POST['password']) ? $helper->test_input($_POST['password']) : null);
		$encpassword= new AES($password, $inputkey, $blocksize);
		$passwordn = $encpassword->encrypt();
		$encpassword->setData($passwordn);

    }

	 if (empty($_POST["cpassword"])){
        $cpasswordErr = "*required";
    }
    else {
        $cpassword= strtolower(!empty($_POST['cpassword']) ? $helper->test_input($_POST['cpassword']) : null);

    }



	 if (empty($_POST["role"])||($_POST["role"])==null){
        $roleErr = "*required";
    }
    else {
        $role= !empty($_POST['role']) ? $helper->test_input($_POST['role']) : null;

    }


	$code = bin2hex(random_bytes(10));

	$uuid = bin2hex(random_bytes(50));

	$access = 'Restricted';

	if(isset($_REQUEST['permissions'])){
	$assigned = $_REQUEST['permissions'];
	$permissions ="";

    //$permissions as an array now
	foreach ($assigned as $selected2) {
	$permissions = $permissions . " ". $selected2;
	}
	}
	else {
	$permissions = "";
	}


	if($password!==$cpassword){
			$cpasswordErr ='*must be same as password';
		}
	else if($email!==$cemail){
			$cemailErr ='*must be same as email';
		}

	else if(!empty($firstn&&$lastn&&$emailn&&$cemail&&$passwordn&&$cpassword&&$role)){

	try{
		$sqlk="SELECT * FROM ihs_users WHERE email= :email" ;
	    $stmtk = $user_home->runQuery($sqlk);
	    $stmtk->bindValue(':email', $emailn);
	    $stmtk->execute();
	    $rowk = $stmtk->fetch(PDO::FETCH_ASSOC);

	if($stmtk->rowCount() > 0)
	{

          echo  "<div class='alert alert-danger'>
				<strong>The Email you entered already exists. Please use another Email</strong>
		</div>" ;

	}
	else
	{
		$user_home->register($uuid, $firstn, $lastn, $emailn, $passwordn, $role, $code, $access, $created_at, $created_by_firstname, $created_by_lastname);
		$id = $user_home->lasdID();
		$key = base64_encode($id);
		$id = $key;

		 $sqlset = "INSERT INTO ihs_user_permissions(email, permissions)VALUES(:emailn, :permissions)";
     $stmtset = $user_home->runQuery($sqlset);
		 $stmtset->bindValue(':emailn' ,$emailn);
		 $stmtset->bindValue(':permissions', $permissions);
		 $resultset = $stmtset->execute();
    if($role =="Student"){
		$sqlstudent = "INSERT INTO ihs_students(uuid, created_at, created_by_firstname, created_by_lastname, first_name, last_name, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :first_name, :last_name, :email)";
		$stmtstudent = $user_home->runQuery($sqlstudent);
		$stmtstudent->bindValue(':uuid' ,$uuid);
		$stmtstudent->bindValue(':created_at' ,$created_at);
		$stmtstudent->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudent->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudent->bindValue(':first_name' ,$firstn);
		$stmtstudent->bindValue(':last_name' ,$lastn);
		$stmtstudent->bindValue(':email' ,$emailn);
		$resultstudent = $stmtstudent->execute();

		$sqlstudentchange = "INSERT INTO ihs_students_change(uuid, created_at, created_by_firstname, created_by_lastname, first_name, last_name, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :first_name, :last_name, :email)";
		$stmtstudentchange = $user_home->runQuery($sqlstudentchange);
		$stmtstudentchange->bindValue(':uuid' ,$uuid);
		$stmtstudentchange->bindValue(':created_at' ,$created_at);
		$stmtstudentchange->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentchange->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentchange->bindValue(':first_name' ,$firstn);
		$stmtstudentchange->bindValue(':last_name' ,$lastn);
		$stmtstudentchange->bindValue(':email' ,$emailn);
		$resultstudentchange = $stmtstudentchange->execute();

		$sqlstudentgender = "INSERT INTO ihs_students_gender(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentgender = $user_home->runQuery($sqlstudentgender);
		$stmtstudentgender->bindValue(':uuid' ,$uuid);
		$stmtstudentgender->bindValue(':created_at' ,$created_at);
		$stmtstudentgender->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentgender->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentgender->bindValue(':email' ,$emailn);
		$resultstudentgender = $stmtstudentgender->execute();


		$sqlstudentgenderchange = "INSERT INTO ihs_students_gender_change(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentgenderchange = $user_home->runQuery($sqlstudentgenderchange);
		$stmtstudentgenderchange->bindValue(':uuid' ,$uuid);
		$stmtstudentgenderchange->bindValue(':created_at' ,$created_at);
		$stmtstudentgenderchange->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentgenderchange->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentgenderchange->bindValue(':email' ,$emailn);
		$resultstudentgenderchange = $stmtstudentgenderchange->execute();

		$sqlstudentclass = "INSERT INTO ihs_students_class(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentclass = $user_home->runQuery($sqlstudentclass);
		$stmtstudentclass->bindValue(':uuid' ,$uuid);
		$stmtstudentclass->bindValue(':created_at' ,$created_at);
		$stmtstudentclass->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentclass->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentclass->bindValue(':email' ,$emailn);
		$resultstudentclass = $stmtstudentclass->execute();

		$sqlstudentclasschange = "INSERT INTO ihs_students_class_change(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentclasschange = $user_home->runQuery($sqlstudentclasschange);
		$stmtstudentclasschange->bindValue(':uuid' ,$uuid);
		$stmtstudentclasschange->bindValue(':created_at' ,$created_at);
		$stmtstudentclasschange->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentclasschange->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentclasschange->bindValue(':email' ,$emailn);
		$resultstudentclasschange = $stmtstudentclasschange->execute();

		$sqlstudentcontact = "INSERT INTO ihs_students_contact(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentcontact = $user_home->runQuery($sqlstudentcontact);
		$stmtstudentcontact->bindValue(':uuid' ,$uuid);
		$stmtstudentcontact->bindValue(':created_at' ,$created_at);
		$stmtstudentcontact->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentcontact->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentcontact->bindValue(':email' ,$emailn);
		$resultstudentcontact = $stmtstudentcontact->execute();

		$sqlstudentcontactchange = "INSERT INTO ihs_students_contact_change(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentcontactchange = $user_home->runQuery($sqlstudentcontactchange);
		$stmtstudentcontactchange->bindValue(':uuid' ,$uuid);
		$stmtstudentcontactchange->bindValue(':created_at' ,$created_at);
		$stmtstudentcontactchange->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentcontactchange->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentcontactchange->bindValue(':email' ,$emailn);
		$resultstudentcontactchange = $stmtstudentcontactchange->execute();

		$sqlstudentage = "INSERT INTO ihs_students_age(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentage = $user_home->runQuery($sqlstudentage);
		$stmtstudentage->bindValue(':uuid' ,$uuid);
		$stmtstudentage->bindValue(':created_at' ,$created_at);
		$stmtstudentage->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentage->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentage->bindValue(':email' ,$emailn);
		$resultstudentage = $stmtstudentage->execute();

		$sqlstudentagechange = "INSERT INTO ihs_students_age_change(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentagechange = $user_home->runQuery($sqlstudentagechange);
		$stmtstudentagechange->bindValue(':uuid' ,$uuid);
		$stmtstudentagechange->bindValue(':created_at' ,$created_at);
		$stmtstudentagechange->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentagechange->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentagechange->bindValue(':email' ,$emailn);
		$resultstudentagechange = $stmtstudentagechange->execute();

		$sqlstudentmedical= "INSERT INTO ihs_students_medical(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentmedical = $user_home->runQuery($sqlstudentmedical);
		$stmtstudentmedical->bindValue(':uuid' ,$uuid);
		$stmtstudentmedical->bindValue(':created_at' ,$created_at);
		$stmtstudentmedical->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentmedical->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentmedical->bindValue(':email' ,$emailn);
		$resultstudentmedical = $stmtstudentmedical->execute();

		$sqlstudentmedicalchange= "INSERT INTO ihs_students_medical_change(uuid, created_at, created_by_firstname, created_by_lastname, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :email)";
		$stmtstudentmedicalchange = $user_home->runQuery($sqlstudentmedicalchange);
		$stmtstudentmedicalchange->bindValue(':uuid' ,$uuid);
		$stmtstudentmedicalchange->bindValue(':created_at' ,$created_at);
		$stmtstudentmedicalchange->bindValue(':created_by_firstname' ,$created_by_firstname);
		$stmtstudentmedicalchange->bindValue(':created_by_lastname' ,$created_by_lastname);
		$stmtstudentmedicalchange->bindValue(':email' ,$emailn);
		$resultstudentmedicalchange = $stmtstudentmedicalchange->execute();
   }

	 if($role =="Teacher"){
		 $sqlteacher = "INSERT INTO ihs_teachers(uuid, created_at, created_by_firstname, created_by_lastname, first_name, last_name, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :first_name, :last_name, :email)";
		 $stmtteacher = $user_home->runQuery($sqlteacher);
		 $stmtteacher->bindValue(':uuid' ,$uuid);
		 $stmtteacher->bindValue(':created_at' ,$created_at);
		 $stmtteacher->bindValue(':created_by_firstname' ,$created_by_firstname);
		 $stmtteacher->bindValue(':created_by_lastname' ,$created_by_lastname);
		 $stmtteacher->bindValue(':first_name' ,$firstn);
		 $stmtteacher->bindValue(':last_name' ,$lastn);
		 $stmtteacher->bindValue(':email' ,$emailn);
		 $resultteacher = $stmtteacher->execute();

		 $sqlteacherchange = "INSERT INTO ihs_teachers_change(uuid, created_at, created_by_firstname, created_by_lastname, first_name, last_name, email)VALUES(:uuid, :created_at, :created_by_firstname, :created_by_lastname, :first_name, :last_name, :email)";
		 $stmtteacherchange = $user_home->runQuery($sqlteacherchange);
		 $stmtteacherchange->bindValue(':uuid' ,$uuid);
		 $stmtteacherchange->bindValue(':created_at' ,$created_at);
		 $stmtteacherchange->bindValue(':created_by_firstname' ,$created_by_firstname);
		 $stmtteacherchange->bindValue(':created_by_lastname' ,$created_by_lastname);
		 $stmtteacherchange->bindValue(':first_name' ,$firstn);
		 $stmtteacherchange->bindValue(':last_name' ,$lastn);
		 $stmtteacherchange->bindValue(':email' ,$emailn);
		 $resultteacherchange = $stmtteacherchange->execute();
	 }

			$message = "
						Hello $firstname,
						<br /><br />
						Welcome to Bonne Terre Preparatory School!<br/>
						To complete your registration,  please click following link<br/>
						<br /><br />
						<a href='https://btpps.org/classes/class/verify.php?id=$id&code=$code'>Click HERE to Activate </a>
						<br /><br />
						Thanks,";

			$subject = "Bonne Terre Preparatory School - Account Activation";

			$user_home->send_mail($email, $message, $subject);

			echo "<div class='alert alert-success'>
						<strong>Success!</strong>  We've sent an email to $email.
                    <p>Ask the user to click on the link in the email to activate the account.
					</p>
					<p><strong>This page will be refreshed in 10 seconds</strong></p>
					</div>";
         header('refresh:10; signup.php');


	}
	}


catch(PDOException $ex){
//die('The Email address you entered could not be validated / no longer exists. Please contact your Administrator');
echo $ex->getMessage();
}

}
else{
	echo			"<div class='alert alert-danger'>
					<strong>Failure!</strong>  User Account has not been created. Please fill in all fields to create user's account.
			  		</div>";
}
}


?>
<script>
$(document).ready(function () {
toggleFields();
$("#urole").change(function () {
toggleFields();
});
});
function toggleFields() {
    if ($("#urole").val() =="Student")
        $("#formstudent").show();
    else
        $("#formstudent").hide();
	if ($("#urole").val() =="Teacher")
		$("#formteacher").show();
	else
		$("#formteacher").hide();
	if ($("#urole").val() =="Admin")
		$("#formadmin").show();
	else
		$("#formadmin").hide();
}
</script>

  <script src ='scripts/validatesignup.js'></script>
  <h1>Register Users</h1>
<div class ='outer'>
    <div class ='heading'>
	 <h3>Users' Registration Form</h3>
     </div>
		<div class="container">

         <form method="post" name ="signup" onSubmit="return validatesignup();" autocomplete="off">

		<div class ='row'>
		<div class ='col-6'><label>First Name</label></div>
		<div class ='col-6 columnspacer'><input type="text"  name="firstname" value ="<?php echo $firstname?>" onblur ='validatefn()'/><br/><span class ="error" id ='firstname'><?php echo $firstnameErr?></span></div>
		</div>
		<div class ='textspacer'></div>


		<div class ='row'>
		<div class ='col-6'><label>Last Name</label></div>
		<div class ='col-6 columnspacer'><input type="text" name="lastname"  value ="<?php echo $lastname?>" onblur='validateln()'/><br/><span class ="error" id ='lastname'><?php echo $lastnameErr?></span></div>
		</div>
		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-6'><label>Email Address</label></div>
		<div class ='col-6 columnspacer'>
        <input type="email" name="email" value ="<?php echo $email?>" onblur ='validateemail()'/><br/><span class ="error" id ='email'><?php echo $emailErr?></span></div>
		</div>
		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-6'><label>Confirm Email</label></div>
		<div class ='col-6 columnspacer'><input type="email" name="cemail" value ="<?php echo $cemail?>" onblur ='validatecemail()'/><br/><span class ="error" id ='cemail'><?php echo $cemailErr?></span></div>
		</div>
		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-6'><label>Password</label></div>
		<div class ='col-6 columnspacer'><input type="password" name="password" value ="<?php echo $password?>" onblur ='validatepass()' /><br/><span class ="error" id ='password'><?php echo $passwordErr?></span></div>
		</div>
		<div class ='textspacer'></div>

		<div class ='row'>
		<div class ='col-6'><label>Confirm Password</label></div>
		<div class ='col-6 columnspacer'><input type="password"  name="cpassword" value ="<?php echo $cpassword?>" onblur ='validatecpass()'/><br/><span class ="error" id ='cpassword'><?php echo $cpasswordErr?></span></div>
		</div>
		<div class ='textspacer'></div>

        <div class ='row'>
		<div class ='col-6'><label>Select Role:</label></div>
		<div class ='col-6 columnspacer'>
		   <select name ="role" id ='urole' value ="<?php echo $role;?>" onblur ='validaterole()'>
				 <option selected disabled>[choose here]</option>
	                                    <?php
	                                    $sqlparish = "SELECT * FROM role";
	                                    $stmt = $user_home->runQuery($sqlparish);
	                                    $stmt->execute();
	                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	                                        echo "<option value='" . $row['role'] . "'>" . $row['role'] . "</option>";
	                                    }
	                                    ?>
	                                </select><span class ="error" id ='role'><?php echo $roleErr?></span></div>
		</div>

		<div class ='textspacer'></div>
		 <div class ='form' id ='formstudent'>
		 <h3>Student</h3>
		 <p>to select multiple permissions click ctrl + the option(s)</p>
		 <div class ='row'>
		 <div class ='col-4'><p>Please assign role permissions to the user</p></div>
		 <div class ='col-8 columnspacer'>
		  <select name ="permissions[]" multiple = 'multiple' required = "required">
		  <option selected disabled>[Choose here]</option>
		    <?php
			    $sqlperm = "SELECT * FROM ihs_permissions WHERE permission_group = 'student'";
				$stmtperm = $user_home->runQuery($sqlperm);
				$stmtperm->execute();
				while($rowperm =$stmtperm->fetch(PDO::FETCH_ASSOC)){
					echo "<option value ='".$rowperm['permission_name']."'>".$rowperm['permission_name']."</option>";
					}
			?>
			</select>

		 </div>
		 </div>
		 </div>

		 <div class ='form' id ='formteacher'>
		 <h3>Teacher</h3>
		 <p>to select multiple permissions click ctrl + the option(s)</p>
		 <div class ='row'>
		 <div class ='col-4'><p>Please assign role permissions to the user</p></div>
		 <div class ='col-8 columnspacer'>
		  <select name ="permissions[]" multiple = 'multiple' required = "required">
		  <option selected disabled>[Choose here]</option>
		    <?php
			    $sqlperm = "SELECT * FROM ihs_permissions WHERE permission_group = 'teacher'";
				$stmtperm = $user_home->runQuery($sqlperm);
				$stmtperm->execute();
				while($rowperm =$stmtperm->fetch(PDO::FETCH_ASSOC)){
					echo "<option value ='".$rowperm['permission_name']."'>".$rowperm['permission_name']."</option>";
					}
			?>
			</select>

		 </div>
		 </div>
		 </div>

		 <div class ='form' id ='formadmin'>
		 <h3>Administrator Permissions</h3>
		 <p>to select multiple permissions click ctrl + the option(s)</p>
		 <div class ='row'>
		 <div class ='col-4'><p>Please assign role permissions to the user</p></div>
		 <div class ='col-8 columnspacer'>
		  <select name ="permissions[]" multiple = 'multiple' required ="required">
		  <option selected disabled>[Choose here]</option>
		    <?php
			    $sqlperm = "SELECT * FROM ihs_permissions WHERE permission_group = 'admin'";
				$stmtperm = $user_home->runQuery($sqlperm);
				$stmtperm->execute();
				while($rowperm =$stmtperm->fetch(PDO::FETCH_ASSOC)){
					echo "<option value ='".$rowperm['permission_name']."'>".$rowperm['permission_name']."</option>";
					}
			?>
			</select>

		 </div>
		 </div>
		 </div>


     	<div class ="spacer"></div>	<div class ="spacer"></div>	<div class ="spacer"></div>	<div class ="spacer"></div>
        <button type="submit" name="register" class="btn btn-primary btn-block" >Create</button>

      </form>
    </div>
</div>

	</div>
<?php
}
require_once 'includes/adminfooter.php';
?>
