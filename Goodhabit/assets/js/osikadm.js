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

// logout
$('#btn-logout').click(function(){
	setCookie("id_akun", "", -86400);
	setCookie("photo-profile", "", -86400);
	window.location = '../login.html';
});

$(document).ready(function(){
	if(getCookie("id_akun") != 1){
		window.location = '../login.html';
	}
});