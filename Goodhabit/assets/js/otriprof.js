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
				document.getElementById("profilebig").src = (obj.photo == null) ? "../assets/img/theme/dummy-man.png" : "../assets/uploads/p-profiles/"+obj.photo ;
			}
		}
	};
	xhttp.open("GET", "../processes/getProfil.php?id_akun="+getCookie("id_akun"), true);
	xhttp.send();
}

function changePhoto(){
	document.getElementById('fphoto').click();
}

function savePhoto(){
	if(document.getElementById('fphoto').files.length != 0)
		document.getElementById('save-photo').click();
}

function submitPhoto(e, id_akun){
	event.preventDefault();
	var form = $('#form-photo')[0];
	var data = new FormData(form);
	data.append("id_akun", id_akun);
	$.ajax({
		type: 'POST',
		method: 'POST',
		enctype: 'multipart/form-data',
		url: '../processes/savePhoto.php',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		timeout: 600000,
		success: function(data){
			if(data == "success"){
				showSuccess();
				showAccount();
				getProfil();
				setTimeout(()=>{document.getElementById('edit-profile').click();}, 1000);
			}
			else{
				if(data == "error: size")
					showFailed("File size is too large!<br/>(max: 1MB)");
				else
					showFailed();
				setTimeout(()=>{document.getElementById('edit-profile').click();}, 1000);
			}
		},
		error: function(e){
			showFailed();
			setTimeout(()=>{document.getElementById('edit-profile').click();}, 1000);
		}
	});
}

function updateProfile(event, id_akun){
	event.preventDefault();
	var form = $('#form-edit')[0];
	var data = new FormData(form);
	$('#btn-update').prop("disabled", true);
	$.ajax({
		url: '../processes/updateProfile.php',
		method: 'POST',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		timeout: 600000,
		success: function(data){
			if(data=="success"){
				showSuccess("Your account has been updated successfully");
				getProfil();
			}
			else 
				showFailed("Failed to update account");
			setTimeout(closePopup, 1000);
			$('#btn-update').prop("disabled", false);
		},
		error: function(e){
			showFailed();
			setTimeout(closePopup, 2000);
		}
	});
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