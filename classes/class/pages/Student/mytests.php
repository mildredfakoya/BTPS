<?php
include "includes/testingheader.php";
if(!in_array("general_population_screenings", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>

<?php
		$firstname =$row['firstname'];
		$lastname =$row['lastname'];
	try{
	  $sqltest = "SELECT * FROM ihs_screenings WHERE created_by_firstname= :firstname AND created_by_lastname =:lastname";
    $stmttest = $user_home->runQuery($sqltest);
	  $stmttest->bindValue(':firstname', $firstname);
	  $stmttest->bindValue(':lastname', $lastname);
    $stmttest->execute();

 echo "<div class ='container'>";
 echo "<div class ='jumbotron'>";
  echo "<h2>Screenings conducted / viewed / edited by you</h2>";
 echo "<div class ='row'>";
 echo "<div class ='col-4'><label><strong>Record timestamp</strong></label></div>";
 echo "<div class ='col-4 columnspacer'><label><strong>Unique ID</strong></label></div>";
 echo "<div class ='col-4 columnspacer'><label><strong>Address of site</strong></label></div>";
 echo "</div><div class ='textspacer'></div>";
 foreach($stmttest as $rowtest){
  echo "<div class ='row'>";
 echo "<div class ='col-4'>".$rowtest['date_created']."</div>";
 echo "<div class ='col-4 columnspacer'>".$rowtest['unique_id']."</div>";
 echo "<div class ='col-4 columnspacer'>".$rowtest['address_of_site']."</div>";
 echo "</div>";


	 }
echo "</div></div>";
}
catch(PDOException $e)
    {
    die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
    }
	}
?>
