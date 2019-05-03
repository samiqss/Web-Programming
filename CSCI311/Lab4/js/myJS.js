"use strict";
var fname;
var lname;
var phone;
var street;
var city;
var postal;
var prov;
var fnameErr;
var lnameErr;
var streetErr;
var cityErr;
var postalErr;
var error;
var username;


function processForm() {
   fname = document.getElementById("fname").value;
   lname = document.getElementById("lname").value;
   phone = document.getElementById("phone").value;
   street = document.getElementById("street").value;
   city = document.getElementById("city").value;
   prov = document.getElementById("prov").value;
   postal = document.getElementById("postal").value;
   username = document.getElementById("username").value;
   outputs();
   return 0;
}

function validateText(txt, max, min){
   var text = txt;
   var txtLn = text.length;
   var trTxt = text.trim(); 
   var trTxtLn = trTxt.length;

   if ((trTxtLn!=0) && (txtLn >= min) && (txtLn<=max)){
      return true;
   }else {
      return false;
   }
}

function validateName(txt){ 
   var text = txt;
   var pattern = /^[A-Za-z\s']+$/;
   var trText = text.trim();
    if (validateText(txt, 30, 3) && pattern.test(text) ){
         return true;
    }else {
         return false;        
      }
}

function validateUsername(txt){
	var text = txt;
	var pattern = /^\@{1}[A-Z]([0-9]+[a-z]+|[a-z]+[0-9]+)[a-z0-9]*$/;
	var trText = text.trim();
	if (validateText(txt, 15, 5) && pattern.test(text) ){
		return true;
	}else {
		return false;
	}
}

function validatePostalCode(txt){
   var text = txt;
   var pattern = /^[A-Z][0-9][A-Z][0-9][A-Z][0-9]/;
   if ( pattern.test(text) ){
        return true;
   }else{
	return false;
   }
}

function errors(){
   if (validateText(street, 100, 4)){
   }else{
    document.getElementById("streetErr").innerHTML = "<p>street must be between 4 and 100 characters</p>";
   }
   if (validateText(city, 30, 2)){
   }else{
     document.getElementById("cityErr").innerHTML = "<p>city must be between 2 and 30 characters</p>";
   }
   if (validateName(fname)){
   }else{
     document.getElementById("fnameErr").innerHTML = "<p>first name must contain only letters and spaces, and be 3-20 chars</p>";
   }
   if (validateName(lname)){
   }else{
     document.getElementById("lnameErr").innerHTML = "<p>last name must contain only letters and spaces, and be 3-20 chars</p>";
   }
   if (validatePostalCode(postal)){
   }else{
     document.getElementById("postalErr").innerHTML = "<p>postal code must be of form X2X2X2</p>";
   }
   if (validateUsername(username)){
   }else{
     document.getElementById("usernameErr").innerHTML = "<p>username must be between 5 and 15 characters, must start with @ followed by a capital letter followed by a combination of numbers and lower case letters, has to be at least have one of each</p>";
	   
   }
}

function outputs(){
	if ( validateText(street, 100, 4) && validateText(city, 30, 2) && validateName(fname) && validateName(lname) && validatePostalCode(postal)){
	   document.getElementById("outputDiv").innerHTML = "Your name: "+fname+" "+lname+"<br/>"+"Your address: "+street+", "+city
			                                     +", "+prov+"<br/>"+"Postal Code: "+postal+"<br/>"+"Phone: "+phone+"<br/>";
	}else{
           errors();
	}
}

var x;
var y;
var op;
var ans;

function calc(){

	x = parseInt(document.getElementById("input1").value);
	y = parseInt(document.getElementById("input2").value);
	op = document.getElementById("op").value;
	if((op=="divide") && (y==0)){
		document.getElementById("screen").innerHTML = "<p>Err: cannot divide by 0</p>";
	}else if(op=="plus"){
		ans = x + y;
		alert(ans);
	}else if(op=="minus"){
		ans = x - y;
		alert(ans);		
	}else if(op=="times"){
		alert(ans);
		ans = x * y;	
	}else if(op=="divide"){
		ans = x / y;
		alert(ans);
	}else{
	}
}

