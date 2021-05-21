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
include("../includes/RekapKebiasaan.class.php");
date_default_timezone_set("Asia/Jakarta");

// Membuat objek dari kelas kebiasaan dan rekap kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);
$oRekapKeb = new RekapKebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();
$oRekapKeb->open();

if(isset($_GET['id_akun'])){
	if(mysqli_num_rows($oKebiasaan->getRecord("", $_GET['id_keb'])) > 0){
		$result = $oKebiasaan->getResult();
		$temp = explode(":", $result['waktu']);
		$ketepatan = ((date("H")-$temp[0])*60)+(date("i")-$temp[1]);

		if($oRekapKeb->tambah($_GET['id_akun'], $_GET['id_keb'], $ketepatan))
			echo "success";
		else 
			echo "failed";
	}
	else 
		echo "failed";
}
else 
	echo "failed";

// Menutup koneksi database
$oKebiasaan->close();
$oRekapKeb->close();

?>