<?php

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/
include("conf.php");
include("includes/DB.class.php");
include("includes/Akun.class.php");

// Membuat objek dari kelas akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();

// jika ada permintaan update foto profil
if(isset($_POST['updateFoto'])){

	// ambil informasi dari foto yang diunggah
	$tmp_file = $_FILES['fupload']['tmp_name']; // fupload: name untuk input file
	$nm_file = $_FILES['fupload']['name'];
	$ukuran_file = $_FILES['fupload']['size'];
	$max_size = 1000000; //limit 1MB
	if($ukuran_file < $max_size){
		// alamat direktori yang digunakan untuk menyimpan hasil unggahan
		$dir = "uploads/$_POST['id']-$nm_file";
		// menyimpan foto yang telah diunggah
		move_uploaded_file($tmp_file, $dir);
		// meyimpan record ke database
		if($oAkun->ubahFoto($_POST['id'], $dir)){
			return true;
		}
		return false;
	}
	return false;

}
?>