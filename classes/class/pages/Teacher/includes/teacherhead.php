<!DOCTYPE html>
<html lang ='en'>
<head>
<meta name ="viewport" content ="width=device-width, initial-scale =1.0">
<meta charset ="UTF-8">
<title>BTPS.:.Portal</title>
<link rel="SHORTCUT ICON" href="../../../../favicon.ico"/>
<link rel="icon" href="../../../../favicon.ico?" type="image/x-icon">
<link rel = "stylesheet" type ="text/css" href ="../../../../css/style.css">
<link rel="stylesheet" href="../../../../scripts/bootstrap.min.css">
<link rel="stylesheet" href="../../../../summernote/summernote-bs4.min.css">
<script src="../../../../scripts/jquery.min.js"></script>
<script src="../../../../scripts/popper.min.js"></script>
<script src="../../../../scripts/bootstrap.min.js"></script>
<script src="../../../../scripts/idle_timer.js"></script>
<script src="../../../../scripts/dobPicker.min.js"></script>
<script src="../../../../scripts/tabs_old.js"></script>
<script src="../../../../scripts/formvalidator.js"></script>
<script src ="../../../../scripts/loader.js"></script>
<script src ="../../../../summernote/summernote-bs4.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: #9933cc;
  color: #ffffff;
  padding: 15px;
}


.headeranimated {
  background-color: #9933cc;
  color: #ffffff;
  padding: 15px;
  animation-name: example;
  animation-duration: 30s;
  animation-iteration-count: infinite;
}

@keyframes example {
  0%   {background-color:red}
  25%  {background-color:yellow}
  50%  {background-color:white}
  75%  {background-color:green}
  100% {background-color:red}
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  text-align: center;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.footer {
  background-color: #0099cc;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}

/* For mobile phones: */
[class*="col-"] {
  width: 100%;
}

@media only screen and (min-width: 600px) {
  /* For tablets: */
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}
@media only screen and (min-width: 768px) {
  /* For desktop: */
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
}
</style>
</head>
