<?php
require 'header.php';
?>
<style>
.animation{
  background-color: red;
  animation-name: example;
  animation-duration: 20s;
  animation-iteration-count: infinite;
}

@keyframes example {
  0%   {background-color:red}
  25%  {background-color:yellow}
  50%  {background-color:white}
  75%  {background-color:green}
  100% {background-color:red}
}
.pencil{
  background-image:url('images/pencil.jpg');
  background-repeat: no-repeat;
  animation-name: pencil;
  animation-duration: 20s;
  animation-iteration-count: infinite;
}
@keyframes pencil {
    0%   {background-position: left;}
    25%  {background-position: right;}
    50%  {background-position: center;}
    75%   {background-position: left;}
    100%  {background-position: right;}
}
</style>
<h1 class = "animation" style = "color:#0000ff;text-align:center">Explore your learning opportunities</h1>
<div class ="jumbotron pencil">
  <p>Bonne Terre Preparatory School Limited was established in September 1992. Use the links below to get detailed information that will help you in your decision for your child's educational future.</p>
  <ul>
    <li><a href ="">PreSchool - Toddlers to Kindergarten</a></li>
    <li><a href ="">Elementary School section - Grade 1  to Grade 4</a></li>
    <li><a href ="">Middle School Section - Grade 5 - Grade 8</a></li>
    <li><a href ="">High School Section - Grade 9 - Grade 11</a></li>
  </ul>
  <p>Our mission is to provide all students with a broad education in a dynamic and nuturing environment. We are committed to Instilling
  in students good study habits and time management skills, to assure quality pupil performance so that students build a significant record of personal and academic achievement.
We aim to be progressive school embracing traditional values, in which self-respect, coutesy and consideration of others are of central importance.</p>
  <p>It is the policy of the school to maintain small class units and to vary the teaching methods to suit the needs of students. Each child is expected to work
  to his/her highest standard, developing a level of self-discipline so that individual responsibility for learning can take place.<br/>
<strong><em><u>Our Mission: </u>To nuture, ensure academic achievement, develop creativity, encourage critical thinking; EDUCATE.</em></strong><br/>
we will achieve our mission within a stable, orderly and secure environment by:
<ol>
  <li>Providing all students with a broad education in a dynamic and nuturing environment.</li>
  <li>Instilling good study habits and time management skills.</li>
  <li>Assuring quality pupil performance so that students build a significant record of personal and academic achievement.</li>
  <li>Being a progressive school embracing traditional values, in which self-respect, courtesy and consideration of others are of central importance.</li>
  <li>Presenting students with a curriculum that is ambitious, varied and stimulating.</li>
  <li>Encouraging and facilitating students in giving their maximum academic performance.</li>
  <li>Encouraging students to explore their interests in a wide variety of ways to promote independence of spirit, curiosity of mind, and a love of learning</li>
  <li>Instilling a sense of pride and decorum in all students, by insisting on high standards of conduct, presentation and deportment.</li>
  <li>Giving students tasks and responsibilities and maintaining systems of acknowledgement, praise and reward.</li>
  <li>Helping pupils develop moral values and an understanding of the beliefs of others</li>
  <li>Fostering worthwhile extra-curricula activities: sports, music, art, etc to facilitate students' well-rounded development</li>
</ol>
</p>

<p>Click on <a href ="admissions.php">Apply now</a> to learn more</p>


</div>
