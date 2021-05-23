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
				echo "<div style='text-align: center; margin: 24px;'>
						<h1 class='text-success'><b>REWARD</b></h1>
						<h2><b>Congratulations you're the winner of this month period</b></h2>
						<div class='container mb-2 bdr-round' style='border: solid blue;'>
						<span style='font-size: 32px; color: blue;'><b>{$result['nama_hadiah']}</b></span><br/>
						<span style='font-size: 20px; color: black;'><b>code : {$result['kode_hadiah']}</b></span>
						</div>
						<button type='button' class='btn btn-lg  text-white ".(($result['claim'] == "y") ? "bg-success'" : "bg-light' disabled")." style='border-radius: 50px; ".(($result['claim'] == "y") ? "' onclick='claimReward(\"{$result['period']}\")'" : "cursor: not-allowed'").">".
						  (($result['claim'] == "y") ? "CLAIM" : "CLAIMED").
						"</button>
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