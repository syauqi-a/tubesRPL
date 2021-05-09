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
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Akun.class.php");

// Membaca template home.html
$tpl = new Template("templates/login.html");
// jika ada permintaan login
if(isset($_POST['login'])){

	// Membuat objek dari kelas akun
	$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

	// open koneksi
	$oAkun->open();

	if (mysqli_num_rows($oAkun->login($_POST['username'], md5($_POST['password']))) > 0){
		setcookie("id_akun", $oAkun->getResult()['id_akun'], time() + (86400 * 30), "/");
		setcookie("username", $oAkun->getResult()['username'], time() + (86400 * 30), "/");
		header("location: index.php");
	}

	else{
		if (mysqli_num_rows($oAkun->login($_POST['username'])) > 0){
			// Menampilkan pesan error untuk isian password
			$tpl->replace("id='msgPS'>", "id='msgPS'>Password salah!!!");
		}
		else
			// Menampilkan pesan error untuk isian username
			$tpl->replace("id='msgUN'>", "id='msgPS'>Username tidak ditemukan!!!");

	}

}

	if(isset($_COOKIE["username"]))
		// Mengganti isian username dengan username yang sudah dimasukkan user
		$tpl->replace("placeholder='username'", "value='{$_COOKIE['username']}'");

// Menampilkan ke layar
$tpl->write();

if(isset($_COOKIE["msg"])){
	$msg = preg_replace('/\+/', ' ', $_COOKIE['msg']);
	echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>