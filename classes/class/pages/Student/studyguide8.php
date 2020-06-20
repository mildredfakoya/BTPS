<?php
require_once 'includes/studentinit.php';
require_once 'includes/studenthead.php';
require_once 'includes/studentnav.php';
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
if(!in_array("grade_8", $permissions)){
$user_home->redirect('../../errors.php?nop');
}

else{
$grade = "grade_8";
?>
<div class ="jumbotron">
  <h5 class ="header">GRADE EIGHT STUDY GUIDE</h5>
  <p>Students are expected to have an understanding of each of the topics listed.</p>
<?php
  $sqltopics="SELECT * FROM btps_topics WHERE grade = :grade ORDER BY subject";
  $stmttopics = $user_home->runQuery($sqltopics);
  $stmttopics->bindValue(':grade', $grade);
  $stmttopics->execute();
  //$rowtopics = $stmttopics->fetch(PDO::FETCH_ASSOC);
  foreach($stmttopics as $rowtopics){
  ?>

 <div class="outer">
   <div class ="headinghome headeranimated"><h2><?php echo $rowtopics['subject']; ?></h2></div>
   <div class ="container" style ="background-color:white">
     <h5><?php echo $rowtopics['topics_covered']; ?></h5>
     <p><i><b><?php echo htmlspecialchars_decode($rowtopics['notes']); ?></b></i></p>

   </div>

</div>


  <?php
  }
  echo "</div>";
?>






<?php
require_once "includes/studentfooter.php";
}
?>
