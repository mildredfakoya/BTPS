<?php
include "includes/teacherheader.php";
if(!in_array("assessment", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
		$firstname =$row['firstname'];
		$lastname =$row['lastname'];
	try{
	  $sqltest = "SELECT * FROM btps_new_assessment WHERE created_by_firstname= :firstname AND created_by_lastname =:lastname";
    $stmttest = $user_home->runQuery($sqltest);
	  $stmttest->bindValue(':firstname', $firstname);
	  $stmttest->bindValue(':lastname', $lastname);
    $stmttest->execute();
?>
<div class ="container">
<h2 class ="headeranimated">Assessments created by you</h2>;
<table>
	<tr>
		<th>Record timestamp</th>
		<th>Assessment ID</th>
		<th>Assessment Type</th>
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
