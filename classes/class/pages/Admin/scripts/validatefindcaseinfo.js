try{
function validatefirst(){
	var namepattern = /^[A-Za-z ]+$/;
	var firstname = document.forms.findid.firstname.value;
	if(firstname===""){
		  document.getElementById('firstname').innerHTML ="<br>Please Enter Client's first name";
		  document.forms.findid.firstname.style.borderColor ="red";
		  document.forms.findid.firstname.focus();
		  return false;
	  }

	 if(firstname!=""||firstname!=null){
	 document.getElementById('firstname').innerHTML ="";
	 var x = namepattern.test(firstname);
	 if(x === false){
	 document.getElementById('firstname').innerHTML ='<br>First Name should contain only letters and white spaces';
 	 document.forms.findid.firstname.style.borderColor ='red';
	 document.forms.findid.firstname.focus();
	 return false;
	}
	if(x!=false){
    document.forms.findid.firstname.style.borderColor ='blue';
	document.getElementById('firstname').innerHTML ='';
	return true;
	}
	}
}
function validatelast(){
	var namepattern = /^[A-Za-z ]+$/;
	var lastname = document.forms.findbylast.lastname.value;
	if(lastname===""){
		  document.getElementById('lastname').innerHTML ="<br>Please Enter client's last name";
		  document.forms.findbylast.lastname.style.borderColor ="red";
		  document.forms.findbylast.lastname.focus();
		  return false;
	  }

	 if(lastname!=""||lastname!=null){
	 document.getElementById('lastname').innerHTML ="";
	 var x = namepattern.test(lastname);
	 if(x === false){
	 document.getElementById('lastname').innerHTML ='<br>Last Name should contain only letters and white spaces';
 	 document.forms.findbylast.lastname.style.borderColor ='red';
	 document.forms.findbylast.lastname.focus();
	 return false;
	}
	if(x!=false){
    document.forms.findbylast.lastname.style.borderColor ='blue';
	document.getElementById('lastname').innerHTML ='';
	return true;
	}
	}
}


function validateexposed(){
	var namepattern = /^[A-Za-z ]+$/;
	var exposed = document.forms.findexposed.explastname.value;
	if(exposed===""){
		  document.getElementById('explastname').innerHTML ="<br>Please Enter Infant's last name";
		  document.forms.findexposed.explastname.style.borderColor ="red";
		  document.forms.findexposed.explastname.focus();
		  return false;
	  }

	 if(exposed!=""||exposed!=null){
	 document.getElementById('explastname').innerHTML ="";
	 var x = namepattern.test(exposed);
	 if(x === false){
	 document.getElementById('explastname').innerHTML ='<br>Name should contain only letters and white spaces';
 	 document.forms.findexposed.explastname.style.borderColor ='red';
	 document.forms.findexposed.explastname.focus();
	 return false;
	}
	if(x!=false){
    document.forms.findexposed.explastname.style.borderColor ='blue';
	document.getElementById('explastname').innerHTML ='';
	return true;
	}
	}
}

function validateform(){
	var namepattern = /^[A-Za-z ]+$/;
	var antenatal = document.forms.antenatal.antefirstname.value;
	if(antenatal===""){
		  document.getElementById('antefirstname').innerHTML ="<br>Please Enter client's first name";
		  document.forms.antenatal.antefirstname.style.borderColor ="red";
		  document.forms.antenatal.antefirstname.focus();
		  return false;
	  }

	 if(antenatal!=""||antenatal!=null){
	 document.getElementById('antefirstname').innerHTML ="";
	 var x = namepattern.test(antenatal);
	 if(x === false){
	 document.getElementById('antefirstname').innerHTML ='<br>Name should contain only letters and white spaces';
 	 document.forms.antenatal.antefirstname.style.borderColor ='red';
	 document.forms.antenatal.antefirstname.focus();
	 return false;
	}
	if(x!=false){
    document.forms.antenatal.antefirstname.style.borderColor ='blue';
	document.getElementById('antefirstname').innerHTML ='';
	return true;
	}
	}
}

}

catch(err){
	window.alert(err.message);
  }
