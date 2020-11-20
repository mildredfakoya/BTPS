<?php
include "includes/teacherheader.php";
if(!in_array("assessment", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
	$sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
  $stmtcurrent = $user_home->runQuery($sqlcurrent);
  $stmtcurrent->execute();
  $rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);
		$firstname =$row['firstname'];
		$lastname =$row['lastname'];
	try{
	  $sqltest = "SELECT * FROM btps_new_assessment WHERE created_by_firstname= :firstname AND created_by_lastname =:lastname AND term = :term AND academic_year = :academicyear";
    $stmttest = $user_home->runQuery($sqltest);
	  $stmttest->bindValue(':firstname', $firstname);
	  $stmttest->bindValue(':lastname', $lastname);
		$stmttest->bindValue(':term', $rowcurrent['current_term']);
		$stmttest->bindValue(':academicyear', $rowcurrent['academic_year']);
    $stmttest->execute();
?>
<div class ="container">
	<p> To create assessment questions or view already created assessment question click <a href = "getassessment.php"> here </a></p>
<h2 class ="headeranimated">Assessments created by you</h2>
<table>
	<tr>
		<th>Record timestamp</th>
		<th>Assessment ID</th>
		<th>Assessment Type</th>
		<th>Term</th>
		<th>Academic Year</th>
		<th>Target Grade</th>
		<th>Subject</th>
		<th>Access Password</th>
	</tr>
 <?php
 foreach($stmttest as $rowtest){
 echo "<tr>";
 echo "<td>".$rowtest['created_at']."</td>";
 echo "<td style ='background-color:red; color :white'>".$rowtest['assessment_id']."</td>";
 echo "<td>".$rowtest['assessment_type']."</td>";
 echo "<td>".$rowtest['term']."</td>";
 echo "<td>".$rowtest['academic_year']."</td>";
 echo "<td>".$rowtest['target_class']."</td>";
 echo "<td>".$rowtest['subject']."</td>";
 echo "<td style ='background-color:green; color :white; font-sytle :bold'>".$rowtest['access_code']."</td>";
 echo "</tr>";


	 }
echo "</table></div>";
}
catch(PDOException $e)
    {
    die('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');
    }
	}
?>
