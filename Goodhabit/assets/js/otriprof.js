function getProfil(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText != ""){
				var obj = JSON.parse(this.responseText);
				document.getElementById("p-username").innerHTML = "<b>"+obj.username+"</b>";
				document.getElementById("p-gender").innerHTML = "<b>"+obj.gender+"</b>";
				document.getElementById("p-email").innerHTML = "<b>"+obj.email+"</b>";
				document.getElementById("p-phone").innerHTML = "<b>"+((obj.phone == "") ? "-" : obj.phone)+"</b>";
				document.getElementById("p-address").innerHTML = "<b>"+((obj.address == "") ? "-" : obj.address)+"</b>";
				document.getElementById("p-h-created").innerHTML = obj.jmlHabit;
				document.getElementById("p-h-completed").innerHTML = obj.jmlRecHab;
				document.getElementById("p-c-completed").innerHTML = obj.jmlRecClg;
			}
		}
	};
	xhttp.open("GET", "../processes/getProfil.php?id_akun="+getCookie("id_akun"), true);
	xhttp.send();
}

function deleteAcc(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText == "success"){
				showSuccess("Request to delete account was successful. Your account has been successfully deleted.");
				setInterval(()=>{if(document.getElementById("popup-bg").style.display == "none") logout();}, 500);
				setTimeout(logout, 6000);
			}else showFailed("Request to delete account failed. Failed to delete your account.");
			setTimeout(closePopup, 2000);
		}
	};
	xhttp.open("GET", "../processes/deleteAcc.php?id_akun="+getCookie("id_akun"), true);
	xhttp.send();
}

// function to request confirmation of deleting the account
confirmDelAcc = () => {
	showPopup();
	changePopUpCtn("<div style='text-align: center; margin: 24px;'><button type='button' class='btn icon icon-shape bg-warning text-white rounded-circle shadow' style='margin: 0 0 10px 0;' ><i class='fa fa-question text-black' style='font-size: 2rem;'></i></button><br><h2>Are you sure you want to delete your account?</h2><div class='container-fluid'><div class='row'><div class='col'><button type='button' class='btn btn-lg bg-red text-white ' style='border-radius: 50%; width: 60px;' onclick='deleteAcc()'>Yes</button></div><div class='col'><button type='button' class='btn btn-lg bg-green text-white ' style='border-radius: 50%; width: 60px;' onclick='closePopup()'>No</button></div></div></div></div>");
}

$(document).ready(function(){
	getProfil();
	document.getElementById("edit-profile").onclick = () => {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				showPopup();
				if(this.responseText == "failed"){
					showFailed();
					setTimeout(closePopup, 2000);
				}else{
					changePopUpCtn(this.responseText);
				}
			}
		};
		xhttp.open("GET", "../processes/editProfil.php?id_akun="+getCookie("id_akun"), true);
		xhttp.send();
	};
});