try{
function validatesignup(){
	var namepattern = /^[A-Za-z ]+$/;
	var firstname = document.forms.signup.firstname.value;
	var lastname = document.forms.signup.lastname.value;
	var email = document.forms.signup.email.value;
	var role = document.forms.signup.role.value;
	
	if(firstname===""||firstname===null){
		  document.getElementById('firstname').innerHTML ="<br>Please Enter user's first name";
		  document.forms.signup.firstname.style.borderColor ="red";
		  document.forms.signup.firstname.focus();
		  return false;
	  }
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
 
	if(lastname===""||lastname===null){
		  document.getElementById('lastname').innerHTML ="<br>Please Enter user's last name";
		  document.forms.signup.lastname.style.borderColor ="red";
		  document.forms.signup.lastname.focus();
		  return false;
	  }
 
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
	 
	if(email===""||email===null){
		  document.getElementById('email').innerHTML ="<br>Please enter user's email address";
		  document.forms.signup.email.style.borderColor ="red";
		  document.forms.signup.email.focus();
		  return false;
	  }
	  
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
	
	
	if(role===""||role===null){
		  document.getElementById('role').innerHTML ="<br>Please select user's role";
		  document.forms.signup.role.style.borderColor ="red";
		  document.forms.signup.role.focus();
		  return false;
	  }
	  
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
	
	if(userStatus===""||userStatus===null){
		  document.getElementById('userStatus').innerHTML ="<br>Please select user's activation status";
		  document.forms.signup.userStatus.style.borderColor ="red";
		  document.forms.signup.userStstus.focus();
		  return false;
	  }
	  
	if(userStatus!=""&&userStatus!=null){
     document.forms.signup.userStatus.style.borderColor ='green';
	 document.getElementById('userStatus').innerHTML ='';
	 
	}
	
	else{
	 document.forms.signup.userStatus.borderColor ='red';
	 document.getElementById('userStatus').innerHTML ='Please enter a value for user\'s activation status';
	 document.forms.signup.userStatus.focus();
	 return false;
	}
	
}

}

catch(err){
	window.alert(err.message);
  }  
 