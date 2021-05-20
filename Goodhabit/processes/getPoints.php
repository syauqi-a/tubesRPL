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

if(isset($_GET['id_akun'])){

	// menghitung point yang didapat oleh user
	if(mysqli_num_rows($oRekapKeb->getPoints($_GET['id_akun'])) > 0)
		echo ($oRekapKeb->getResult()['jml']*100);

}

// Menutup koneksi database
$oRekapKeb->close();

?>