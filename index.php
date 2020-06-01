<?php
require 'header.php';
require 'helper.php';
require_once 'classes/class/classes.php';
$user_helper = new helper();
$user_home = new USER();

?>

<h1 style = "color:#0000ff;text-align:center">Explore your learning opportunities</h1>

<div class ="row">

<div class ="col-4">
<div class ="outer">
<div class ="headinghome">Pre Kindergarten</div>
<div class ="container">
  <?php
  $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
  $stmt2a = $user_home->runQuery($sql2a);
  $stmt2a->bindValue(':grade', "prek");
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
<div class ="headinghome">Kindergarten</div>
<div class ="container">
  <?php
  $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
  $stmt2a = $user_home->runQuery($sql2a);
  $stmt2a->bindValue(':grade', "gradek");
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
<div class ="headinghome">Grade 1</div>
<div class ="container">
  <?php
  $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
  $stmt2a = $user_home->runQuery($sql2a);
  $stmt2a->bindValue(':grade', "grade1");
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


<div class ='row'>
  <div class ="col-4">
  <div class ="outer">
  <div class ="headinghome">Grade 2</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade2");
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
  <div class ="headinghome">Grade 3</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade3");
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
  <div class ="headinghome">Grade 4</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade4");
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


<div class ='row'>
  <div class ="col-4">
  <div class ="outer">
  <div class ="headinghome">Grade 5</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade5");
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
  <div class ="headinghome">Grade 6</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade6");
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
  <div class ="headinghome">Grade 7</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade7");
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


<div class ='row'>
  <div class ="col-4">
  <div class ="outer">
  <div class ="headinghome">Grade 8</div>
  <div class ="container">
    <?php
    $sql2a ="SELECT * FROM btps_info WHERE grade= :grade ORDER BY created_at DESC LIMIT 1";
    $stmt2a = $user_home->runQuery($sql2a);
    $stmt2a->bindValue(':grade', "grade8");
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

</div>



<div class ='row'>
  <div class ="col-4">
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

  <div class ="col-4">
  </div>

</div>



</body>
</html>
