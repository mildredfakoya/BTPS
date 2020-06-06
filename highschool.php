<?php
require 'header.php';
require 'helper.php';
require_once 'classes/class/classes.php';
$user_helper = new helper();
$user_home = new USER();

?>

<h1 style = "color:#0000ff;text-align:center">High School Information</h1>


<div class ="row">
  <div class ="col-4">
  <div class ="outer">
  <div class ="headinghome">Grade 9</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade9");
    $stmt2a->execute();
    $row2a = $stmt2a->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class ="row">
      <div class ="col-3">Age Range: </div>
      <div class = "col-7 columspacer"><?php echo $row2a['ages'] ?></div>
    </div>
    <div class ="row">
      <div class ="col-3">Information: </div>
      <div class = "col-7 columspacer"><p><?php echo $row2a['information'] ?></p></div>
    </div>
  </div>
  </div>
  </div>
  <div class ="col-4">
  <div class ="outer">
  <div class ="headinghome">Grade 10</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade10");
    $stmt2a->execute();
    $row2a = $stmt2a->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class ="row">
      <div class ="col-3">Age Range: </div>
      <div class = "col-7 columspacer"><?php echo $row2a['ages'] ?></div>
    </div>
    <div class ="row">
      <div class ="col-3">Information: </div>
      <div class = "col-7 columspacer"><p><?php echo $row2a['information'] ?></p></div>
    </div>
  </div>
  </div>
  </div>

  <div class ="col-4">
  <div class ="outer">
  <div class ="headinghome">Grade 11</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade11");
    $stmt2a->execute();
    $row2a = $stmt2a->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class ="row">
      <div class ="col-3">Age Range: </div>
      <div class = "col-7 columspacer"><?php echo $row2a['ages'] ?></div>
    </div>
    <div class ="row">
      <div class ="col-3">Information: </div>
      <div class = "col-7 columspacer"><p><?php echo $row2a['information'] ?></p></div>
    </div>
  </div>
  </div>
  </div>

</div>



</body>
</html>
