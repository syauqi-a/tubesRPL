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

// Membuat objek dari kelas kebiasaan dan rekap kebiasaan
$oRekapKeb = new RekapKebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oRekapKeb->open();

if($oRekapKeb->tambah($_GET['id_akun'], $_GET['id_keb']))
	echo "success";
else 
	echo "failed";

// Menutup koneksi database
$oRekapKeb->close();

?>