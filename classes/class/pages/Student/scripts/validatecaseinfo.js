  try{

//Function For Automatic Testing Code Generation 
function code(){
	  var firstname = document.forms.testing.firstname.value;
	  var mmaidenname = document.forms.testing.mmaidenname.value;
	  var lastname = document.forms.testing.lastname.value;
	  var gender = document.forms.testing.gender.value;
	  var year = document.forms.testing.year.value;
	  if(year ==""||year==null){
		  document.getElementById('year').innerHTML ="The Year of Birth is needed to generate Client's testing code. Leaving it blank will use an unknown year to generate the test code.";
		year = "yyyy";  
	  }
    
	  
	  if(firstname ===""||firstname===null){
		  document.getElementById('firstname').innerHTML ="Please fill in the client's first name";
		  document.forms.testing.firstname.style.borderColor ='red';
		  document.forms.testing.firstname.focus();
		  return false;
	  }
	  
	 else if(lastname===""||lastname===null){
		  document.getElementById('lastname').innerHTML ="Please fill in the client's last name";
		  document.forms.testing.lastname.style.borderColor ='red';
		  document.forms.testing.lastname.focus();
		  return false;
	  }
	  
	
	else if(mmaidenname===""||mmaidenname===null){
		document.forms.testing.mmaidenname.value ="Unknown";  document.getElementById('mmaidenname').innerHTML ="Please fill in the client's mother's maiden name. If name is Unknown, Please fill in Unknown";
		  document.forms.testing.mmaidenname.style.borderColor ='red';
		  document.forms.testing.mmaidenname.focus();
		  return false;
	  }
	  
	 else if(gender===""||gender===null){
		 document.getElementById('gender').innerHTML ="Please Select client's gender";
		 document.forms.testing.gender.style.borderColor ='red';
		  document.forms.testing.gender.focus();
		  return false;
	  }
	 
  else{
  document.forms.testing.testingcode.value = (firstname.charAt(0) + mmaidenname.charAt(0) + lastname.charAt(0) + year.charAt(2) + year.charAt(3) + gender.charAt(0)).toUpperCase(); 
   return true;
  }

  }
  	
 }
catch(err){
	window.alert(err.message);
  }  
  
  