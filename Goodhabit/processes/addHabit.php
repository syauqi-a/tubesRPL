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

	// menambahkan kebiasaan baru ke DB
	$opt = (isset($_POST['option'])) ? $_POST['option'] : "";
	if($oKebiasaan->tambah($_POST['nama_keb'], $_POST['status'], $_POST['time'], $_POST['repeat'], $_POST['desc'], $opt, $_COOKIE['id_akun'])){
		echo "success";
	}
	else 
		echo "failed";

}
else 
	echo "failed";

// Menutup koneksi database
$oKebiasaan->close();

?>