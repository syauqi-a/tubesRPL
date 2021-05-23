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
include("../includes/Kebiasaan.class.php");
include("../includes/RekapKebiasaan.class.php");
include("../includes/Hadiah.class.php");

// Membuat objek dari kelas akun, kebiasaan dan hadiah
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);
$oHadiah = new Hadiah($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();
$oKebiasaan->open();
$oHadiah->open();

// penampung data hasil
$data = [];

if((isset($_COOKIE['id_akun'])) && ($_COOKIE['id_akun'] == 1)){
	$id_akun = $_COOKIE['id_akun'];

	// menghitunh jumlah user
	if(mysqli_num_rows($oAkun->getRecord()) > 0){
		$data = array_merge($data, array("jmlUser"=>mysqli_num_rows($oAkun->getRecord()) - 1));
	}

	// menghitung jumlah challenge yang telah dibuat
	if(mysqli_num_rows($oKebiasaan->getRecordByStatus("challenge")) > 0){
		$data = array_merge($data, array("jmlChlg"=>mysqli_num_rows($oKebiasaan->getRecordByStatus("challenge"))));
	}

	// menghitung jumlah rekomendasi yang telah dibuat
	if(mysqli_num_rows($oKebiasaan->getRecordByStatus("rekomendasi")) > 0)
		$data = array_merge($data, array("jmlRecm"=>mysqli_num_rows($oKebiasaan->getRecordByStatus("rekomendasi"))));

	// menghitung jumlah reward yg telah diberikan
	if(mysqli_num_rows($oHadiah->getRecord()) > 0){
		$totalHadiah = mysqli_num_rows($oHadiah->getRecord());
		$data = array_merge($data, array("jmlReward"=>$totalHadiah - mysqli_num_rows($oHadiah->getRecord($id_akun))));
	}

}

echo json_encode($data);

// Menutup koneksi database
$oAkun->close();
$oKebiasaan->close();
$oHadiah->close();

?>