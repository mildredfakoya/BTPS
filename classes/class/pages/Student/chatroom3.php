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
if(!in_array("grade_3", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{

?>
<script>
$(document).ready(function(){
  $("#chat").validate({
 //specify the validation rules
    rules: {
      topic: "required",
      content: "required",
    },

 // Specify the validation error messages
    messages: {
      topic: "Please create a new topic or comment on existing topics",
      content: "Please enter your chat content",
    },

 //specify how the form should be submitted
  submitHandler: function(form) {
    var r = confirm('Are you ready to save the information?');
       if(r==true){
         $.ajax({
 //specify file for form processing
            url:"updatechatthree.php",
            method:"post",
           data:$('form').serialize(),
            dataType:"text",
            success:function(strMessage){
             alert(strMessage);
              location.reload();
            },
         })
       }
   }
  })
 });




 $(document).ready(function(){
   $("#chatprivate").validate({
  //specify the validation rules
     rules: {
       topic2: "required",
       content2: "required",
       recipient:"required",
     },

  // Specify the validation error messages
     messages: {
       topic2: "Please create a new topic or comment on existing topics",
       content2: "Please enter your chat content",
       recipient:"required",
     },

  //specify how the form should be submitted
   submitHandler: function(form) {
     var r = confirm('Are you ready to save the information?');
        if(r==true){
          $.ajax({
  //specify file for form processing
             url:"updatechat2three.php",
             method:"post",
            data:$('form').serialize(),
             dataType:"text",
             success:function(strMessage){
              alert(strMessage);
               location.reload();
             },
          })
        }
    }
   })
  });




$(document).ready(function(){
  $("#reply").validate({
    //specify the validation rules
       rules: {
         respond: "required",
       },

    // Specify the validation error messages
       messages: {
         respond: "response cannot be left blank",
       },

    //specify how the form should be submitted
     submitHandler: function(form) {
       var r = confirm('Are you ready to save the information?');
          if(r==true){
            $.ajax({
    //specify file for form processing
               url:"responsechat3.php",
               method:"post",
              data:$('form').serialize(),
               dataType:"text",
               success:function(strMessage){
                alert(strMessage);
                 location.reload();
               },
            })
          }
      }
     })
    });

</script>
<div class ='row'>
  <div class ='col-5 jumbotron'>
  <h5 class ='header'>New Private Chat</h5>
  <div class ="outer">
    <form method = 'post' novalidate = 'novalidate' id = 'chatprivate'>
    <div class ="container">
    <textarea name ='content2' placeholder="enter your content here"></textarea>
    <select name = 'recipient'>
          <option selected disabled>[Select recipient]</option>
                                      <?php

                                      //$sqlemail = "SELECT * FROM ihs_users";
                                      $sqlemail = "SELECT * FROM `ihs_user_permissions` WHERE permissions LIKE '%grade_3%'";
                                      $stmtemail = $user_home->runQuery($sqlemail);
                                      $stmtemail->execute();
                                      while ($rowemail = $stmtemail->fetch(PDO::FETCH_ASSOC)) {
                                        $optionemail =$rowemail['email'];
                                        $optionemailn =new AES($optionemail, $inputkey, $blocksize);
                                        $optionemaildec =$optionemailn->decrypt();

                                          echo "<option value='" . $optionemaildec . "'>" . $optionemaildec . "</option>";
                                      }
                                      ?>
        </select><br/><br/>
        <input type = 'hidden' name ='user' value = '<?php echo $email?>' class ='btn btn-danger'>
  <input type = 'submit' name ='submit' value = 'POST' class ='btn btn-danger'>
      </div>
    </form>
    </div>


  <div class ='spacer'></div>
  <div class ='spacer'></div>
  <div class ='spacer'></div>


    <h5 class ='header'>New Public Chat</h5>
    <div class ="outer">
      <form method = 'post' novalidate = 'novalidate' id = 'chat'>
      <div class ="container">
        <textarea name ='content' placeholder="enter your content here"></textarea>
        <input type = 'hidden' name ='user' value = '<?php echo $email?>' class ='btn btn-danger'>
  <input type = 'submit' name ='submit' value = 'POST' class ='btn btn-danger'>
      </div>
    </form>
    </div>
  </div>





  <div class ='col-7'>

<?php
$sqlchat ="SELECT DISTINCT(chat_id) FROM chats3";
$stmtchat= $user_home->runQuery($sqlchat);
$stmtchat->execute();
foreach($stmtchat as $rowchat){
  echo "<form method ='post'>";
  echo "<input type ='hidden' name ='chatid' value ='".$rowchat['chat_id']."'>";
  //echo "<input type ='hidden' name ='recipient' value ='".$rowchat['recipient_mail']."'>";
  echo "<button type = 'submit' name ='chat'>".$rowchat['chat_id']."</button>";
  echo "</form>";
}
if(isset($_POST['chat'])){
  $chatid= !empty($_POST['chatid']) ? $helper->test_input($_POST['chatid']) : null;
  # All chats
  $sql2a ="SELECT * FROM chats3 WHERE chat_id = '$chatid' AND (recipient_mail = '$email' || recipient_mail = 'All' || created_by_email = '$email')";
  $stmt2a = $user_home->runQuery($sql2a);
  $stmt2a->bindValue(':email', $email);
  $stmt2a->execute();
  //$rowchatmail = $stmt2a->fetch(PDO::FETCH_ASSOC)
   foreach($stmt2a as $row2a){
     $emailrec = $row2a['recipient_mail'];

     if($emailrec == "All"){
       $recemail = "All";
     }
     else{
#Decrypt recipient email
     $recname =new AES($emailrec, $inputkey, $blocksize);
     $recemail=$recname->decrypt();
   }
   $emaildec = $row2a['created_by_email'];
#Decrypt sender email
     $lastn =new AES($emaildec, $inputkey, $blocksize);
     $decemail=$lastn->decrypt();

       echo "<div><span class ='error'>Recipient: ".$recemail."</div>";
       echo "<div class ='textspacer'></div>";
       echo "<div><strong>".$row2a['content']."</strong><i> ++ at-- ".$row2a['created_at']."  by-- ".$decemail."</i></div>";
       echo "<form method ='post' id = 'reply'>";
      }
       echo "<input type = 'text' name = 'respond' placeholder = 'Type a response'>";
       echo "<input type = 'hidden' name = 'chatidres' value = '".$row2a['chat_id']."'>";
       if($emailrec != "All"){
         echo "<input type = 'hidden' name = 'recipientres' value = '".  $emaildec."'>";
       }else{
       echo "<input type = 'hidden' name = 'recipientres' value = 'All'>";
     }
       echo "<input type = 'submit' name ='reply' value = 'Reply' class ='btn btn-info'>";
       echo "</form>";

       echo "<div class ='spacer'></div>";

}



  ?>

</div>

</div>
<?php
}
require_once 'includes/studentfooter.php';
