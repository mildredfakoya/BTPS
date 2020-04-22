<?php
require 'header.php';
$user_helper = new USER();

echo "<div class ='jumbotron'>";
$sql= "SELECT * FROM  training_videos";
$stmt = $user_helper->runQuery($sql);
$stmt->execute();
		echo "<table><thead><tr>";
		echo "<th>Video code</th>
		    <th>Video Part</th>
				<th>Lesson No.</th>
			  <th>Video Title</th>
			  <th>Role Applicable</th>
		    <th>Permission Needed</th>
				<th>Watch</th>

		</tr>";
		foreach($stmt as $row)
	{
		echo "<tr>";
		echo "<td>".$row['video_code']."</td>";
		echo "<td>".$row['video_part']."</td>";
		echo "<td>".$row['lesson_number']."</td>";
		echo "<td>".$row['video_title']."</td>";
		echo "<td>".$row['lesson_role']."</td>";
		echo "<td>".$row['lesson_permission']."</td>";
		echo "<td><a href ='>".$row['lesson_link']."' target = '_blank'>".$row['video_title']."</a></td>";

	}
echo "</table></div>";
?>
</body>
</html>
