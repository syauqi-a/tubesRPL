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

// jika ada permintaan sign up
if(isset($_POST['signup'])){

	if($oAkun->tambah($_POST['nama_lengkap'], $_POST['username'], $_POST['email'], md5($_POST['password']), $_POST['jenis_kelamin'], $_POST['telepon'], $_POST['jalan'], $_POST['kota'], $_POST['kodePos'])){
		return true;
	}
	return false;

}
?>