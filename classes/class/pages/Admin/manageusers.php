<?php
require_once 'includes/adminheader.php';
if(!in_array("users_account", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{

?>
<div class ="jumbotron">
		<h1>Manage Exisiting Users</h1>
		<div class ="outer">
        <div class ="heading">
		<h3>Edit User</h3>
		</div>
		<div class ='container'>
        <form method="post">

		<label>Please enter the email address of the user you wish to edit/view</label>
        <input type="email" placeholder="Email address" name="email" autofocus/>

        <button type="submit" name="submit" class ='btnblk'>Get User</button>

      </form>

	 <div class ='spacer'></div>

   <?php


if(isset($_POST['submit'])){
	$name =!empty($_POST['email']) ? $helper->test_input($_POST['email']) : null;

	if($name==NULL||$name==''){

    $user_home->redirect('failure.php?noemail');

	}

	else{


try{

	$encname= new AES($name, $inputkey, $blocksize);
	$namen = $encname->encrypt();
	$encname->setData($namen);
	echo "<div class ='outer'>";
	echo "<div class ='heading'><h3>Search result</h3></div>";
	echo "<div class ='container'>";
	echo '</div><div id="wrapper">';

	echo '<div id="tabContainer">';
	echo '<div id="tabs">';


	echo '<ul>';

 echo '<li id="tabHeader_1">Manage User</li>';
 echo '<li id="tabHeader_2">View User </li>';
 echo '<li id="tabHeader_3">Set / Edit Permissions</li>';

 echo '</ul>';
 echo '</div>';
 echo '<div id="tabscontent">';
  $sql = "SELECT * FROM ihs_users WHERE email ='$namen'";
  $stmt = $user_home->runQuery3($sql);
	if(!$stmt){


	$user_home->redirect('failure.php?noaddress');


    }
	else{

   $sql2 = "SELECT * FROM ihs_users WHERE email =:email";
   $stmt2 =$user_home->runQuery($sql2);
   $stmt2->bindValue(':email',$namen);
   $stmt2->execute();
   $row2= $stmt2->fetch(PDO::FETCH_ASSOC);

   $emailn = new AES($namen, $inputkey, $blocksize);
   $email=$emailn->decrypt();


   $firstnamen =$row2['firstname'];
   $firstn = new AES($firstnamen, $inputkey, $blocksize);
   $dec=$firstn->decrypt();

   $lastnamen =$row2['lastname'];
   $lastn = new AES($lastnamen, $inputkey, $blocksize);
   $decl=$lastn->decrypt();

   $emailn =$row2['email'];
   $mailn = new AES($emailn, $inputkey, $blocksize);
   $decemail=$mailn->decrypt();
   $userStatus = $row2['userStatus'];
	?>

 <nav class="tabpage" id="tabpage_1">
 <script src ='scripts/validateupdateusers.js'></script>

	<form method ='post' name ='signup' onSubmit="return validatesignup();" autocomplete="off" >
	<div class ='row'>
	<div class ='col-2'>First Name</div>
	<div class ='col-2 columnspacer'>Last Name</div>
	<div class ='col-3 columnspacer'>Email</div>
	<div class ='col-3 columnspacer'>Role</div>
	<div class ='col-2 columnspacer'>Activation Status</div>
	</div><div class ='textspacer'></div>

	<div class ='row'>

    <div class ='col-2'><input type ='text' name ='firstname' value ="<?php echo $dec?>" ><span class ='error' id ='firstname'></span></div>
	<div class ='col-2 columnspacer'><input type ='text' name ='lastname' value ="<?php echo $decl?>" ><span class ='error' id ='lastname'></span></div>
	<div class ='col-3 columnspacer effect'><label><?php echo $decemail?></label></div>
	<div class ='col-3 columnspacer'>
	 <select name ='role' value ="<?php echo $name;?>">
		 <option selected value ="<?php echo $row2['role']?>"><?php echo $row2['role']?></option>
																	<?php
																	$sqlrole = "SELECT * FROM role";
																	$stmt = $user_home->runQuery($sqlrole);
																	$stmt->execute();
																	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
																			echo "<option value='" . $row['role'] . "'>" . $row['role'] . "</option>";
																	}
																	?>
															</select><span class ='error' id ='role'></span>
	</div>
	<div class ='col-2 columnspacer'>
	 <select name ='userStatus' value ="<?php echo $userStatus;?>">
		   <option selected value ='' >[choose here]</option>
           <option value ='Y' <?php if($row2['userStatus']=='Y') echo 'selected'?>>Activated</option>
           <option value='N' <?php if($row2['userStatus']=='N') echo 'selected'?>>Not Activated</option>


          </select><span class ='error' id ='userStatus'></span>
	</div>

	</div>
	<input type ='hidden' name ='hidden' value ="<?php echo $row2['email']?>">
	<input type ='submit' name ='updateusers' value ='Update'>
	<input type ='submit' name ='delete' value ='Delete'>
	<br><br>
	</form>
	<?php
}
?>

      </nav>
      <nav class="tabpage" id="tabpage_2">

	 <?php


   $sql2 = "SELECT * FROM ihs_users WHERE email =:email";
   $stmt2 =$user_home->runQuery($sql2);
   $stmt2->bindValue(':email',$namen);
   $stmt2->execute();
   $row2= $stmt2->fetch(PDO::FETCH_ASSOC);



   $emailn = new AES($namen, $inputkey, $blocksize);
   $email=$emailn->decrypt();


   $firstnamen =$row2['firstname'];
   $firstn = new AES($firstnamen, $inputkey, $blocksize);
   $dec=$firstn->decrypt();

   $lastnamen =$row2['lastname'];
   $lastn = new AES($lastnamen, $inputkey, $blocksize);
   $decl=$lastn->decrypt();



	echo "<div class ='row'>";
	echo "<div class ='col-2 effect'>First Name</div>";
	echo "<div class ='col-2 columnspacer effect'>Last Name</div>";
	echo "<div class ='col-2 columnspacer effect'>Email</div>";
	echo "<div class ='col-2 columnspacer effect'>Role</div>";
	echo "<div class ='col-2 columnspacer effect'>Status</div>";
	echo "<div class ='col-2 columnspacer effect'>Last seen</div>";
	echo "</div><div class ='textspacer'></div>";


	echo "<div class ='row'>";
	echo "<div class ='col-2 effect'>" .$dec."</div>";
	echo "<div class ='col-2 columnspacer effect'>". $decl."</div>";
	echo "<div class ='col-2 columnspacer effect'>". $email."</div>";
	echo "<div class ='col-2 columnspacer effect'>". $row2['role']."</div>";
	echo "<div class ='col-2 columnspacer effect'>". $row2['userStatus']."</div>";
	echo "<div class ='col-2 columnspacer effect'>". $row2['last_logged_in']."</div>";
	echo "</div>";



    echo '</nav>';




   $sqlset = "SELECT * FROM ihs_user_permissions WHERE email =:email";
   $stmtset =$user_home->runQuery($sqlset);
   $stmtset->bindValue(':email',$namen);
   $stmtset->execute();
   $rowset= $stmtset->fetch(PDO::FETCH_ASSOC);


   $emailn = new AES($namen, $inputkey, $blocksize);
   $email=$emailn->decrypt();
   if($stmtset){
		 $role = $row2['role'];
	?>

 <nav class="tabpage" id="tabpage_3">


	<form method ='post' id ='setpermissions' novalidate ='novalidate' >
	<div class ='row'>
	<div class ='col-6'>Email</div>
	<div class ='col-6 columnspacer'>Permissions</div>


	</div><div class ='textspacer'></div>

	<div class ='row'>
    <div class ='col-6 '><label><input type ='text' name ='email' value = '<?php echo $email;?>' class ='borderless'/></label></div>
	<div class ='col-6 columnspacer'>
	<p>to select multiple permissions click ctrl + the option(s)</p>
		 <div class ='row'>
		 <div class ='col-4'><p>Please assign role permissions to the user</p></div>
		 <div class ='col-8 columnspacer'>
		<label>Existing Permissions: <span class ='previous'><?php echo $rowset['permissions'] ?></span></label>
		  <select name ="permissions[]" multiple = 'multiple'>
		  <option selected value ='<?php echo $rowset['permissions']?>'>[Choose Here]</option>
		    <?php
			    $sqlperm = "SELECT * FROM ihs_permissions WHERE permission_group = '$role'";
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
	</div>


	<input type ='hidden' name ='hidden' value ="<?php echo $row2['email']?>" />
	<button type ='submit' name ='updateperm'>Reset permission(s)</button>
	<button type ='submit' name ='deleteperm'>Delete permission(s)</button>


	<br><br>
	</form>


      </nav>


	<?php
  }
}
catch(PDOException $ex){
die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

}


}
}
// to edit user's registration
if (isset($_POST['updateusers'])){
	$firstn = !empty($_POST['firstname']) ? $helper->test_input($_POST['firstname']) : null;
	$lastn = !empty($_POST['lastname']) ? $helper->test_input($_POST['lastname']) : null;

	$encfn= new AES($firstn, $inputkey, $blocksize);
	$firstname = $encfn->encrypt();
	$encfn->setData($firstname);

	$encln= new AES($lastn, $inputkey, $blocksize);
	$lastname = $encln->encrypt();
	$encln->setData($lastname);
	$role = !empty($_POST['role']) ? $helper->test_input($_POST['role']) : null;
	$userStatus = !empty($_POST['userStatus']) ? ($_POST['userStatus']) : null;
    $permissions ='';
	try{

	 $sql2 = "UPDATE ihs_users SET firstname ='$firstname', lastname ='$lastname',  role ='$role', userStatus = '$userStatus' WHERE email ='$_POST[hidden]'";
	 $result2 =$user_home->runQuery4($sql2);
     if($role ==='idc'){
		$sqlk="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
	    $stmtk = $user_home->runQuery($sqlk);
	    $stmtk->bindValue(':email', $_POST['hidden']);
	    $stmtk->execute();
	    $rowk = $stmtk->fetch(PDO::FETCH_ASSOC);

	if($stmtk->rowCount() > 0)
	{

          echo  "<div class='alert alert-info'>
				<strong>user already has permissions set. Please review permissions.</strong>
		</div>" ;

	}
	else{
		 $sqlset = "INSERT INTO ihs_user_permissions(email, permissions)VALUES(:emailn, :permissions)";
         $stmtset = $user_home->runQuery($sqlset);
		 $stmtset->bindValue(':emailn' ,$_POST['hidden']);
		 $stmtset->bindValue(':permissions', $permissions);
		 $resultset = $stmtset->execute();
		}
	 }

	else{
		$sqlk="SELECT * FROM ihs_user_permissions WHERE email= :email" ;
	    $stmtk = $user_home->runQuery($sqlk);
	    $stmtk->bindValue(':email', $_POST['hidden']);
	    $stmtk->execute();
	    $rowk = $stmtk->fetch(PDO::FETCH_ASSOC);
		if($stmtk->rowCount() > 0)
	{

     $sql3= "DELETE FROM ihs_user_permissions WHERE email ='$_POST[hidden]'";
	 $result3= $user_home->runQuery2($sql3);

	}

	}


	if ($result2||$resultset){
        echo "<div class='alert alert-success'>
						<strong>SUCCESS! user's information has been updated successfully</strong>
			  		</div>";
					header('refresh:5; manageusers.php');
	}
	else{
    echo "<div class='alert alert-danger'>
						<strong>FAILURE! Could not update user's information. Please try again later</strong>
			  		</div>";
	}

	}


catch(PDOException $e)
    {
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR.');

    }


}
//to delete user
if (isset($_POST['delete'])){

try{

	 $sql3= "DELETE FROM ihs_users WHERE email ='$_POST[hidden]'";
	 $result3= $user_home->runQuery2($sql3);

	 $sql4= "DELETE FROM ihs_user_permissions WHERE email ='$_POST[hidden]'";
	 $result4= $user_home->runQuery2($sql4);

	if ($result3||$result4){
        echo "<div class='alert alert-success'>
						<strong>SUCCESS! user's information has been deleted</strong>
			  		</div>";
					header('refresh:5; manageusers.php');
	}
	else{
    echo "<div class='alert alert-danger'>
						<strong>FAILURE! Could not delete user's information. Please try again later</strong>
			  		</div>";
	}


    }
catch(PDOException $e)
    {
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

    }


		}
//to delete permissions
if (isset($_POST['deleteperm'])){

try{

	 $sql3= "UPDATE ihs_user_permissions SET permissions = '' WHERE email ='$_POST[hidden]' ";
	 $result3= $user_home->runQuery2($sql3);



	if ($result3){
        echo "<div class='alert alert-success'>
						<strong>SUCCESS! user's permissions has been deleted</strong>
			  		</div>";
					header('refresh:5; manageusers.php');
	}
	else{
    echo "<div class='alert alert-danger'>
						<strong>FAILURE! Could not delete user's information. Please try again later</strong>
			  		</div>";
	}


    }
catch(PDOException $e)
    {
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

    }


		}
// for permissions reset
if (isset($_POST['updateperm'])){

try{
		if(isset($_REQUEST['permissions'])){
	$regimen2 = $_REQUEST['permissions'];
	$permissions ="";
    //$secondline as an array now
	foreach ($regimen2 as $selected2) {
	$permissions = $permissions . " ". $selected2;
	}
	}
		$sql3= "DELETE FROM ihs_user_permissions WHERE email ='$_POST[hidden]'";
	    $result3= $user_home->runQuery2($sql3);

	 $sqlset = "INSERT INTO ihs_user_permissions(email, permissions)VALUES(:emailn, :permissions)";
         $stmtset = $user_home->runQuery($sqlset);
		 $stmtset->bindValue(':emailn' ,$_POST['hidden']);
		 $stmtset->bindValue(':permissions', $permissions);
		 $resultset = $stmtset->execute();


	if ($result3||$resultset){
        echo "<div class='alert alert-success'>
						<strong>SUCCESS! user's permissions has been reset</strong>
			  		</div>";
					header('refresh:5; manageusers.php');
	}
	else{
    echo "<div class='alert alert-danger'>
						<strong>FAILURE! Could not reset user's information. Please try again later</strong>
			  		</div>";
	}


    }
catch(PDOException $e)
    {
		die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

    }


		}
echo "</div>
</div>";
?>
</div>
</div>
</div>
</div>
</div>


<?php
}
require_once 'includes/adminfooter.php';

?>
