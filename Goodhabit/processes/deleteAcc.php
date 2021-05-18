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
	// mengahapus akun
	if($oAkun->hapus($_GET['id_akun']))
		echo "success";
	else
		echo "failed";

}

// Menutup koneksi database
$oAkun->close();

?>