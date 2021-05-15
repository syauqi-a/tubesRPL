function setCookie(cname, cvalue, minutes=1) {
	var d = new Date();
	d.setTime(d.getTime() + (minutes * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

const getCookie = (cookie_name) =>{
	const re = new RegExp(`(?<=${cookie_name}=)[^;]*`);
	try{
		return document.cookie.match(re)[0];	// Will raise TypeError if cookie is not found
	}catch{
		return null;
	}
}

if((getCookie("id_akun") != null) && (getCookie("username") != null)){
	document.getElementById("username").innerHTML = getCookie("username");
	document.getElementById("nav-username").innerHTML = getCookie("username");
}
else
	window.location = '../login.html';

$(document).ready(function(){
	var day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	var d = new Date();
	document.getElementById("dateNow").innerHTML = "<b>"+day[d.getDay()]+"</b> "+d.getDate()+" "+month[d.getMonth()]+" "+d.getFullYear();
});

function logout(){
	setCookie("id_akun", "", -86400);
	window.location = '../login.html';
}