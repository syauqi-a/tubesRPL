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
if(isset($_POST['id_akun'])){
	// merubah data akun
	if($oAkun->ubah($_POST['id_akun'], $_POST['fname'], $_POST['email'], $_POST['phone'], $_POST['street'], $_POST['city'], $_POST['postal'])){
		echo "success";
	}else
		echo "failed";
}
else 
	echo "failed";
// Menutup koneksi database
$oAkun->close();

?>