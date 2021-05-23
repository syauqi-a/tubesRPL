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
include("../includes/RekapKebiasaan.class.php");
date_default_timezone_set("Asia/Jakarta");

// Membuat objek dari kelas rekap kebiasaan
$oRekapKeb = new RekapKebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oRekapKeb->open();

// list nama-nama bulan
$months = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

// penampung list periode yg dibungkus dengan tag option
$listPeriod = "<option  value='' selected hidden>".$months[date('n')]."</option>";

// list periode yang telah dicatat
$onlist = [];

// melihat tabel rekap kebiasaan
if(mysqli_num_rows($oRekapKeb->getRecord()) > 0){
	while($result = $oRekapKeb->getResult()){
		$temp = explode("-", $result['tanggal']);
		$period = "$temp[0]-$temp[1]";

		if(!in_array($period, $onlist)){
			$m = $months[intval("{$temp[1]}")];
			array_push($onlist, $period);
			$listPeriod .= "<option  value='$period'>$m".(($temp[0] == date('Y')) ? "" : " $temp[0]")."</option>";
		}

	}
}

echo (($listPeriod == null) ? "failed" : $listPeriod);

// Menutup koneksi database
$oRekapKeb->close();

?>