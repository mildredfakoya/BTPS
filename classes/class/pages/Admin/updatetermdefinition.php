<?php
require_once 'includes/admininit.php';

    // set the time zone and get the date
	date_default_timezone_set('America/dominica');

  $created_at = date("y-m-d h:i:s");
  $definitioncode = bin2hex(random_bytes(8));
	$createdbyemail = $row['email'];
	$academicyear = !empty($_POST['academicyear']) ? $helper->test_input($_POST['academicyear']) : null;
	$term = !empty($_POST['term']) ? $helper->test_input($_POST['term']) : null;
	$class = !empty($_POST['class']) ? $helper->test_input($_POST['class']) : null;
	$assignment = !empty($_POST['assignment']) ? $helper->test_input($_POST['assignment']) : null;
	$projects = !empty($_POST['projects']) ? $helper->test_input($_POST['projects']) : null;
	$contassess = !empty($_POST['contassess']) ? $helper->test_input($_POST['contassess']) : null;
	$exam = !empty($_POST['exam']) ? $helper->test_input($_POST['exam']) : null;
	$amin = !empty($_POST['amin']) ? $helper->test_input($_POST['amin']) : null;
	$amax = !empty($_POST['amax']) ? $helper->test_input($_POST['amax']) : null;
	$bmin = !empty($_POST['bmin']) ? $helper->test_input($_POST['bmin']) : null;
	$bmax = !empty($_POST['bmax']) ? $helper->test_input($_POST['bmax']) : null;
	$cmin = !empty($_POST['cmin']) ? $helper->test_input($_POST['cmin']) : null;
	$cmax = !empty($_POST['cmax']) ? $helper->test_input($_POST['cmax']) : null;
	$dmin = !empty($_POST['dmin']) ? $helper->test_input($_POST['dmin']) : null;
	$dmax = !empty($_POST['dmax']) ? $helper->test_input($_POST['dmax']) : null;
	$emin = !empty($_POST['emin']) ? $helper->test_input($_POST['emin']) : null;
	$emax = !empty($_POST['emax']) ? $helper->test_input($_POST['emax']) : null;

	try{
	 $sqlf="INSERT INTO assessmentdefinitions(created_at, created_by_email, definition_code, academic_year,
	 term, class, assignment, projects, contassess, exam, amin, amax, bmin, bmax, cmin, cmax, dmin, dmax, emin, emax)
	 VALUES(:created_at, :created_by_email, :definition_code, :academic_year,
	 :term, :class, :assignment, :projects, :contassess, :exam, :amin, :amax, :bmin, :bmax, :cmin, :cmax, :dmin, :dmax, :emin, :emax)";
	 $stmtf = $user_home->runQuery($sqlf);
	 $stmtf->bindValue(':created_at', $created_at);
	 $stmtf->bindValue(':created_by_email', $createdbyemail);
	 $stmtf->bindValue(':definition_code', $definitioncode);
	 $stmtf->bindValue(':academic_year', $academicyear);
	 $stmtf->bindValue(':term', $term);
	 $stmtf->bindValue(':class', $class);
	 $stmtf->bindValue(':assignment', $assignment);
	 $stmtf->bindValue(':projects', $projects);
	 $stmtf->bindValue(':contassess', $contassess);
	 $stmtf->bindValue(':exam', $exam);
	 $stmtf->bindValue(':amin', $amin);
	 $stmtf->bindValue(':amax', $amax);
	 $stmtf->bindValue(':bmin', $bmin);
	 $stmtf->bindValue(':bmax', $bmax);
	 $stmtf->bindValue(':cmin', $cmin);
	 $stmtf->bindValue(':cmax', $cmax);
	 $stmtf->bindValue(':dmin', $dmin);
	 $stmtf->bindValue(':dmax', $dmax);
	 $stmtf->bindValue(':emin', $emin);
	$stmtf->bindValue(':emax', $emax);
	 $resultf = $stmtf->execute();

	  if($resultf){
			echo "Grading Scheme has been created";
		   }
		   else{
			echo "Grading Scheme was not created";
		   }
	}

	 catch(PDOException $e)
	    {
	      //die("SYSTEM FAILURE!! Please contact your administrator");
	   echo $e->getMessage();
	    }
