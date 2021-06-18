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

if(isset($_GET['id_akun'])){

	// melihat tabel kebiasaan
	if(mysqli_num_rows($oKebiasaan->getRecordByStatus("rekomendasi", $_GET['id_keb'])) > 0){
		$result = $oKebiasaan->getResult();
		// menambahkan kebiasaan ke DB dengan id akun user
		if($oKebiasaan->tambah($result['nama_kebiasaan'], "pribadi", $result['waktu'], $result['ulang'], $result['deskripsi'], $result['ket'],$_GET['id_akun'])){
			echo "success";
		}
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

?>