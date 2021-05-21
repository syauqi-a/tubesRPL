function setCookie(cname, cvalue, minutes=1) {
	var d = new Date();
	d.setTime(d.getTime() + (minutes * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cookie_name){
	const re = new RegExp(`(?<=${cookie_name}=)[^;]*`);
	try{
		return document.cookie.match(re)[0];	// Will raise TypeError if cookie is not found
	}catch{
		return null;
	}
}

if((getCookie("id_akun") != null) && (getCookie("username") != null)){
	document.getElementsByClassName("username")[0].innerHTML = getCookie("username");
	document.getElementsByClassName("username")[1].innerHTML = getCookie("username");
	if(getCookie("photo-profile") != null){console.log("foto profilnya: "+getCookie("photo-profile"));
		document.getElementsByClassName("photo-profile")[0].src = "../assets/uploads/p-profiles/"+getCookie("photo-profile");
		document.getElementsByClassName("photo-profile")[1].src = "../assets/uploads/p-profiles/"+getCookie("photo-profile");
	}
}
else
	window.location = '../login.html';

$(document).ready(function(){
	if(document.getElementById("dateNow") != null){
		var day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
		var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		var d = new Date();
		document.getElementById("dateNow").innerHTML = "<b>"+day[d.getDay()]+"</b> "+d.getDate()+" "+month[d.getMonth()]+" "+d.getFullYear();
	}
	if(document.getElementById("gotoProfile") != null)
	document.getElementById("gotoProfile").onclick = () => location.href = "profile.html";
});

function logout(){
	setCookie("id_akun", "", -86400);
	window.location = '../login.html';
}