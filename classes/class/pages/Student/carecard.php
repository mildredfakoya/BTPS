<?php
require_once "includes/testingheader.php";
$firstnameErr=$lastnameErr="";
$firstname=$lastname="";
$inputkey = "marketdayanyigba";
$blocksize = 256;
if(!in_array("pharmacy", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>

<div class='jumbotron'>
<div class='outer'>
<div class ='heading'>
<h3>Clinical Encounters</h3>
</div>
<div class ="container">
<div class ="row">
<form method='post'>
<div class ='col-5'>Please Enter Client's Unique ID. To retrieve clients' last encounter</div>
<div class ='col-7 columnspacer'><input type ='password' name ='uniqueid'/>
<button class ='btnblk' type ='submit' name ='submit' >Previous Encounter</button>

</div>
</div>
</form>
</div>

<?php
if(isset ($_POST['submit'])){


$uniqueid =!empty($_POST['uniqueid']) ? $helper->test_input($_POST['uniqueid']) : null;
	if($uniqueid==NULL){
	$user_home->redirect('failure.php?pharmeid');
	}

 else{


  try{
	$sqla = "SELECT * FROM ihs_referal_archive WHERE unique_id= :uniqueid";
  $stmta = $user_home->runQuery($sqla);

    //Bind the provided username to our prepared statement.
	$stmta->bindValue(':uniqueid', $uniqueid);

    //Execute.
	$stmta->execute();

    //Fetch the row.
   $rowa = $stmta->fetch(PDO::FETCH_ASSOC);
	 $category = $rowa['category'];

if(!$rowa){
    $user_home->redirect('failure.php?pharmnid');
	}
else{
		if($category == 'adult'||$category =='pregnant'){
?>
<div id="wrapper2">
<div id="tabContainer">
<div id="tabs">

<ul>
		<li id="tabHeader_1">ART CARE CARD</li>
</ul>
</div>
<div id="tabscontent">

<nav class="tabpage" id="tabpage_1">

<?php
$sqle = "SELECT * FROM ihs_adultartcarecard WHERE unique_id= :uniqueid ORDER BY date_created DESC";
$stmte = $user_home->runQuery($sqle);

//Bind the provided username to our prepared statement.
$stmte->bindValue(':uniqueid', $uniqueid);
//Execute.
$stmte->execute();

foreach($stmte as $rowe){
	?>


<div class ='jumbotron'>
<div class ='row'>
<div class ='col-3 color2'><label><?php echo $rowe['date_created'];?></label></div>
<div class ='col-9 columnspacer'>

<div class ='row'>
<div class ='col-5'>Existing Medical Conditions / Medications for Conditions</div>
<div class ='col-7 columnspacer'><?php echo $rowe['medicalconditions']."---".$rowe['medications'];?></div>
</div>
<div class ='textspacer'></div>
<div class ='row'>
<div class ='col-5'>New Opportunistic Infections or other problems</div>
<div class ='col-7 columnspacer'><?php echo $rowe['oia']."---".$rowe['oib']."---".$rowe['oic']."---".$rowe['oid']."---".$rowe['oie']."---".$rowe['oif']."---".$rowe['oig']."---".$rowe['oih']."---".$rowe['oii']."---".$rowe['oij']."---".$rowe['oik']."---".$rowe['oil']."---".$rowe['oim']."---".$rowe['oin']."---".$rowe['oio']."---".$rowe['oiother'];?></div>
</div>
<div class ='textspacer'></div>
<div class ='row'>
<div class ='col-5'>Pregnant?</div>
<div class ='col-7 columnspacer'><?php echo $rowe['pregnant'];?></div>
</div>
<div class ='textspacer'></div>

<div class ='row'>
<div class ='col-5'>Cotrimoxazole Prophylaxis</div>
<div class ='col-7 columnspacer'><?php echo $rowe['cotriprophy'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>First Line ARV Regimen</div>
<div class ='col-7 columnspacer'><?php echo $rowe['firstline'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>Second Line ARV Regimen</div>
<div class ='col-7 columnspacer'><?php echo $rowe['secondline'];?></div>
</div>
<div class ='textspacer'></div>



<div class ='row'>
<div class ='col-5'>Other ARV Regimen</div>
<div class ='col-7 columnspacer'><?php echo $rowe['arvregimenother'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>Reason for Change or Stop</div>
<div class ='col-7 columnspacer'><?php echo $rowe['changeorstop'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>Hemoglobin</div>
<div class ='col-7 columnspacer'><?php echo $rowe['hemoglobin'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>ALT</div>
<div class ='col-7 columnspacer'><?php echo $rowe['alt'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>Family Planning</div>
<div class ='col-7 columnspacer'><?php echo $rowe['famplan'];?></div>
</div>
<div class ='textspacer'></div>

<div class ='row'>
<div class ='col-5'>Patients' disposition</div>
<div class ='col-7 columnspacer'><?php echo $rowe['withdraw'];?></div>
</div>
<div class ='textspacer'></div>

</div></div></div>
<div class ='spacer'></div>
<?php
	}
echo "</nav>";

	}
		else{
		?>
		<div id="wrapper2">
		<div id="tabContainer">
		<div id="tabs">

        <ul>


		<li id="tabHeader_1">ART CARE CARD</li>

       </ul>
       </div>
	   <div id="tabscontent">


<nav class="tabpage" id="tabpage_1">
		<?php

	$sqle = "SELECT * FROM ihs_pediatricacc WHERE unique_id= :uniqueid ORDER BY date_created DESC";
    $stmte = $user_home->runQuery($sqle);

    //Bind the provided username to our prepared statement.
	 $stmte->bindValue(':uniqueid', $uniqueid);

    //Execute.
	 $stmte->execute();
    foreach($stmte as $rowe){
	?>


<div class ='container'>
<div class ='row'>
<div class ='col-3 color2'><label><?php echo $rowe['date_created'];?></label></div>
<div class ='col-9 columnspacer'>

<div class ='row'>
<div class ='col-5'>Nutrition</div>
<div class ='col-7 columnspacer'><?php echo $rowe['nutrition']." ".$rowe['othersupplement'];?></div>
</div>
<div class ='textspacer'></div>

<div class ='row'>
<div class ='col-5'>Developmental Status</div>
<div class ='col-7 columnspacer'><?php echo $rowe['devstatus'];?></div>
</div>
<div class ='textspacer'></div>
<div class ='row'>
<div class ='col-5'>New Opportunistic Infections at this visit</div>
<div class ='col-7 columnspacer'><?php echo $rowe['oi1']."---".$rowe['oi2']."---".$rowe['oi3']."---".$rowe['oi4']."---".$rowe['oi5']."---".$rowe['oi6']."---".$rowe['oi7']."---".$rowe['oi8']."---".$rowe['oi9']."---".$rowe['oi10']."---".$rowe['oi11']."---".$rowe['oi12']."---".$rowe['oi13']."---".$rowe['oi14']."---".$rowe['oi15']."---".$rowe['oi16']."---".$rowe['oiother'];?></div>
</div>
<div class ='textspacer'></div>
<div class ='row'>
<div class ='col-5'>Started ARV?</div>
<div class ='col-7 columnspacer'><?php echo $rowe['startarv'];?></div>
</div>
<div class ='textspacer'></div>

<div class ='row'>
<div class ='col-5'>First Line ARV Regimen</div>
<div class ='col-7 columnspacer'><?php echo $rowe['firstline'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>Second Line ARV Regimen</div>
<div class ='col-7 columnspacer'><?php echo $rowe['secondline'];?></div>
</div>
<div class ='textspacer'></div>



<div class ='row'>
<div class ='col-5'>Other ARV Regimen</div>
<div class ='col-7 columnspacer'><?php echo $rowe['regimenothers'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>Reason for Change or Stop</div>
<div class ='col-7 columnspacer'><?php echo $rowe['changeorstop'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>Hemoglobin</div>
<div class ='col-7 columnspacer'><?php echo $rowe['hemoglobin'];?></div>
</div>
<div class ='textspacer'></div>


<div class ='row'>
<div class ='col-5'>ALT</div>
<div class ='col-7 columnspacer'><?php echo $rowe['alt'];?></div>
</div>
<div class ='textspacer'></div>


</div></div></div>
<div class ='spacer'></div>
<?php
	}
echo "</nav>";


	}


	echo "</div>";


	}

}

catch(PDOException $e)
    {
		die('SYSTEM FAILURE! PLEASE CONTACT YOUR ADMINISTRATOR FOR SUPPORT');
    }
 }

}
}
require_once 'includes/testingfooter.php';



?>
