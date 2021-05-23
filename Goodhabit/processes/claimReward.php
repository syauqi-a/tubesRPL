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

// list nama-nama bulan
$months = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

if(isset($_COOKIE['id_akun'])){
	if(isset($_GET['claim'])){
		if($oHadiah->claim($_COOKIE['id_akun'], (($_GET['period'] == "") ? date("Y-m") : $_GET['period'])))
			echo "success";
		else 
			echo "failed";
	}
	else if(isset($_GET['details'])){
		if(mysqli_num_rows($oHadiah->getRecord($_COOKIE['id_akun'], (($_GET['period'] == "") ? date("Y-m") : $_GET['period']))) > 0){
			while($result = $oHadiah->getResult()){
				echo "<div class='card-header bg-transparent'>
						<div class='row align-items-center'>
						  <div class='col'>
							<h3 class='h2 mb-0 text-center'><b>Reward</b></h5>
						  </div>
						</div>
					  </div>
					  <div class='card-body h3 text-dark'>
						<h2 class='text-center'>Congratulations you are the winner of this month period</h2>
						<div class='container p-2 pl-3 mb-2' style='border: 2px solid blue; border-radius: 10px;'>
						  <h1 class=' bold text-center' style='color: blue'>{$result['nama_hadiah']}</h1>
						  <h2 class='text-center'>code: {$result['kode_hadiah']}</h2>
						</div>
						<div style='text-align: center;'>
						  <button type='button' class='btn btn-lg  text-white ".(($result['claim'] == "y") ? "bg-success'" : "bg-light' disabled")." style='border-radius: 50px; ".(($result['claim'] == "y") ? "' onclick='claimReward(\"{$result['period']}\")'" : "cursor: not-allowed'").">".
							(($result['claim'] == "y") ? "CLAIM" : "CLAIMED").
						  "</button>
						</div>
					  </div>";
			}
		}else
			echo "failed";
	}
}
else
	echo "failed";
// Menutup koneksi database
$oHadiah->close();

?>