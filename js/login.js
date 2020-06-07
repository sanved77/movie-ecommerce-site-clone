function validateForm() {
	
	var usern = document.loginform.user.value;
	var pw = document.loginform.pass.value;
	
	if(! usern){
		document.getElementById('userp').innerHTML = "Enter First Name";
        return false;
	}
	
	if(! pw){
		document.getElementById('passp').innerHTML = "Enter Password";
        return false;
	}
	
	if(pw.length > 1 && pw.length < 8){
		document.getElementById('passp').innerHTML = "8 characters or more needed";
        return false;
	}
	
}

function clearFname(){
	document.getElementById('fnamep').innerHTML = "";
}

function clearLname(){
	document.getElementById('lnamep').innerHTML = "";
}

function clearPass(){
	document.getElementById('passp').innerHTML = "";
}

function checkChars(){
	var addr = document.form1.addr.value;
	
	if(addr.length > 300){
		document.getElementById('addp').innerHTML = "Character limit exceeded";
	}else{
		var abc = 300 - addr.length;
		document.getElementById('addp').innerHTML = abc + " characters left";
	}
	
}