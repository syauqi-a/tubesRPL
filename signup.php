<?php

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Akun.class.php");

// Membaca template home.html
$tpl = new Template("templates/signup.html");

// Membuat objek dari kelas akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();

// jika ada permintaan sign up
if(isset($_POST['signup'])){

	if($oAkun->tambah($_POST['fname'], $_POST['username'], $_POST['email'], md5($_POST['password']), $_POST['gender'])){
		setcookie("username", $_POST['username'], time() + (86400 * 30), "/");
		setcookie("msg", "You have successfully registered", time() + (86400 * 30), "/");
		header("location: login.php");
	}
	else{
		$tpl->replace("placeholder='Full Name'", "value='{$_POST['fname']}'");
		($_POST['username']=='L') ? $tpl->replace("option value='L'", "option value='L' selected") : $tpl->replace("option value='P'", "option value='P' selected");
		$tpl->replace("placeholder='Username'", "value='{$_POST['username']}'");
		$tpl->replace("placeholder='Email'", "value='{$_POST['email']}'");

		if(strpos($oAkun->db_link->error, "username_UNIQUE"))
			// Menampilkan pesan error untuk isian username
			$tpl->replace("id='msgUN'>", "id='msgUN'>Username telah digunakan!!!");
		else if(strpos($oAkun->db_link->error, "email_UNIQUE"))
			// Menampilkan pesan error untuk isian email
			$tpl->replace("id='msgEmail'>", "id='msgEmail'>Email telah digunakan!!!");
	}

}

// Menampilkan ke layar
$tpl->write();

?>