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

// Membuat objek dari kelas Akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);
$oRekapKeb = new RekapKebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();
$oKebiasaan->open();
$oRekapKeb->open();

if(isset($_GET['id_akun'])){
	// melihat data akun
	$id_akun = $_GET['id_akun'];
	$data = null;
	if(mysqli_num_rows($oAkun->getRecord($id_akun)) > 0){
		$result = $oAkun->getResult();
		$address = ($result['jalan'] != "") ? $result['jalan'] : "";
		$address .= ($result['kota'] != "") ? " ".$result['kota'] : "";
		$address .= ($result['kodePos'] != "") ? " ".$result['kodePos'] : "";
		$data = array(
			"username" => $result['username'],
			"gender" => (($result['jenis_kelamin']=="L") ? "Male" : "Female"),
			"email" => $result['email'],
			"phone" => (($result['telepon'] == null) ? "" : $result['telepon']),
			"address" => $address
		);
	}

	// menghitung jumlah kebiasaan yang telah dibuat
	if(mysqli_num_rows($oKebiasaan->countKeb($id_akun)) > 0)
		$data = array_merge($data, array("jmlHabit"=>$oKebiasaan->getResult()['jml']));

	// menghitung jumlah kebiasaan yang telah dilakukan
	if(mysqli_num_rows($oRekapKeb->countRec($id_akun)) > 0){
		$data = array_merge($data, array("jmlRecHab"=>$oRekapKeb->getResult()['jml']));
	}

	// menghitung jumlah challenge yang telah diikuti
	if(mysqli_num_rows($oRekapKeb->countClg($id_akun)) > 0){
		$data = array_merge($data, array("jmlRecClg"=>$oRekapKeb->getResult()['jml']));
	}

	echo json_encode($data);

}

// Menutup koneksi database
$oAkun->close();
$oKebiasaan->close();
$oRekapKeb->close();

?>