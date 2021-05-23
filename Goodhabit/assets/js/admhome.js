window.onload=function(){
	// get list period
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200)
			if(this.responseText == "failed")
				console.log("Failed get list period: "+this.responseText);
			else
				document.getElementById("list-periods").innerHTML = this.responseText;
	};
	xhttp.open("POST", "../processes/getListPeriod.php", true);
	xhttp.send();
	// get summary
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200)
			if(this.responseText != ""){
				var obj = JSON.parse(this.responseText);
				document.getElementById("jmlUser").innerHTML = (obj.jmlUser == null) ? 0 : obj.jmlUser;
				document.getElementById("jmlChlg").innerHTML = (obj.jmlChlg == null) ? 0 : obj.jmlChlg;
				document.getElementById("jmlRecm").innerHTML = (obj.jmlRecm == null) ? 0 : obj.jmlRecm;
				document.getElementById("jmlReward").innerHTML = (obj.jmlReward == null) ? 0 : obj.jmlReward;
			}
	};
	xhttp.open("POST", "../processes/getSummaryAdm.php", true);
	xhttp.send();
}

// menampilkan leaderboar
function showLeaderboard(period = ""){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			var obj = JSON.parse(this.responseText);
			if(obj != null){
				document.getElementById("content-leaderboard").innerHTML = obj.lb;
			}
			else{
				document.getElementById("content-leaderboard").innerHTML = "<div style='text-align:center;'><i class='far fa-frown' style='font-size: 4rem;'></i><h4 style='margin-top:8px;'>No leaderboard data for this period</h4></div>";
			}
		}
	};
	xhttp.open("POST", "../processes/getLeaderboard.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("period="+period);
}

$(document).ready(function(){
	// menampilkan leaderboar berdasarkan periode yang dipilih
	showLeaderboard();
	$('#list-periods').change(function(){
		//console.log($(this).find(":selected").val());
		showLeaderboard($(this).find(":selected").val());
	});
	// menampilkan tanggal
	if(document.getElementById("dateNow") != null){
		var day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
		var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		var d = new Date();
		document.getElementById("dateNow").innerHTML = "<b>"+day[d.getDay()]+"</b> "+d.getDate()+" "+month[d.getMonth()]+" "+d.getFullYear();
	}
});