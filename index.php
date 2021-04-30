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
include("includes/Kebiasaan.class.php");
include("includes/Hadiah.class.php");
include("includes/RekapKebiasaan.class.php");

// Membuat objek dari kelas akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);
// Membuat objek dari kelas kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);
// Membuat objek dari kelas hadiah
$oHadiah = new Hadiah($db_host, $db_user, $db_password, $db_name);
// Membuat objek dari kelas hadiah
$oRekapKebiasaan = new RekapKebiasaan($db_host, $db_user, $db_password, $db_name);

// Membaca template home.html
$tpl = new Template("templates/testing.html");

// open koneksi
$oAkun->open();
$oKebiasaan->open();
$oHadiah->open();
$oRekapKebiasaan->open();

$data = null;

// Simpan data akun baru
if(isset($_POST['tambahUser'])) $oAkun->tambah($_POST['nama_lengkap'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['jenis_kelamin'], $_POST['telepon'], $_POST['jalan'], $_POST['kota'], $_POST['kodePos']);
// Simpan foto profil
if(isset($_POST['simpanFoto'])) $oAkun->ubahFoto($_POST['id_akun'], $_POST['foto_profil']);
// Simpan data kebiasaan baru
if(isset($_POST['tambahKebiasaan'])) $oKebiasaan->tambah($_POST['nama_kebiasaan'], $_POST['status_kebiasaan'], $_POST['waktu'], $_POST['ulang'], $_POST['deskripsi']);
// Simpan data hadiah baru
if(isset($_POST['tambahHadiah'])) $oHadiah->tambah($_POST['nama_hadiah'], $_POST['kode_hadiah'], $_POST['deskripsi'], $_POST['id_kebiasaan']);
// Simpan data rekap kebiasaan
if(isset($_POST['rekap'])) $oRekapKebiasaan->tambah($_POST['id_akun'], $_POST['id_kebiasaan']);


// test method getRecord
$oAkun->getRecord(2);
$oKebiasaan->getRecord(1);
$oHadiah->getRecord(3);
$oRekapKebiasaan->getRecord(2, 1);


//test menampilkan data ke layar
$tpl->replace("isian data akun", $oAkun->getResult());
$tpl->replace("isian data kebiasaan", $oKebiasaan->getResult());
$tpl->replace("isian data hadiah", $oHadiah->getResult());
$tpl->replace("isian data rekap", $oRekapKebiasaan->getResult());

//test method ubah
$oAkun->ubah(10);
$oKebiasaan->ubah(10);
$oHadiah->ubah(10);

//test method hapus
$oAkun->hapus(10);
$oKebiasaan->hapus(10);
$oHadiah->hapus(10);

// Menyiapkan pilihan akun untuk form rekap kebiasaan
if(mysqli_num_rows($oAkun->getRecord()) > 0){
	$data = null;
	while($result = $oAkun->getResult()){
		$data .= "<option value='{$result['id_akun']}'>{$result['nama_lengkap']}</option>";
	}
	$tpl->replace("Pilihan Akun", $data);
}

// Menyiapkan pilihan kebiasaan untuk form tambah hadiah dan rekap kebiasaan
if(mysqli_num_rows($oKebiasaan->getRecordByStatus('challenge')) > 0){
	$data = null;
	while($result = $oKebiasaan->getResult()){
		$data .= "<option value='{$result['id_kebiasaan']}'>{$result['nama_kebiasaan']}</option>";
	}
	$tpl->replace("Pilihan Kebiasaan", $data);
}

// Menutup koneksi database
$oAkun->close();
$oKebiasaan->close();
$oHadiah->close();

// Mengganti kode Data_Tabel dengan data yang sudah diproses
//$tpl->replace("Tabel user", "Isian tabel daftar user");

// Menampilkan ke layar
$tpl->write();
?>