<?php
require_once 'includes/teacherheader.php';
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
if(!in_array("libraryandgradebook", $permissions)){
$user_home->redirect('../../errors.php?nop');
}
else{
?>
<script>
$(document).ready(function (e) {

 $("#form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
   url: "savebook.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
      {
    if(data=='invalid')
    {
     // invalid file format.
     $("#err").html("Invalid File !").fadeIn();
    }
    else
    {
     // view uploaded file.
     $("#preview").html(data).fadeIn();
     $("#form")[0].reset();
    }
      },
     error: function(e)
      {
    $("#err").html(e).fadeIn();
      }
    });
 }));

});
</script>
<div class ="container">
  <form id ="form" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <th>Book Title</th>
        <td><input type ='text' name ="booktitle" /></td>
      </tr>

      <tr>
        <th>Target Subject</th>
        <td><input type ='text' name ="subject" /></td>
      </tr>

      <tr>
        <th>Target class</th>
        <td><select name ='class'>
          <option value ="" selected disabled>[Choose Here]</option>
          <option value ="guest">Guest Students</option>
          <option value ="pre_k">Pre K</option>
          <option value ="grade_k">Grade K</option>
          <option value ="grade_1">Grade 1</option>
          <option value ="grade_2">Grade 2</option>
          <option value ="grade_3">Grade 3</option>
          <option value ="grade_4">Grade 4</option>
          <option value ="grade_5">Grade 5</option>
          <option value ="grade_6">Grade 6</option>
          <option value ="grade_7">Grade 7</option>
          <option value ="grade_8">Grade 8</option>
          <option value ="grade_9">Grade 9</option>
          <option value ="grade_10">Grade 10</option>
          <option value ="grade_11">Grade 11</option>
          <option value ="general">General</option>
        </select></td>
      </tr>

      <tr>
        <th>Book Description</th>
        <td><textarea name ='description'></textarea></td>
      </tr>

      <tr>
        <th>Upload Book</th>
        <td><input id = "uploadImage" type="file" accept=".doc, .docx, .pdf" name="image" /><span class ="error">Note: accepted file types - pdf, doc, docx</span></td>
      </tr>
    </table>
    <br/>
    <input type = 'submit' name ='uploadbook' class ='btn btn-secondary' value = 'Add Book to Library'>
  </form>
</div>



<?php
require_once 'includes/teacherfooter.php';
}
