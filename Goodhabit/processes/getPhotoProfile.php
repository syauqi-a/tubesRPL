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

// Membuat objek dari kelas Akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();

if(isset($_GET['id_akun'])){
	// melihat data akun
	if(mysqli_num_rows($oAkun->getRecord($_GET['id_akun'])) > 0){
		$result = $oAkun->getResult();
		if($result['foto_profil'] != "")
			if((!isset($_COOKIE['photo-profile'])) || ($_COOKIE['photo-profile'] != $result['foto_profil']))
				setrawcookie("photo-profile", rawurlencode($result['foto_profil']), time() + (86400), "/");
	}
}

// Menutup koneksi database
$oAkun->close();

?>