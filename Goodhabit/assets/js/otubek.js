function showKeb() {
	if (getCookie("id_akun") != null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var elm = document.getElementById("content_keb");
				// removing everything inside the node
				while(elm.firstChild)
					elm.removeChild(elm.firstChild);
				// appending new text node
				elm.appendChild(document.createElement("null"));
				elm.innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "../processes/getTodayAgendas.php?id_akun="+getCookie("id_akun"), true);
		xhttp.send();
	}
}
$(document).ready(function(){
	showKeb();
});