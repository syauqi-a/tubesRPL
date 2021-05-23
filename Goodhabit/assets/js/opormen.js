function showHabbit(sbStatus='', key='', sbTime=''){
	if (getCookie("id_akun") != null) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200){
				if(this.responseText != ""){
					var elm = document.getElementById("content-habit");
					// removing everything inside the node
					while(elm.firstChild)
						elm.removeChild(elm.firstChild);
					// appending new node
					elm.appendChild(document.createElement("null"));
					elm.innerHTML = this.responseText;
				}
			}
		};
		xhttp.open("GET", "../processes/getHabit.php?key="+key+"&sortByTime="+sbTime+"&status="+sbStatus, true);
		xhttp.send();
	}
}

function editHabit(id_keb){
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
	xhttp.open("GET", "../processes/editHabit.php?id_keb="+id_keb, true);
	xhttp.send();
}

function getOptions(){
	var repeat = document.getElementById("repeat").value;
	if(repeat == "tiap minggu"){
		var opt;
		var day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
		day.forEach((d)=>{
			opt += "<option value='"+d+"'>"+d+"</option>";
		});

		document.getElementById("options").innerHTML = "<div class='form-group'><label class='form-control-label' style='padding-left: 22px;'>Select a day</label><br><div style='text-align: center;'><select class='form-control form-control-sm' name='option' style='height: 46px;' required>"+opt+"</select><br></div></div>";
	}
	else if(repeat == "tiap bulan"){
		document.getElementById("options").innerHTML = "<div class='form-group'><label class='form-control-label' style='padding-left: 22px;'>Select a date</label><br><div style='text-align: center;'><input class='form-control' type='number' min='1' max='31' value='1' name='option' required><br></div></div>";
	}
	else document.getElementById("options").innerHTML = "";
}

function updateHabit(event, id_keb){
	event.preventDefault();
	var form = $('#form-edit')[0];
	var data = new FormData(form);
	data.append("id_keb", id_keb);
	$('#btn-update').prop("disabled", true);
	$.ajax({
		url: '../processes/updateHabit.php',
		method: 'POST',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		timeout: 600000,
		success: function(data){
			if(data=="success"){
				showHabbit((($('#sb-status').val()!=null) ? $('#sb-status').val() : "pribadi"));
				showSuccess("Your habit has been updated successfully");
			}
			else 
				showFailed("Failed to update habit");
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
confirmDelHabit = (id_keb, name) => {
	showPopup();
	changePopUpCtn("<div style='text-align: center; margin: 24px;'><button type='button' class='btn icon icon-shape bg-warning text-white rounded-circle shadow' style='margin: 0 0 10px 0;' ><i class='fa fa-question text-black' style='font-size: 2rem;'></i></button><br><h2>Are you sure you want to delete habit \""+name+"\" ?</h2><div class='container-fluid'><div class='row'><div class='col'><button type='button' class='btn btn-lg bg-red text-white ' style='border-radius: 50%; width: 60px;' onclick='deleteHabit("+id_keb+", \""+name+"\")'>Yes</button></div><div class='col'><button type='button' class='btn btn-lg bg-green text-white ' style='border-radius: 50%; width: 60px;' onclick='closePopup()'>No</button></div></div></div></div>");
}

function deleteHabit(id_keb, name){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			if(this.responseText == "success"){
				showHabbit((($('#sb-status').val()!=null) ? $('#sb-status').val() : "pribadi"));
				showSuccess("Habit '\""+name+"\"' successfully removed");
			}else
				showFailed("Habbit '\""+name+"\"' failed to remove");
			setTimeout(closePopup, 2000);
		}
	};
	xhttp.open("GET", "../processes/deleteHabit.php?id_keb="+id_keb, true);
	xhttp.send();
}

function addHabit(event){
	event.preventDefault();
	var form = $('#form-add')[0];
	var data = new FormData(form);
	data.append("status", "pribadi");
	$('#btn-add').prop("disabled", true);
	$.ajax({
		url: '../processes/addHabit.php',
		method: 'POST',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		timeout: 600000,
		success: function(data){
			if(data=="success"){
				showHabbit((($('#sb-status').val()!=null) ? $('#sb-status').val() : "pribadi"));
				showSuccess("Your habit has been added successfully");
			}
			else 
				showFailed("Failed to add habit");
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
	showHabbit((($('#sb-status').val()!=null) ? $('#sb-status').val() : "pribadi"));
	// reset tampilan
	$('#btn-reset').click(function(){
		document.getElementById("sb-time").innerHTML = "<option  value='' hidden>Time</option><option value='ASC'>↑ Time</option><option value='DESC'>↓ Time</option>";
		$('#input-search').val("");
		if($('#sb-status').val()!=null) $('#sb-status').val("");
		showHabbit((($('#sb-status').val()!=null) ? $('#sb-status').val() : "pribadi"));
	});
	// urutkan kebiasaan berdasarkan waktu ketika nilai tag select berubah
	$('#sb-time').change(function(){
		showHabbit((($('#sb-status').val()!=null) ? $('#sb-status').val() : "pribadi"), $('#input-search').val(), $(this).find(":selected").val());
	});
	// menampilkan kebiasaan berdasarkan kata kunci ketika ada masukan
	$('#input-search').keyup(function(){
		showHabbit((($('#sb-status').val()!=null) ? $('#sb-status').val() : "pribadi"), $(this).val(), $('#sb-time').find(":selected").val());
	});
	// menampilkan berdasarkan kata status kebiasaan yang dipilih
	if($('#sb-status').val()!=null) $('#sb-status').change(function(){
		showHabbit($(this).find(":selected").val(), $('#input-search').val(), $('#sb-time').find(":selected").val());
	});
	// menambahkan kebiasaan baru ketika tombol add habit ditekan
	$('#btn-add-habit').click(function(){
		showPopup();
		changePopUpCtn("<div class='card-header bg-transparent'><div class='row align-items-center'><div class='col'><h3 class='h2 mb-0 text-center'><b>Add Habit</b></h5></div></div></div><div class='card-body h3 text-dark'><form id='form-add'><div class='form-group'><label for='nama_keb' class='form-control-label' style='padding-left: 22px;'>Name</label><br><div style='text-align: center;'><input class='form-control' type='text' name='nama_keb' required><br></div></div><div class='form-group'><label for='desc' class='form-control-label' style='padding-left: 22px;'>Description</label><br><div style='text-align: center;'><textarea class='form-control' name='desc' rows='3' ></textarea><br></div></div>"+(($('#sb-status').val()!=null) ? "<div class='form-group'><label class='form-control-label' style='padding-left: 22px;'>Tag</label><br><div style='text-align: center;'>  <select class='form-control form-control-sm' id='tag' name='tag' style='height: 46px;' required><option value='challenge' '.(($result['status_kebiasaan'] == 'challenge') ? 'selected' : '').'>Challenge</option><option value='rekomendasi' '.(($result['status_kebiasaan'] == 'rekomendasi') ? 'selected' : '').'>Reccomendation</option>  </select></div>  </div>" : "")+"<div class='form-group'><label for='time' class='form-control-label' style='padding-left: 22px;'>Time</label><br><div style='text-align: center;'><input class='form-control' type='time' name='time' required><br></div></div><div class='form-group'><label class='form-control-label' style='padding-left: 22px;'>Repeat</label><br><div style='text-align: center;'><select class='form-control form-control-sm' id='repeat' name='repeat' style='height: 46px;' onchange='getOptions()' required><option value='tiap hari'>Daily</option><option value='tiap minggu'>Weekly</option><option value='tiap bulan'>Monthly</option></select><br></div></div><div id='options'></div><div class='form-group'><div class='row pt-3 vercenter'><input type='submit' value='Submit' class='btn btn-success bdr-round mx-auto' id='btn-add' onclick='addHabit(event)'></div></div></form></div>");
	});
});