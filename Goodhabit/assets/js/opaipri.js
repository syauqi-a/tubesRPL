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
}

// menampilkan leaderboar
function showLeaderboard(period = ""){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			var obj = JSON.parse(this.responseText);
			if(obj != null){
				var x = ["th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th"];
				if(obj.uRank != null)
					if((obj.uRank > 3) && (obj.uRank < 21)){
						obj.uRank += "th";
					}else{
						obj.uRank += x[(obj.uRank % 10)];
					}
				document.getElementById("content-leaderboard").innerHTML = obj.lb;
				document.getElementById("u-point").innerHTML = (obj.uPoint == null) ? "0" : obj.uPoint;
				document.getElementById("u-rank").innerHTML = (obj.uRank == null) ? "-" : obj.uRank;
				if(obj.claim != null){
					if(obj.claim == "ongoing")
						document.getElementById("claim").innerHTML = "<h3 class='text-black text-center'>This period is still ongoing</h3>";
					else if(obj.claim == "soon")
						document.getElementById("claim").innerHTML = "<h3 class='text-black text-center'>This period is about to start</h3>";
					else if(obj.claim == "pending")
						document.getElementById("claim").innerHTML = "<h3 class='text-black text-center'>Your prize will be sent manually by admin, please be patient</h3>";
					else if(obj.claim == "y")
						document.getElementById("claim").innerHTML = "<h3 class='text-black text-center'>Congratulations you're the winner of this month period</h3><button type='button' class='btn btn-lg bg-success text-white ' style='border-radius: 50px;' onclick='rewardDtl(\""+obj.period+"\")'>CLAIM REWARD</button>";
					else if(obj.claim == "n")
						document.getElementById("claim").innerHTML = "<h3 class='text-black text-center'>Congratulations you're the winner of this month period</h3><button type='button' class='btn btn-lg bg-success text-white ' style='border-radius: 50px;' onclick='rewardDtl(\""+obj.period+"\")'>CLAIM REWARD</button>";
				}
				else{
					document.getElementById("claim").innerHTML = "<h3 class='text-black text-center'>Sorry, you aren't the winner of this month's period</h3>";
				}
			}
			else{
				document.getElementById("content-leaderboard").innerHTML = "<div style='text-align:center;'><i class='far fa-frown' style='font-size: 4rem;'></i><h4 style='margin-top:8px;'>No leaderboard data for this period</h4></div>";
				document.getElementById("u-point").innerHTML = "0";
				document.getElementById("u-rank").innerHTML = "-";
				document.getElementById("claim").innerHTML = "";
			}
		}
	};
	xhttp.open("POST", "../processes/getLeaderboard.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("period="+period);
}

function rewardDtl(period){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			showPopup();
			if(this.responseText == "failed"){
				showFailed();
				setTimeout(closePopup, 2000);
			}else{
				changePopUpCtn(this.responseText);
			}
		}
	};
	xhttp.open("GET", "../processes/claimReward.php?period="+period+"&details=true", true);
	xhttp.send();
}

function claimReward(period){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			if(this.responseText == "success"){
				showSuccess();
			}else{
				showFailed();
			}
			setTimeout(()=>{rewardDtl(period)}, 2000);
		}
	};
	xhttp.open("GET", "../processes/claimReward.php?period="+period+"&claim=true", true);
	xhttp.send();
}

$(document).ready(function(){
	// menampilkan leaderboar berdasarkan periode yang dipilih
	showLeaderboard();
	$('#list-periods').change(function(){
		//console.log($(this).find(":selected").val());
		showLeaderboard($(this).find(":selected").val());
	});
});