<?php
require_once 'includes/studentinit.php';
require_once 'includes/studenthead.php';
require_once 'includes/studentnav.php';

  echo "<div class ='jumbotron'>";

  $sqlfindclient = "SELECT * FROM btps_library ORDER BY class ASC";
  $stmtfindclient = $user_home->runQuery($sqlfindclient);
  $stmtfindclient->execute();

  		echo "<table><thead><tr>";
  		echo "<th> Book Title</th>
  			  <th>Target Class</th>
  			  <th>Subject</th>
  				<th>Book</th>
  				<th>Description</th>
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
  		echo "<td>".$rowfind['booktitle']."</td>";
  		echo "<td>".$rowfind['class']."</td>";
  		echo "<td>".$rowfind['subject']."</td>";
  		if($rowfind['image'] != null){
  		echo "<td>"."<a target = '_blank' href='".$rowfind["image"]."'>". "View / Download Book"."</a></td>";
      }
  		else{
  			echo "<td>-----</td>";
  		}
  		echo "<td>".$rowfind['description']."</td>";
      echo "<td>".$rowfind['created_at']."</td>";
  		echo "<td>".$dec." ".$decl."</td></tr>";


  	}
echo "</table></div>";

require_once "includes/studentfooter.php";

?>
