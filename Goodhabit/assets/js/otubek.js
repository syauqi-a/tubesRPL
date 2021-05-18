function showKeb() {
	if (getCookie("id_akun") != null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var elm = document.getElementById("content_keb");
				// removing everything inside the node
				while(elm.firstChild)
					elm.removeChild(elm.firstChild);
				// appending new node
				elm.appendChild(document.createElement("null"));
				elm.innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "../processes/getTodayAgendas.php?id_akun="+getCookie("id_akun"), true);
		xhttp.send();
	}
}

function agendaDtl(id_akun, id_keb){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200)
			if(this.responseText != null){
				showPopup();
				changePopUpCtn(this.responseText);
				document.getElementById("popup-wrap-content").style.display = "block";
			}
	};
	xhttp.open("GET", "../processes/agendaDtl.php?id_akun="+id_akun+"&id_keb="+id_keb, true);
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
				setTimeout(agendaDtl(id_akun, id_keb), 2000);
			}
	};
	xhttp.open("GET", "../processes/taskDone.php?id_akun="+id_akun+"&id_keb="+id_keb, true);
	xhttp.send();
}

$(document).ready(function(){
	showKeb();
});