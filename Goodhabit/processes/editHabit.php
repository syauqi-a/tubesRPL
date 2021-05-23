<?php

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/

include("../includes/conf.php");
include("../includes/DB.class.php");
include("../includes/Kebiasaan.class.php");

// Membuat objek dari kelas kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();

if(isset($_COOKIE['id_akun'])){
	if(mysqli_num_rows($oKebiasaan->getRecord($_COOKIE['id_akun'], $_GET['id_keb'])) > 0){
		$result = $oKebiasaan->getResult();
		$opt = null;
		$day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
		foreach($day as $d){
			$opt .= "<option value='$d' ".(($result['ket'] == $d) ? "selected" : "").">$d</option>";
		}
		echo "<div class='card-header bg-transparent'>
				<div class='row align-items-center'>
				  <div class='col'>
					<h3 class='h2 mb-0 text-center'><b>Edit Habit</b></h5>
				  </div>
				</div>
				</div>
			  <div class='card-body h3 text-dark'>
				<form id='form-edit'>
				  <div class='form-group'>
					<label for='nama_keb' class='form-control-label' style='padding-left: 22px;'>Name</label>
					<div style='text-align: center;'>
					  <input class='form-control' type='text' value='{$result['nama_kebiasaan']}' name='nama_keb' required>
					</div>
				  </div>
				  <div class='form-group'>
					<label for='desc' class='form-control-label' style='padding-left: 22px;'>Description</label>
					<div style='text-align: center;'>
					  <textarea class='form-control' name='desc' rows='2' >{$result['deskripsi']}</textarea>
					</div>
				  </div>".(($result['status_kebiasaan'] != 'pribadi') ? "<div class='form-group'>
					<label class='form-control-label' style='padding-left: 22px;'>Tag</label>
					<div style='text-align: center;'>
					  <select class='form-control form-control-sm' id='tag' name='tag' style='height: 46px;' required>
						<option value='challenge' ".(($result['status_kebiasaan'] == 'challenge') ? "selected" : "").">Challenge</option>
						<option value='rekomendasi' ".(($result['status_kebiasaan'] == 'rekomendasi') ? "selected" : "").">Reccomendation</option>
					  </select>
					</div>
				  </div>" : "")."
				  <div class='form-group'>
					<label for='time' class='form-control-label' style='padding-left: 22px;'>Time</label>
					<div style='text-align: center;'>
					  <input class='form-control' type='time' value='{$result['waktu']}' name='time' required>
					</div>
				  </div>
				  <div class='form-group'>
					<label class='form-control-label' style='padding-left: 22px;'>Repeat</label>
					<div style='text-align: center;'>
					  <select class='form-control form-control-sm' id='repeat' name='repeat' style='height: 46px;' required onchange='getOptions()'>
						<option value='tiap hari' ".(($result['ulang'] == "tiap hari") ? "selected" : "").">Daily</option>
						<option value='tiap minggu' ".(($result['ulang'] == "tiap minggu") ? "selected" : "").">Weekly</option>
						<option value='tiap bulan' ".(($result['ulang'] == "tiap bulan") ? "selected" : "").">Monthly</option>
					  </select>
					</div>
				  </div>
				  <div id='options'>".
				  (($result['ulang'] == "tiap minggu") ? "<div class='form-group'><label class='form-control-label' style='padding-left: 22px;'>Select a day</label><div style='text-align: center;'><select class='form-control form-control-sm' id='option' name='option' style='height: 46px;' required>$opt</select></div></div>" : (($result['ulang'] == "tiap bulan") ? "<div class='form-group'><label class='form-control-label' style='padding-left: 22px;'>Select a date</label><div style='text-align: center;'><input class='form-control' type='number' min='1' max='31' value='{$result['ket']}' id='option' name='option'></div></div>" : "")).
				  "</div>
				  <div class='form-group row pt-3 vercenter'>
					<input type='submit' value='Update' class='btn btn-success bdr-round mx-auto' id='btn-update' onclick='updateHabit(event, {$result['id_kebiasaan']})'>
				  </div>
				</form>
			  </div>";
	}
	else
		echo "failed";
}
else 
	echo "failed";

// Menutup koneksi database
$oKebiasaan->close();

?>