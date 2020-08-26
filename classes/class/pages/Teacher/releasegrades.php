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
echo "<h5 class ='header'>Click on the button that holds the assessment ID to release student's grades and feedback</h5>";

#for Pre K grading
if(in_array("pre_k_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Pre - K Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_pre_k";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentprek.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='prekass' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_pre_k";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousprek.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='prekcont' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_pre_k";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexampk.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='prekexam' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";
 //for grade k grading
 if(in_array("grade_k_teacher", $permissions)){
   echo "<div class ='container'>";
   echo "<h5>Grade- K Assessments</h5>";
   $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_k";
   $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
   $stmtgradeassignment->execute();
   foreach($stmtgradeassignment as $rowassignment){

     echo "<form method ='post' action = 'allowassignmentgradek.php'>";
     echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
     echo "<input type = 'submit' name ='kass' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
     echo "</form>";
     echo "<div class ='spacer'></div>";
   }

   $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_k";
   $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
   $stmtgradecontinous->execute();
   foreach($stmtgradecontinous as $rowcontinous){

     echo "<form method ='post' action = 'allowcontinousgradek.php'>";
     echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
     echo "<input type = 'submit' name ='kcont' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
     echo "</form>";
     echo "<div class ='spacer'></div>";
   }


   $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_k";
   $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
   $stmtgradeexam->execute();
   foreach($stmtgradeexam as $rowexam){

     echo "<form method ='post' action = 'allowexamgradek.php'>";
     echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
     echo "<input type = 'submit' name ='kexam' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
     echo "</form>";
     echo "<div class ='spacer'></div>";
   }
 }
 echo "</div><div class ='spacer'></div>";

// grade 1 gradeing

if(in_array("grade_1_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 1 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_1";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade1.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass1' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_1";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade1.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont1' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_1";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade1.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam1' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";

//grade 2 grading

if(in_array("grade_2_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 2 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_2";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade2.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass2' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_2";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade2.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont2' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_2";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade2.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam2' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";

//grade 3 grading

if(in_array("grade_3_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 3 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_3";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade3.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass3' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_3";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade3.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont3' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_3";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade3.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam3' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";

//grade 4 grading

if(in_array("grade_4_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 4 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_4";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade4.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass4' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_4";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade4.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont4' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_4";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade4.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam4' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";


//grade 5 grading

if(in_array("grade_5_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 5 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_5";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade5.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass5' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_5";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade5.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont5' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_5";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade5.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam5' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";

// Grade 6 Assessments

if(in_array("grade_6_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 6 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_6";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade6.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass6' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_6";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade6.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont6' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_6";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade6.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam6' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";


// Grade 7 gradings

if(in_array("grade_7_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 7 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_7";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade7.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass7' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_7";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade7.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont7' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_7";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade7.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam7' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";


if(in_array("grade_8_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 8 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_8";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade8.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass8' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_8";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade8.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont8' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_8";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade8.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam8' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";

// Grade 9 gradings
if(in_array("grade_9_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 9 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_9";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade9.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass9' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_9";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade9.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont9' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_9";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade9.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam9' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";

// Grade 10 gradings

if(in_array("grade_10_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 10 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_10";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade10.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass10' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_10";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade10.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont10' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_10";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade10.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam10' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";

// Grade 11 gradings

if(in_array("grade_11_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Grade 11 Assessments</h5>";
  $sqlgradeassignment= "SELECT DISTINCT assessment_id FROM btps_student_assignment_grade_11";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'allowassignmentgrade11.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass11' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT DISTINCT assessment_id FROM btps_student_continous_grade_11";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'allowcontinousgrade11.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont11' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT DISTINCT assessment_id FROM btps_student_exam_grade_11";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'allowexamgrade11.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowexam['assessment_id']."'>";
    echo "<input type = 'submit' name ='exam11' class = 'btn btn-success' value ='".$rowexam['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }
}
echo "</div><div class ='spacer'></div>";

?>

<?php
echo "</div>";
require_once "includes/teacherfooter.php";
}
?>
