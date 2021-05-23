function showReward(key=''){
	if (getCookie("id_akun") != null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				if(this.responseText != ""){
					var elm = document.getElementById("content-reward");
					// removing everything inside the node
					while(elm.firstChild)
						elm.removeChild(elm.firstChild);
					// appending new node
					elm.appendChild(document.createElement("null"));
					elm.innerHTML = this.responseText;
				}
			}
		};
		xhttp.open("GET", "../processes/getReward.php?key="+key, true);
		xhttp.send();
	}
}

function editReward(id){
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
	xhttp.open("GET", "../processes/editReward.php?id="+id, true);
	xhttp.send();
}

function updateReward(event, id){
	event.preventDefault();
	var form = $('#form-edit')[0];
	var data = new FormData(form);
	data.append("id_hadiah", id);
	$('#btn-update').prop("disabled", true);
	$.ajax({
		url: '../processes/updateReward.php',
		method: 'POST',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		timeout: 600000,
		success: function(data){
			if(data=="success"){
				showReward();
				showSuccess("Reward has been updated successfully");
			}
			else 
				showFailed("Failed to update reward");
			setTimeout(closePopup, 1000);
			$('#btn-update').prop("disabled", false);
		},
		error: function(e){
			showFailed();
			setTimeout(closePopup, 2000);
		}
	});
}

// function to request confirmation of deleting the habit
confirmDelRwd = (id, name) => {
	showPopup();
	changePopUpCtn("<div style='text-align: center; margin: 24px;'><button type='button' class='btn icon icon-shape bg-warning text-white rounded-circle shadow' style='margin: 0 0 10px 0;' ><i class='fa fa-question text-black' style='font-size: 2rem;'></i></button><br><h2>Are you sure you want to delete reward \""+name+"\" ?</h2><div class='container-fluid'><div class='row'><div class='col'><button type='button' class='btn btn-lg bg-red text-white ' style='border-radius: 50%; width: 60px;' onclick='deleteReward("+id+", \""+name+"\")'>Yes</button></div><div class='col'><button type='button' class='btn btn-lg bg-green text-white ' style='border-radius: 50%; width: 60px;' onclick='closePopup()'>No</button></div></div></div></div>");
}

function deleteReward(id, name){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			if(this.responseText == "success"){
				showReward();
				showSuccess("Reward '\""+name+"\"' successfully removed");
			}else
				showFailed("Reward '\""+name+"\"' failed to remove");
			setTimeout(closePopup, 2000);
		}
	};
	xhttp.open("GET", "../processes/deleteReward.php?id="+id, true);
	xhttp.send();
}

function addReward(event){
	event.preventDefault();
	var form = $('#form-add')[0];
	var data = new FormData(form);
	$('#btn-add').prop("disabled", true);
	$.ajax({
		url: '../processes/addReward.php',
		method: 'POST',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		timeout: 600000,
		success: function(data){
			if(data=="success"){
				showReward();
				showSuccess("New reward added successfully");
			}
			else 
				showFailed("Failed to add new reward");
			setTimeout(closePopup, 2000);
			$('#btn-add').prop("disabled", false);
		},
		error: function(e){
			showFailed();
			setTimeout(closePopup, 2000);
		}
	});
}

$(document).ready(function(){
	showReward();
	// menampilkan hadiah berdasarkan kata kunci ketika ada masukan
	$('#input-search').keyup(function(){
		showReward($(this).val());
	});
	// menambahkan hadiah baru ketika tombol add reward ditekan
	$('#btn-add-reward').click(function(){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				showPopup();
				if(this.responseText == "failed"){
					showFailed();
					setTimeout(closePopup, 2000);
				}else
					changePopUpCtn(this.responseText);
			}
		};
		xhttp.open("GET", "../processes/reqAddReward.php?", true);
		xhttp.send();
	});
});