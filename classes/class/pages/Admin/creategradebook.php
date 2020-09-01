<?php
require_once 'includes/adminheader.php';
require_once '../../../../aes.php';
$inputkey = "marketdayanyigba";
$blocksize = 256;
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
if(!in_array("records", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<div class ='jumbptron'>
<div class ='outer'>
  <div class ='header'>Pre k Grade Book</div>
  <div class ='container'>
  <?php
  $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Pre - K'" ;
  $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
  //$stmtid->bindValue(':email', $email);
  $stmtgetstudents->execute();
  foreach($stmtgetstudents as $rowgetstudents){
    $firstname =$rowgetstudents['firstname'];
    $lastname =$rowgetstudents['lastname'];
    $email = $rowgetstudents['email'];
    $firstn =new AES($firstname, $inputkey, $blocksize);
    $dec =$firstn->decrypt();
    $lastn =new AES($lastname, $inputkey, $blocksize);
    $decl =$lastn->decrypt();
    $emailn =new AES($email, $inputkey, $blocksize);
    $decemail =$emailn->decrypt();
    echo "<form method = 'post'>";
    echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
    echo "<br/><br/></form>";

  }
  ?>
  </div>


  <div class ='header'>Grade k Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade K'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>


  <div class ='header'>Grade 1 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 1'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>


  <div class ='header'>Grade 2 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 2'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>



  <div class ='header'>Grade 3 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 3'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>


  <div class ='header'>Grade 4 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 4'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>



  <div class ='header'>Grade 5 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 5'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>



  <div class ='header'>Grade 6 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 6'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>




  <div class ='header'>Grade 7 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 7'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>



  <div class ='header'>Grade 8 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 8'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>



  <div class ='header'>Grade 9 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 9'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>



  <div class ='header'>Grade 10 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 10'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>




  <div class ='header'>Grade 11 Grade Book</div>
  <div class ='container'>
    <?php
    $sqlgetstudents="SELECT DISTINCT email FROM grades WHERE class ='Grade 11'" ;
    $stmtgetstudents= $user_home->runQuery($sqlgetstudents);
    //$stmtid->bindValue(':email', $email);
    $stmtgetstudents->execute();
    foreach($stmtgetstudents as $rowgetstudents){
      $firstname =$rowgetstudents['firstname'];
      $lastname =$rowgetstudents['lastname'];
      $email = $rowgetstudents['email'];
      $firstn =new AES($firstname, $inputkey, $blocksize);
      $dec =$firstn->decrypt();
      $lastn =new AES($lastname, $inputkey, $blocksize);
      $decl =$lastn->decrypt();
      $emailn =new AES($email, $inputkey, $blocksize);
      $decemail =$emailn->decrypt();
      echo "<form method = 'post'>";
      echo "<button type = submit class ='btn btn-info'>".$dec.", ".$decl." email: ".$decemail."</button>";
      echo "<br/><br/></form>";

    }
    ?>
  </div>

</div>
</div>





<?php
}
require_once 'includes/adminfooter.php';
?>
