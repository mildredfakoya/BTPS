<?php
require_once 'includes/teacherheader.php';
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
if(!in_array("assessment", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
	$sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
  $stmtcurrent = $user_home->runQuery($sqlcurrent);
  $stmtcurrent->execute();
  $rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);
?>
		<div class ='jumbotron'>
    <h5 class = 'header'>View all class topics</h5>
		<?php
		try{
		$sql ="SELECT * FROM btps_topics WHERE term = :term AND academic_year = :academicyear ORDER BY grade, subject ";
		$stmt = $user_home->runQuery($sql);
		$stmt->bindValue(':term', $rowcurrent['current_term']);
		$stmt->bindValue(':academicyear', $rowcurrent['academic_year']);
		$stmt->execute();
		?>


<table>
	<thead>
		<tr>
			<th>S/NO</th>
			<th>CREATED AT</th>
			<th>TOPICS COVERED</th>
			<th>GRADE</th>
			<th>SUBJECT</th>
			<th>NOTES</th>
		</tr>
	</thead>


<?php
$counter = 0;
foreach($stmt as $row1){
$counter++;
echo "<tbody><tr>";
echo "<td>".$counter."</td>";
echo "<td>".$row1['created_at']."</td>";
echo "<td>".$row1['topics_covered']."</td>";
echo "<td>".$row1['grade']."</td>";
echo "<td>".$row1['subject']."</td>";
echo "<td>".htmlspecialchars_decode($row1['notes'])."</td>";
echo "</tbody></tr>";

}
echo "</table>";
}
		catch(PDOException $e)
		{
		DIE('SYSTEM FAILURE!! PLEASE CONTACT YOUR ADMINISTRATOR');

		}
		?>

		</div>
<?php }
require_once 'includes/teacherfooter.php';?>
