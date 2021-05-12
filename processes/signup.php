<?php

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/

include("../conf.php");
include("../includes/DB.class.php");
include("../includes/Akun.class.php");

// Membuat objek dari kelas akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();

// jika ada permintaan sign up
if(isset($_POST['fname'])){

	if($oAkun->tambah($_POST['fname'], $_POST['username'], $_POST['email'], md5($_POST['password']), $_POST['gender'])){
		setcookie("username", $_POST['username'], time() + (86400), "/");
		setcookie("msg", "You have successfully registered", time() + (1), "/");
		// Melempar pesan sukses login
		echo "success";
	}

	if(strpos($oAkun->db_link->error, "username_UNIQUE"))
		// Melempar pesan error untuk isian username
		echo "error: username";
	else if(strpos($oAkun->db_link->error, "email_UNIQUE"))
		// Melempar pesan error untuk isian email
		echo "error: email";

}

// Menutup koneksi database
$oAkun->close();

?>