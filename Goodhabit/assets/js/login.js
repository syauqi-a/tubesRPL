function setCookie(cname, cvalue, minutes=1) {
	var d = new Date();
	d.setTime(d.getTime() + (minutes * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cookie_name) {
	const re = new RegExp(`(?<=${cookie_name}=)[^;]*`);
	try{
		return (document.cookie.match(re)[0]);	// Will raise TypeError if cookie is not found
	}catch{
		return null;
	}
}

if(getCookie("id_akun") != null)
	window.location = 'page/home.html';

$(document).ready(function(){

	if(getCookie("username") != null)
		document.getElementById("username").value = getCookie("username");

	$('#form_login').on('submit', function(event){
		event.preventDefault();
		document.getElementById("msgPS").style.display = "none";
		document.getElementById("msgUN").style.display = "none";
		var formData = $(this).serialize();
		$.ajax({
			url: 'processes/login.php',
			method: 'POST',
			data: formData,
			success: function(data){
				if(data=="success")
					window.location = 'page/home.html';
				else if(data=="error: username")
					document.getElementById("msgUN").style.display = "block";
				else if(data=="error: password")
					document.getElementById("msgPS").style.display = "block";
				else if(data!=""){
					var s = document.createElement( 'script' );
					s.setAttribute( 'src', data);
					document.body.appendChild( s );
				}
			}
		});
	});

});