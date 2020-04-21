try{
function validatesignup(){
	var namepattern = /^[A-Za-z ]+$/;
	var firstname = document.forms.signup.firstname.value;
	var lastname = document.forms.signup.lastname.value;
	var email = document.forms.signup.email.value;
	var cemail = document.forms.signup.cemail.value;
	var pass = document.forms.signup.password.value;
	var cpassword = document.forms.signup.cpassword.value;
	var role = document.forms.signup.role.value;
	
	if(firstname===""||firstname===null){
		  document.getElementById('firstname').innerHTML ="<br>Please Enter user's first name";
		  document.forms.signup.firstname.style.borderColor ="red";
		  document.forms.signup.firstname.focus();
		  return false;
	  }
 
	
	
	
	
	if(lastname===""||lastname===null){
		  document.getElementById('lastname').innerHTML ="<br>Please Enter user's last name";
		  document.forms.signup.lastname.style.borderColor ="red";
		  document.forms.signup.lastname.focus();
		  return false;
	  }
 
	 
	if(email===""||email===null){
		  document.getElementById('email').innerHTML ="<br>Please enter user's email address";
		  document.forms.signup.email.style.borderColor ="red";
		  document.forms.signup.email.focus();
		  return false;
	  }
	
	if(cemail===""||cemail===null){
		  document.getElementById('cemail').innerHTML ="<br>Please confirm the email address";
		  document.forms.signup.cemail.style.borderColor ="red";
		  document.forms.signup.cemail.focus();
		  return false;
	  }
 
	if(cemail!==email){
		  document.getElementById('cemail').innerHTML ="The Confirmation email is not the same as the email address provided";
		  document.forms.signup.cemail.style.borderColor ="red";
		  document.forms.signup.cemail.focus();
		  return false;	
		
	}
	
	if(pass===""||pass===null){
		  document.getElementById('password').innerHTML ="<br>Please provide a password for the user";
		  document.forms.signup.password.style.borderColor ="red";
		  document.forms.signup.password.focus();
		  return false;
	  }
	
	if(cpassword===""||cpassword===null){
		  document.getElementById('cpassword').innerHTML ="<br>Please confirm user's password";
		  document.forms.signup.cpassword.style.borderColor ="red";
		  document.forms.signup.cpassword.focus();
		  return false;
	  }
	  
	if(cpassword!==pass){
		  document.getElementById('cpassword').innerHTML ="The password confirmation value is not the same as the password provided. Please ensure that both values are the same.";
		  document.forms.signup.cpassword.style.borderColor ="red";
		  document.forms.signup.cpassword.focus();
		  return false;	
		
	}
	
	if(role===""||role===null){
		  document.getElementById('role').innerHTML ="<br>Please select user's role";
		  document.forms.signup.role.style.borderColor ="red";
		  document.forms.signup.role.focus();
		  return false;
	  }
	
 
	
}

function validatefn(){
	var namepattern = /^[A-Za-z ]+$/;
	var firstname = document.forms.signup.firstname.value;
	if(firstname!=""||firstname!=null){
	 document.getElementById('firstname').innerHTML ="";	
	 var x = namepattern.test(firstname);
	 if(x === false){
	 document.getElementById('firstname').innerHTML ='First Name should contain only letters and white spaces';
 	 document.forms.signup.firstname.style.borderColor ='red';
	 document.forms.signup.firstname.focus();
	 return false;	
	}
	if(x!=false){
    document.forms.signup.firstname.style.borderColor ='green';
	document.getElementById('firstname').innerHTML ='';	
	}
	}
}	
	

function validateln(){
	var namepattern = /^[A-Za-z ]+$/;
	var lastname = document.forms.signup.lastname.value;
		if(lastname!=""||lastname!=null){
	 document.getElementById('lastname').innerHTML ="";	
	 var x = namepattern.test(lastname);
	 if(x === false){
	 document.getElementById('lastname').innerHTML ='Last Name should contain only letters and white spaces';
 	 document.forms.signup.lastname.style.borderColor ='red';
	 document.forms.signup.lastname.focus();
	 return false;	
	}
	if(x!=false){
    document.forms.signup.lastname.style.borderColor ='green';
	document.getElementById('lastname').innerHTML ='';	
	}
	}
}	


function validateemail(){
	var email = document.forms.signup.email.value;
	if(email!=""&&email!=null){
     document.forms.signup.email.style.borderColor ='green';
	 document.getElementById('email').innerHTML ='';
	 
	}
	else{
	 document.forms.signup.email.borderColor ='red';
	 document.getElementById('email').innerHTML ='Please provide an email address for user';
	 document.forms.signup.email.focus();
	 return false;
	}
	
}	

function validatecemail(){
	var cemail = document.forms.signup.cemail.value;
	if(cemail!=""&&cemail!=null){
     document.forms.signup.cemail.style.borderColor ='green';
	 document.getElementById('cemail').innerHTML ='';
	 
	}
	
	else{
	 document.forms.signup.cemail.borderColor ='red';
	 document.getElementById('cemail').innerHTML ='Please confirm user\'s email address';
	 document.forms.signup.cemail.focus();
	 return false;
	}
	
}	

function validatepass(){
	var pass = document.forms.signup.password.value;
	if(pass!=""&&pass!=null){
     document.forms.signup.password.style.borderColor ='green';
	 document.getElementById('password').innerHTML ='';
	 
	}
	
	else{
	 document.forms.signup.password.borderColor ='red';
	 document.getElementById('password').innerHTML ='Please enter a value for user\'s password';
	 document.forms.signup.password.focus();
	 return false;
	}
	
}

function validatecpass(){
	var cpassword = document.forms.signup.cpassword.value;
	if(cpassword!=""&&cpassword!=null){
     document.forms.signup.cpassword.style.borderColor ='green';
	 document.getElementById('cpassword').innerHTML ='';
	 
	}
	
	else{
	 document.forms.signup.cpassword.borderColor ='red';
	 document.getElementById('cpassword').innerHTML ='Please confirm user\'s password';
	 document.forms.signup.cpassword.focus();
	 return false;
	}
	
}	

function validaterole(){
	var role = document.forms.signup.role.value;
	if(role!=""&&role!=null){
     document.forms.signup.role.style.borderColor ='green';
	 document.getElementById('role').innerHTML ='';
	 
	}
	
	else{
	 document.forms.signup.role.borderColor ='red';
	 document.getElementById('role').innerHTML ='Please enter a value for user\'s role';
	 document.forms.signup.role.focus();
	 return false;
	}
	
}		
	
}

catch(err){
	window.alert(err.message);
  }  
 