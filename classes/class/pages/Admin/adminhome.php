<?php
require_once 'includes/admininit.php';
require_once 'includes/adminhead.php';
require_once 'includes/adminnav.php';
 if(isset($_GET['error']))
		{

            echo "<div class='alert alert-success'>
				<strong>Email not Found! please enter the correct email address</strong>
			</div>";

		}

		if(isset($_GET['error1']))
		{

           echo  "<div class='alert alert-success'>
				<strong>Please Fill in an Email Address</strong>
			</div>";

		}
?>
<script>
$(document).ready(function (e) {



 $("#form").on('submit',(function(e) {
  e.preventDefault();
  var r = confirm('Are you ready to save the information?');
    if(r==true){
  $.ajax({
   url: "savetables.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   success:function(strMessage){
    alert(strMessage);
     location.reload();
   },
    });
  }
 }));

});


$(document).ready(function (e) {


 $("#formfood").on('submit',(function(e) {
  e.preventDefault();
  var r = confirm('Are you ready to save the information?');
    if(r==true){
  $.ajax({
   url: "savemenu.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   success:function(strMessage){
    alert(strMessage);
     location.reload();
   },
    });
  }
 }));

});

$(document).ready(function (e) {


 $("#formnews").on('submit',(function(e) {
  e.preventDefault();
  var r = confirm('Are you ready to save the information?');
    if(r==true){
  $.ajax({
   url: "savenewsletter.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   success:function(strMessage){
    alert(strMessage);
     location.reload();
   },
    });
  }
 }));

});




</script>


</head>
<body>
  <?php
  $inputkey = "marketdayanyigba";
  $blocksize = 256;
  #for the logged in user
  $firstname =$row['firstname'];
  $lastname =$row['lastname'];
  $email =$row['email'];
  $firstn =new AES($firstname, $inputkey, $blocksize);
  $dec =$firstn->decrypt();
  $lastn =new AES($lastname, $inputkey, $blocksize);
  $decl =$lastn->decrypt();

  $emailn =new AES($email, $inputkey, $blocksize);
  $decemail =$emailn->decrypt();
  ?>
<div class="headeranimated">
  <h1>Welcome <?php echo $dec . " ".$decl ?></h1>
</div>

<div class="row">
  <div class="col-3 col-s-3 menu">
  <!---session links placed here--->
  </div>
  <div class="col-6 col-s-9">
    <h1>Upload Time tables, Food menu and Newsletters</h1>
        <h3>Note that only pdf file is accepted</h3>
    <div class ="jumbotron">
    <h2>Time Table</h2>
    <form id ="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="grade">Please select the target grade: </label>
    <select name="grade" id ="grade">
    <option value ="" selected disabled>[Choose here]</option>
    <option value = "prek">Pre-K</option>
    <option value = "gradek">Grade K</option>
    <option value = "grade1">Grade 1</option>
    <option value = "grade2">Grade 2</option>
    <option value = "grade3">Grade 3</option>
    <option value = "grade4">Grade 4</option>
    <option value = "grade5">Grade 5</option>
    <option value = "grade6">Grade 6</option>
    <option value = "grade7">Grade 7</option>
    <option value = "grade8">Grade 8</option>
    <option value = "grade9">Grade 9</option>
    <option value = "grade10">Grade 10</option>
    <option value = "grade11">Grade 11</option>
    </select>
    </div>


    <input id = "uploadImage" type="file" accept="application/pdf" name="table" />
    <input type='hidden' name='hiddentables'/>
    <input class="btn btn-success" type="submit" value="Upload">
  </form><div id =err></div>
    </div>

    <div class ="jumbotron">
    <h2>Food Menu</h2>
    <form id ="formfood" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="month">Select the Month</label>
    <select name="month" id ="month">
    <option value ="" selected disabled>[Choose here]</option>
    <option value = "january">January</option>
    <option value = "february">February</option>
    <option value = "march">March</option>
    <option value = "april">April</option>
    <option value = "may">May</option>
    <option value = "june">June</option>
    <option value = "july">July</option>
    <option value = "august">August</option>
    <option value = "september">September</option>
    <option value = "october">October</option>
    <option value = "november">November</option>
    <option value = "december">December</option>
    </select>
    </div>
    <input id = "uploadmenu" type="file" accept="application/pdf" name="menu" />
    <input type='hidden' name='hiddenmenu'/>
    <input class="btn btn-success" type="submit" value="Upload">
    </form>
    </div>


    <div class ="jumbotron">
    <h2>News Letters</h2>
    <form id ="formnews" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="month">Select the Month</label>
    <select name="monthnews" id ="month">
    <option value ="" selected disabled>[Choose here]</option>
    <option value = "january">January</option>
    <option value = "february">February</option>
    <option value = "march">March</option>
    <option value = "april">April</option>
    <option value = "may">May</option>
    <option value = "june">June</option>
    <option value = "july">July</option>
    <option value = "august">August</option>
    <option value = "september">September</option>
    <option value = "october">October</option>
    <option value = "november">November</option>
    <option value = "december">December</option>
    </select>
    </div>
    <input id = "uploadnews" type="file" accept="application/pdf" name="news" />
    <input type='hidden' name='hiddennews'/>
    <input class="btn btn-success" type="submit" value="Upload">
    </form>
    </div>




  </div>
<?php
$classemail = $row['email'];
$encemail = new AES($classemail, $inputkey, $blocksize);
$decemail = $encemail->decrypt();







 ?>
  <div class="col-3 col-s-12">
    <div class="aside">

          <h2>Most recent uploads</h2><hr />
          <p> Note: If you just uploaded a file and it doesn't show up here, please refresh your page to update the list.<br/> Please use the date and time to locate the last uploaded file.<br/>
          The first 2 are from the timetable uploads, the next 2 are from the food menu uploads, the last 2 are from the news letters upload. You will get the 2 most recent uploads from each category</p>

          <?php
          $sql2a ="SELECT * FROM ihs_timetable_uploads ORDER BY created_at DESC LIMIT 2";
          $stmt2a = $user_home->runQuery($sql2a);
          $stmt2a->execute();

          $sqlmenuuploads ="SELECT * FROM ihs_menu_uploads ORDER BY created_at DESC LIMIT 2";
          $stmtmenuuploads = $user_home->runQuery($sqlmenuuploads);
          $stmtmenuuploads->execute();


          $sqlletteruploads ="SELECT * FROM ihs_newsletter_uploads ORDER BY created_at DESC LIMIT 2";
          $stmtletteruploads = $user_home->runQuery($sqlletteruploads);
          $stmtletteruploads->execute();



          	echo "<table><thead><tr>";
          	echo "<th>Date uploaded</th>
          	    <th>Email</th>
          			<th>Target</th>
          			<th>File Name</th>
          			<th>Uploaded by</th>

          	</tr>";
          	foreach($stmt2a as $rowfile)
          {
          	$videofirstname =$rowfile['created_by_firstname'];
          	$videolastname = $rowfile['created_by_lastname'];
            $email = $rowfile['email'];
          	$encfirst = new AES($videofirstname, $inputkey, $blocksize);
          	$enclast = new AES($videolastname, $inputkey, $blocksize);
            $encemail = new AES($email, $inputkey, $blocksize);
          	$decfirst = $encfirst->decrypt();
          	$declast = $enclast->decrypt();
            $decemail = $encemail->decrypt();
          	echo "<tr>";
          		echo "<td>".$rowfile['created_at']."</td>";
          	echo "<td>".$decemail."</td>";
          	echo "<td>".$rowfile['grade']."</td>";
          	echo "<td>"."<a target = '_blank' href='".$rowfile["file"]."'>". "View file"."</a></td>";
          	echo "<td>".$decfirst." ".$declast."</td></tr>";


          }



          foreach($stmtmenuuploads as $rowmenu)
        {
          $videofirstname =$rowmenu['created_by_firstname'];
          $videolastname = $rowmenu['created_by_lastname'];
          $email = $rowmenu['email'];
          $encfirst = new AES($videofirstname, $inputkey, $blocksize);
          $enclast = new AES($videolastname, $inputkey, $blocksize);
          $encemail = new AES($email, $inputkey, $blocksize);
          $decfirst = $encfirst->decrypt();
          $declast = $enclast->decrypt();
          $decemail = $encemail->decrypt();
          echo "<tr>";
            echo "<td>".$rowmenu['created_at']."</td>";
          echo "<td>".$decemail."</td>";
          echo "<td>".$rowmenu['month']."</td>";
          echo "<td>"."<a target = '_blank' href='".$rowmenu["file"]."'>". "View file"."</a></td>";
          echo "<td>".$decfirst." ".$declast."</td></tr>";


        }

                  foreach($stmtletteruploads as $rowletter)
                {
                  $videofirstname =$rowletter['created_by_firstname'];
                  $videolastname = $rowletter['created_by_lastname'];
                  $email = $rowletter['email'];
                  $encfirst = new AES($videofirstname, $inputkey, $blocksize);
                  $enclast = new AES($videolastname, $inputkey, $blocksize);
                  $encemail = new AES($email, $inputkey, $blocksize);
                  $decfirst = $encfirst->decrypt();
                  $declast = $enclast->decrypt();
                  $decemail = $encemail->decrypt();
                  echo "<tr>";
                    echo "<td>".$rowletter['created_at']."</td>";
                  echo "<td>".$decemail."</td>";
                  echo "<td>".$rowletter['monthnews']."</td>";
                  echo "<td>"."<a target = '_blank' href='".$rowletter["file"]."'>". "View file"."</a></td>";
                  echo "<td>".$decfirst." ".$declast."</td></tr>";


                }
          echo "</table></div>";
          ?>



      </div>
    </div>
  </div>
</div>

<!---<div class="footer">
  <p>Resize the browser window to see how the content respond to the resizing.</p>
</div>--->

<?php require_once 'includes/adminfooter.php';?>
