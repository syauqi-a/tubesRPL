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
include("../includes/Hadiah.class.php");
date_default_timezone_set("Asia/Jakarta");

// Membuat objek dari kelas hadiah
$oHadiah = new Hadiah($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oHadiah->open();

if(isset($_COOKIE['id_akun'])){
	$id_akun = $_COOKIE['id_akun'];
	echo "<div class='card-header bg-transparent'>
			<div class='row align-items-center'>
			  <div class='col'>
				<h3 class='h2 mb-0 text-center'><b>Add Reward</b></h5>
			  </div>
			</div>
		  </div>
		  <div class='card-body h3 text-dark'>
			<form id='form-add'>
			  <input type='text' name='id_akun' value=$id_akun hidden/>
			  <div class='form-group'>
				<label for='name' class='form-control-label' style='padding-left: 22px;'>Name</label>
				<div style='text-align: center;'>
				  <input class='form-control' type='text' name='name' required>
				</div>
			  </div>
			  <div class='form-group'>
				<label for='description' class='form-control-label' style='padding-left: 22px;'>Description</label>
				<div style='text-align: center;'>
				  <textarea class='form-control' name='desc' rows='2'></textarea>
				</div>
			  </div>
			  <div class='form-group'>
				<label for='code' class='form-control-label' style='padding-left: 22px;'>Code</label>
				<div style='text-align: center;'>
				  <input class='form-control' type='text' name='code' required>
				</div>
			  </div>
			  <div class='form-group'>
				<label class='form-control-label' style='padding-left: 22px;'>Periode</label>
				<div style='text-align: center;'>
				  <input class='form-control' type='month' name='period' value='".(date('Y-m'))."' required />
				</div>
			  </div>
			  <div class='form-group row pt-3 vercenter'>
				<input type='submit' value='Submit' class='btn btn-success bdr-round mx-auto' id='btn-add' onclick='addReward(event)'>
			  </div>
			</form>
		  </div>";
}
else 
	echo "failed";

// Menutup koneksi database
$oHadiah->close();

?>