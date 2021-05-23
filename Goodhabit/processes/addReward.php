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

// Membuat objek dari kelas hadiah
$oHadiah = new Hadiah($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oHadiah->open();

if(isset($_COOKIE['id_akun'])){

	// menambahkan hadiah baru ke DB
	if($oHadiah->tambah($_POST['name'], $_POST['code'], $_POST['desc'], $_POST['period']."-01", $_COOKIE['id_akun'])){
		echo "success";
	}
	else 
		echo "failed";

}
else 
	echo "failed";

// Menutup koneksi database
$oHadiah->close();

?>