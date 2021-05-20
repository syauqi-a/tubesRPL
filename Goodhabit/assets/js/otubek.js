function showKeb() {
	if (getCookie("id_akun") != null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(this.responseText != ""){
					var elm = document.getElementById("content_keb");
					// removing everything inside the node
					while(elm.firstChild)
						elm.removeChild(elm.firstChild);
					// appending new node
					elm.appendChild(document.createElement("null"));
					elm.innerHTML = this.responseText;
				}
			}
		};
		xhttp.open("GET", "../processes/getTodayAgendas.php?id_akun="+getCookie("id_akun"), true);
		xhttp.send();
	}
}

function showRecomnd(){
	if (getCookie("id_akun") != null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(this.responseText != ""){
					var elm = document.getElementById("content_recomnd");
					// removing everything inside the node
					while(elm.firstChild)
						elm.removeChild(elm.firstChild);
					// appending new node
					elm.appendChild(document.createElement("null"));
					elm.innerHTML = this.responseText;
				}
			}
		};
		xhttp.open("GET", "../processes/getRecomnd.php?id_akun="+getCookie("id_akun"), true);
		xhttp.send();
	}
}

function getPoint(){
	if (getCookie("id_akun") != null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("points").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "../processes/getPoints.php?id_akun="+getCookie("id_akun"), true);
		xhttp.send();
	}
}

function agendaDtl(id_akun, id_keb, clg=false){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200)
			if(this.responseText != null){
				showPopup();
				changePopUpCtn(this.responseText);
				document.getElementById("popup-wrap-content").style.display = "block";
			}
	};
	xhttp.open("GET", "../processes/agendaDtl.php?id_akun="+id_akun+"&id_keb="+id_keb+"&clg="+clg, true);
	xhttp.send();
}

function taskDone(id_akun, id_keb){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) 
			if(this.responseText == "success"){
				showSuccess();
				setTimeout(closePopup, 2000);
				showKeb();
			}
			else{
				showFailed();
				setTimeout(()=>{agendaDtl(id_akun, id_keb)}, 2000);
			}
	};
	xhttp.open("GET", "../processes/taskDone.php?id_akun="+id_akun+"&id_keb="+id_keb, true);
	xhttp.send();
}

function uploadProof(){
	var proof = document.getElementById('fupload');
	proof.click();
	var chekProof = setInterval(()=>{
		if(proof.files.length != 0){
			clearInterval(chekProof);
			document.getElementById("btn-upload-proof").classList.remove('bg-blue');
			document.getElementById("btn-upload-proof").classList.add('bg-green');
			document.getElementById("btn-task-done").style.cursor = "pointer";
			document.getElementById("btn-task-done").disabled = false;
		}
	}, 500);
}

function clgDone(event, id_akun, id_keb){
		event.preventDefault();
		var form = $('#upload-proof')[0];
		var data = new FormData(form);
		$('#btn-task-done').prop("disabled", true);
		$.ajax({
			type: 'POST',
			method: 'POST',
			enctype: 'multipart/form-data',
			url: '../processes/clgDone.php',
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 600000,
			success: function(data){
				if(data == "success"){
					showSuccess();
					getPoint();
					setTimeout(closePopup, 2000);
				}
				else{
					if(data == "error: size")
						showFailed("File size is too large!<br/>(max: 1MB)");
					else
						showFailed();
					setTimeout(()=>{agendaDtl(id_akun, id_keb, true)}, 2000);
				}
				
				showKeb();
				$('#btn-task-done').prop("disabled", false);
			},
			error: function(e){
				showFailed();
				$('#btn-task-done').prop("disabled", false);
				setTimeout(closePopup, 2000);
			}
		});
}

function recomndDtl(id_akun, id_keb){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200)
			if(this.responseText != null){
				showPopup();
				changePopUpCtn(this.responseText);
				document.getElementById("popup-wrap-content").style.display = "block";
			}
	};
	xhttp.open("GET", "../processes/recomndDtl.php?id_akun="+id_akun+"&id_keb="+id_keb, true);
	xhttp.send();
}

function addRecomnd(id_akun, id_keb){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText == "success"){
				showSuccess("Habit added");
				setTimeout(closePopup, 2000);
				showKeb();
			}
			else{
				showFailed();
				setTimeout(closePopup, 2000);
			}
		}
	};
	xhttp.open("GET", "../processes/addRecomnd.php?id_akun="+id_akun+"&id_keb="+id_keb, true);
	xhttp.send();
}

$(document).ready(function(){
	showKeb();
	showRecomnd();
	getPoint();
});