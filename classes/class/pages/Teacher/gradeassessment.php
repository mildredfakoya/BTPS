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
  $sqlcurrent="SELECT * FROM btps_reset_term ORDER BY created_at DESC LIMIT 1" ;
  $stmtcurrent = $user_home->runQuery($sqlcurrent);
  $stmtcurrent->execute();
  $rowcurrent = $stmtcurrent->fetch(PDO::FETCH_ASSOC);

echo "<div class ='jumbotron'>";
echo "<h5 class ='header'>Click on the button that holds the assessment ID to grade the assessment</h5>";

#for Pre K grading

if(in_array("pre_k_teacher", $permissions)){
  echo "<div class ='container'>";
  echo "<h5>Pre - K Assessments</h5>";
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'pre_k' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignmentpk.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='prekass' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'pre_k'  AND term =:term AND academic_year = :year AND assessment_type ='continous_assessment'";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinouspk.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='prekcont' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'pre_k' AND assessment_type ='exam'  AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexampk.php'>";
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
   $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_k' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
   $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
   $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
   $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
   $stmtgradeassignment->execute();
   foreach($stmtgradeassignment as $rowassignment){

     echo "<form method ='post' action = 'gradeassignmentk.php'>";
     echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
     echo "<input type = 'submit' name ='kass' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
     echo "</form>";
     echo "<div class ='spacer'></div>";
   }

   $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_k' AND assessment_type ='continous_assessment'  AND term =:term AND academic_year = :year";
   $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
   $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
   $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
   $stmtgradecontinous->execute();
   foreach($stmtgradecontinous as $rowcontinous){

     echo "<form method ='post' action = 'gradecontinousk.php'>";
     echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
     echo "<input type = 'submit' name ='kcont' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
     echo "</form>";
     echo "<div class ='spacer'></div>";
   }


   $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_k' AND assessment_type ='exam'  AND term =:term AND academic_year = :year";
   $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
   $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
   $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
   $stmtgradeexam->execute();
   foreach($stmtgradeexam as $rowexam){

     echo "<form method ='post' action = 'gradeexamk.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_1' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment1.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass1' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_1' AND assessment_type ='continous_assessment'  AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous1.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont1' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_1' AND assessment_type ='exam'  AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam1.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_2'  AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment2.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass2' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_2' AND assessment_type ='continous_assessment'  AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous2.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont2' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_2' AND assessment_type ='exam'  AND term =:term AND academic_year = :year ";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam2.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_3' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment3.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass3' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_3' AND assessment_type ='continous_assessment' AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous3.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont3' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_3' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam3.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_4' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment4.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass4' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_4' AND assessment_type ='continous_assessment' AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous4.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont4' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_4' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam4.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_5' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment5.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass5' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_5' AND assessment_type ='continous_assessment' AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous5.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont5' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_5' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam5.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_6' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment6.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass6' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_6' AND assessment_type ='continous_assessment' AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous6.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont6' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_6' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam6.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_7' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment7.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass7' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_7' AND assessment_type ='continous_assessment' AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous7.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont7' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_7' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam7.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_8' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment8.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass8' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_8' AND assessment_type ='continous_assessment' AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous8.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont8' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_8' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam8.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_9' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment9.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass9' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_9'AND term =:term AND academic_year = :year AND assessment_type ='continous_assessment'";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous9.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont9' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_9' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam9.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_10' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment10.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass10' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_10' AND assessment_type ='continous_assessment' AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous10.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont10' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_10' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam10.php'>";
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
  $sqlgradeassignment= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_11' AND term =:term AND academic_year = :year AND (assessment_type ='assignment' || assessment_type ='project')";
  $stmtgradeassignment = $user_home->runQuery($sqlgradeassignment);
  $stmtgradeassignment->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeassignment->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeassignment->execute();
  foreach($stmtgradeassignment as $rowassignment){

    echo "<form method ='post' action = 'gradeassignment11.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowassignment['assessment_id']."'>";
    echo "<input type = 'submit' name ='ass11' class = 'btn btn-info' value ='".$rowassignment['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }

  $sqlgradecontinous= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_11' AND assessment_type ='continous_assessment' AND term =:term AND academic_year = :year";
  $stmtgradecontinous = $user_home->runQuery($sqlgradecontinous);
  $stmtgradecontinous->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradecontinous->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradecontinous->execute();
  foreach($stmtgradecontinous as $rowcontinous){

    echo "<form method ='post' action = 'gradecontinous11.php'>";
    echo "<input type ='hidden' name ='hiddenid' value ='".$rowcontinous['assessment_id']."'>";
    echo "<input type = 'submit' name ='cont11' class = 'btn btn-error' value ='".$rowcontinous['assessment_id']."'/>";
    echo "</form>";
    echo "<div class ='spacer'></div>";
  }


  $sqlgradeexam= "SELECT * FROM btps_new_assessment WHERE target_class = 'grade_11' AND assessment_type ='exam' AND term =:term AND academic_year = :year";
  $stmtgradeexam = $user_home->runQuery($sqlgradeexam);
  $stmtgradeexam->bindValue(':term', $rowcurrent['current_term']);
  $stmtgradeexam->bindValue(':year', $rowcurrent['academic_year']);
  $stmtgradeexam->execute();
  foreach($stmtgradeexam as $rowexam){

    echo "<form method ='post' action = 'gradeexam11.php'>";
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
