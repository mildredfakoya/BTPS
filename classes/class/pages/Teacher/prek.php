<?php
require_once 'includes/teacherinit.php';
require_once 'includes/teacherhead.php';
require_once 'includes/teachernav.php';

$sql2a ="SELECT * FROM ihs_news WHERE email= :email ORDER BY created_at DESC LIMIT 1";
			$stmt2a = $user_home->runQuery($sql2a);
			$stmt2a->bindValue(':email', $email);
			$stmt2a->execute();
			$row3 = $stmt2a->fetch(PDO::FETCH_ASSOC);

?>
<div class ='jumbotron'>
<h1>Getting Started</h1>
<div class ='outer'>
	<div class ='heading'>
    <h2>News</h2>
    </div>
	<div class ='container'>

		<h2><?php echo strtoupper($row3['topic'] )  ?></h2>
</div>

<div class ='outer'>
	<div class ='heading'>
	<h3>Syllabus and time table</h3>
    </div>
  <div class ='container'>
<p> Information goes here</p>
	</div>
</div>


</div>
<?php require_once 'includes/teacherfooter.php';?>
