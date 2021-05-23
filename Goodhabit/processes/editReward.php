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
include("../includes/Akun.class.php");
include("../includes/Hadiah.class.php");

// Membuat objek dari kelas hadiah
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);
$oHadiah = new Hadiah($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();
$oHadiah->open();

if(isset($_COOKIE['id_akun'])){
	if(mysqli_num_rows($oHadiah->getRecord($_COOKIE['id_akun'], "", $_GET['id'])) > 0){
		$result = $oHadiah->getResult();
		// ambil nilai periode
		$period = explode("-", $result['period']);
		// ambil data user
		$oAkun->getRecord();
		$optAcc = null;
		while($res = $oAkun->getResult()){
			$optAcc .= "<option value='{$res['id_akun']}' ".(($result['id_akun'] == $res['id_akun']) ? "selected hidden" : "").">{$res['username']}</option>";
		}
		echo "<div class='card-header bg-transparent'>
				<div class='row align-items-center'>
				  <div class='col'>
					<h3 class='h2 mb-0 text-center'><b>Edit Reward</b></h5>
				  </div>
				</div>
			  </div>
			  <div class='card-body h3 text-dark'>
				<form id='form-edit'>
				  <div class='form-group'>
					<label for='name' class='form-control-label' style='padding-left: 22px;'>Name</label>
					<div style='text-align: center;'>
					  <input class='form-control' type='text' value='{$result['nama_hadiah']}' name='name'>
					</div>
				  </div>
				  <div class='form-group'>
					<label for='description' class='form-control-label' style='padding-left: 22px;'>Description</label>
					<div style='text-align: center;'>
					  <textarea class='form-control' name='desc' rows='2'>{$result['deskripsi']}</textarea>
					</div>
				  </div>
				  <div class='form-group'>
					<label for='code' class='form-control-label' style='padding-left: 22px;'>Code</label>
					<div style='text-align: center;'>
					  <input class='form-control' type='text' value='{$result['kode_hadiah']}' name='code'>
					</div>
				  </div>
				  <div class='form-group'>
					<label class='form-control-label' style='padding-left: 22px;'>Periode</label>
					<div style='text-align: center;'>
					  <input class='form-control' type='month' value='$period[0]-$period[1]' name='period'>
					</div>
				  </div>
				  <div class='form-group'>
					<label class='form-control-label' style='padding-left: 22px;'>Send to</label>
					<div style='text-align: center;'>
					  <select class='form-control form-control-sm' id='receiver' name='receiver' style='height: 46px;' required>
						$optAcc
					  </select>
					</div>
				  </div>
				  <div class='form-group row pt-3 vercenter'>
					<input type='submit' value='Update' class='btn btn-success bdr-round mx-auto' id='btn-update' onclick='updateReward(event, {$result['id_hadiah']})'>
					<input type='reset' value='Reset' class='btn btn-danger bdr-round mx-auto'>
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
$oAkun->close();
$oHadiah->close();

?>