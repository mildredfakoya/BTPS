<?php
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;

echo "<div class ='jumbotron'>";
$sqlfindclient = "SELECT * FROM ihs_video_uploads ORDER BY created_at DESC";
$stmtfindclient = $user_home->runQuery($sqlfindclient);
$stmtfindclient->execute();
$firstname =$row['firstname'];
$lastname =$row['lastname'];
$firstn =new AES($firstname, $inputkey, $blocksize);
$dec =$firstn->decrypt();
$lastn =new AES($lastname, $inputkey, $blocksize);
$decl =$lastn->decrypt();
		echo "<table><thead><tr>";
		echo "<th>Title</th>
			  <th>Grade</th>
			  <th>Subject</th>
		    <th>File / Video name</th>
				<th>Comments / Notes</th>
				<th>Date uploaded</th>
				<th>Uploaded by</th>

		</tr>";
		foreach($stmtfindclient as $row)
	{
		echo "<tr>";
		echo "<td>".$row['title']."</td>";
		echo "<td>".$row['grade']."</td>";
		echo "<td>".$row['subject']."</td>";
		if($row['image'] != null){
		echo "<td>"."<a target = '_blank' href='".$row["image"]."'>". "Play / View file"."</a></td>";
    }
		else{
			echo "<td>-----</td>";
		}
		echo "<td>".$row['report']."</td>";
    echo "<td>".$row['created_at']."</td>";
		echo "<td>".$dec." ".$decl."</td></tr>";


	}
echo "</table></div>";
require_once 'includes/teacherfooter.php';
?>
