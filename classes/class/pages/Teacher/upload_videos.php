<script>
$(document).ready(function (e) {

 $("#form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
   url: "saveuploads.php",
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

<div class ="jumbotron">
<h2>Upload Videos and Files</h2>
<form id ="form" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="title">Video / File Title: </label>
<input type="text" class="form-control" id = "title" name="title"/>
</div>

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
<option value = "general">General</option>
</select>
</div>

<div class="form-group">
<label for="subject">Please select a subject: </label>
<select name="subject" id ="subject">
<option value ="" selected disabled>[Choose here]</option>
<option value = "biology">Biology</option>
<option value = "caribbean_history">Caribbean History</option>
<option value = "chemistry">Chemistry</option>
<option value = "english">English</option>
<option value = "food_nutrition">Food & Nutrition</option>
<option value = "french">French</option>
<option value = "general_science">General Science</option>
<option value = "geography">Geography</option>
<option value = "health_science">Health Science</option>
<option value = "information_technology">Information Technology</option>
<option value = "integrated_science">Integrated Science</option>
<option value = "language_arts">Language Arts</option>
<option value = "mathematics">Mathematics</option>
<option value = "physics">Physics</option>
<option value = "physical_education">Physical Education</option>
<option value = "principles_of_business">Principles of Business</option>
<option value = "social_studies">Social Studies</option>
<option value = "spanish">Spanish</option>
<option value = "visual_arts">Virtual Arts</option>
<option value = "general">General Information</option>
</select>
</div>

<input id = "uploadImage" type="file" accept="video/*, image/*" name="image" /><span class ="error">Note: accepted file types - mp4, jpeg, jpg, png, gif, bmp, pdf, docx</span>
<hr>
<h1>OR</h1>
<label for ="note">Notes</label>
<textarea name ="report" cols= 50 rows =10 class ="form-control"></textarea>
<input type='hidden' name='hidden'/>
<input class="btn btn-success" type="submit" value="Upload">
</form>
<div id="err"></div>
</div>
