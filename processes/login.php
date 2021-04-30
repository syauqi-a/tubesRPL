<?php

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/
//session_start();
include("conf.php");
include("includes/DB.class.php");
include("includes/Akun.class.php");

// Membuat objek dari kelas akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();

// jika ada permintaan login
if(isset($_POST['login'])){

	if (mysqli_num_rows($oAkun->login($_POST['username'], md5($_POST['password'])))){
		return true;
	}
	return false;

}

?>