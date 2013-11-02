function validateNonEmpty (inputField, helpText) {
	if(inputField.value.length == 0){
		helpText.className = 'alert alert-error';
		helpText.innerHTML = "Required!Cannot be empty!";
		return false;
	}
	else{
		helpText.className = '';
		helpText.innerHTML = "";
		return true;
	}
}


function validateAccountAndID (inputField, helpText) {
	if(!validateNonEmpty(inputField, helpText))return false;
	else {
		var regex = /^\d{1,10}$/;
		if(!regex.test(inputField.value)){
			helpText.className = 'alert alert-error';
			helpText.innerHTML = "Only allow <= 10 numbers!";
			return false;
		}
	}
		helpText.className = '';
		helpText.innerHTML = "";
		return true;	
}

function validatePassword(inputField, helpText) {
	if(!validateNonEmpty(inputField, helpText))return false;
	else if(inputField.value.length >= 10){
			helpText.className = 'alert alert-error';
			helpText.innerHTML = "Only allow <= 10 characters!";
			return false;
	}
	helpText.className = '';
	helpText.innerHTML = "";
	return true;	
}
function validateName(inputField, helpText){
	if(!validateNonEmpty(inputField, helpText))return false;
	else {
		var regex = /^[a-zA-Z]{1,10}$/;
		if(!regex.test(inputField.value)){
			helpText.className = 'alert alert-error';
			helpText.innerHTML = "Only allow <= 10 characters!";
			return false;
		}
	}
		helpText.className = '';
		helpText.innerHTML = "";
		return true;

}

function ajaxPost(inputField, url){
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }


	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    inputField.innerHTML=xmlhttp.responseText;
	    }
	  }
	var query = "";

	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send();	
}
function submitStudentForm(){
	if(
		validateAccountAndID(document.getElementById('stdAccount'),document.getElementById('stdAccountHelp')) 
		&& validatePassword(document.getElementById('stdPassword'),document.getElementById('stdPasswordHelp')) 
		&& validateName(document.getElementById('stdName'),document.getElementById('stdNameHelp')) 
		&& validateAccountAndID(document.getElementById('stdID'),document.getElementById('stdIDHelp')) ){
		alert("success");
	   	return true;
	}
	else {
		alert("Something wrong in the form. Please check again!");
		return false;
	}
}

function submitProfessorForm(){
	if(
		validateAccountAndID(document.getElementById('profAccount'),document.getElementById('profAccountHelp')) 
		&& validatePassword(document.getElementById('profPassword'),document.getElementById('profPasswordHelp')) 
		&& validateName(document.getElementById('profName'),document.getElementById('profNameHelp')) 
		&& validateAccountAndID(document.getElementById('profID'),document.getElementById('profIDHelp')) ){
		alert("success");
	   	return true;
	}
	else {
		alert("Something wrong in the form. Please check again!");
		return false;
	}
}

function update(inputField, compare, helpText){
	if(inputField.value !== compare){
		helpText.className = 'alert alert-error';
		helpText.innerHTML = "Cannot change this column! All change will be reset!";
		inputField.value = compare;
		return false;
	}
	else{
		helpText.className = '';
		helpText.innerHTML = "";
		return true;
	}
}

function updatePassword (inputField, helpText) {
	if(inputField.value.length >= 10){
		helpText.className = 'alert alert-error';
		helpText.innerHTML = "Only allow <= 10 characters!";
		return false;
	}
	helpText.className = '';
	helpText.innerHTML = "";
	return true;
}

function validateMultiple(inputField, helpText){
	var valid = false;
	for(var i = 0; i < inputField.options.length; i++) {  

        if(inputField.options[i].selected) {  
            valid = true;  
            break;  
        }  
    }  
  	if(!valid){
		helpText.className = 'alert alert-error';
		helpText.innerHTML = "Must at least select one value!";
		return false;
  	}
  	else{
 		helpText.className = '';
		helpText.innerHTML = "";
		return true;		
  	}
}


function validateCapacity (inputField, helpText) {
	if(!validateNonEmpty(inputField, helpText))return false;
	else {
		var regex = /^\d{1,3}$/;
		if(!regex.test(inputField.value)){
			helpText.className = 'alert alert-error';
			helpText.innerHTML = "Only allow <= 3numbers!";
			return false;
		}
	}
		helpText.className = '';
		helpText.innerHTML = "";
		return true;	
}


function submitTeachCourseForm(){
	if(validateNonEmpty(document.getElementById('courseName'),document.getElementById('courseNameHelp')) && 
		validateNonEmpty(document.getElementById('teacherName'),document.getElementById('teacherNameHelp')) &&
		validateNonEmpty(document.getElementById('classroom'),document.getElementById('classroomHelp')) &&
		validateCapacity(document.getElementById('capacity'),document.getElementById('capacityHelp')) &&
		validateMultiple(document.getElementById('courseTime1'),document.getElementById('courseTime1Help'))
		){
		alert("success");
	   	return true;
	}
	else {
		alert("Something wrong in the form. Please check again!");
		return false;
	}
}