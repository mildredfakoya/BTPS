<?php
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;

echo "<div class ='jumbotron'>";
$sqlfindclient = "SELECT * FROM ihs_video_uploads ORDER BY created_at DESC";
$stmtfindclient = $user_home->runQuery($sqlfindclient);
$stmtfindclient->execute();

		echo "<table><thead><tr>";
		echo "<th>Title</th>
			  <th>Grade</th>
			  <th>Subject</th>
		    <th>File / Video name</th>
				<th>Comments / Notes</th>
				<th>Date uploaded</th>
				<th>Uploaded by</th>

		</tr>";
		foreach($stmtfindclient as $rowfind){
		$firstname =$rowfind['created_by_firstname'];
		$lastname =$rowfind['created_by_lastname'];
		$firstn =new AES($firstname, $inputkey, $blocksize);
		$dec =$firstn->decrypt();
		$lastn =new AES($lastname, $inputkey, $blocksize);
		$decl =$lastn->decrypt();

		echo "<tr>";
		echo "<td>".$rowfind['title']."</td>";
		echo "<td>".$rowfind['grade']."</td>";
		echo "<td>".$rowfind['subject']."</td>";
		if($rowfind['image'] != null){
		echo "<td>"."<a target = '_blank' href='".$rowfind["image"]."'>". "Play / View file"."</a></td>";
    }
		else{
			echo "<td>-----</td>";
		}
		echo "<td>".$rowfind['report']."</td>";
    echo "<td>".$rowfind['created_at']."</td>";
		echo "<td>".$dec." ".$decl."</td></tr>";


	}
echo "</table></div>";
?>
