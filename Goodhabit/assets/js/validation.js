$(document).ready(function(){
	if(getCookie("id_akun") == 1)
		window.location = 'admin/home.html';
	else
		window.location = 'login.html';
});