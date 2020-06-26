<?php
require_once "includes/teacherheader.php";
$email = $row['email'];
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


echo "<div class ='jumbotron'>";

if(in_array("pre_k_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'pre_k'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctorpk.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}

if(in_array("grade_k_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_k'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctork.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}



if(in_array("grade_1_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_1'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor1.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}


if(in_array("grade_2_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_2'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor2.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}



if(in_array("grade_3_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_3'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor3.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}



if(in_array("grade_4_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_4'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor4.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}




if(in_array("grade_5_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_5'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor5.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}




if(in_array("grade_6_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_6'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor6.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}




if(in_array("grade_7_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_7'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor7.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}



if(in_array("grade_8_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_8'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor8.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}




if(in_array("grade_9_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_9'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor9.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}



if(in_array("grade_10_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_10'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor10.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}





if(in_array("grade_11_teacher", $permissions)){
  $sqlreview= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_11'";
  $stmtreview = $user_home->runQuery($sqlreview);
  $stmtreview->execute();
  foreach($stmtreview as $rowreview){
    echo "<div class ='container'>";
    echo "<form method ='post' action = 'viewproctor11.php'>";
      echo "<input type ='hidden' name ='hiddentype' value ='".$rowreview['assessment_type']."'>";
    echo "<input type ='hidden' name ='hiddenclass' value ='".$rowreview['target_class']."'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowreview['assessment_id']."'>";
    echo "Click the button for ". $rowreview['target_class']."--". strtoupper($rowreview['assessment_type'])." <button type = 'submit' name ='item' class = 'btn btn-info'>".$rowreview['assessment_id']."</button>";
    echo "</form>";
    echo "</div><div class ='spacer'></div>";
  }
}

?>

<?php
echo "</div>";
require_once "includes/teacherfooter.php";
}
?>
