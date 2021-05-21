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

// Membuat objek dari kelas akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();

// jika ada permintaan login
if(isset($_POST['username'])){

	if (mysqli_num_rows($oAkun->login($_POST['username'], md5($_POST['password']))) > 0){
		$result = $oAkun->getResult();
		setcookie("id_akun", $result['id_akun'], time() + (86400), "/");
		setrawcookie("username", $_POST['username'], time() + (86400), "/");
		setrawcookie("photo-profile", $result['foto_profil'], time() + (86400), "/");
		// Melempar pesan sukses login
		echo "success";
	}

	else{
		if (mysqli_num_rows($oAkun->login($_POST['username'])) > 0)
			// Melempar pesan error untuk isian password
			echo "error: password";

		else
			// Melempar pesan error untuk isian username
			echo "error: username";
	}

}

// Menutup koneksi database
$oAkun->close();

?>