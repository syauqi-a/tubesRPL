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
include("../includes/Kebiasaan.class.php");

// Membuat objek dari kelas kebiasaan dan rekap kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();

if($oKebiasaan->getRecord($_GET['id_akun'], $_GET['id_keb'])){
	$result = $oKebiasaan->getResult();

	// membuat text jam
	$temp = explode(":", $result['waktu']);
	$waktu = $temp[0].".".$temp[1];

	echo "<div class='card-header bg-transparent'>
		<h3 class='h2 mb-0 '><b>Agenda Details</b></h3>
	</div>
	<div class='card-body'>
		<h3 class='h3 mb-0 '>Nama Kebiasaan</h5>
		<h1 class='h2 mb-2 text-black'><b>{$result['nama_kebiasaan']}</b></h1>
		<h3 class='h3 mb-0 '>Deskripsi</h5>
		<h1 class='h2 mb-2 text-black'><b>".(($result['deskripsi'] == "") ? "-" : $result['deskripsi'])."</b></h1>
		<h3 class='h3 mb-0 '>Status Kebiasaan</h5>
		<h1 class='h2 mb-2 text-black'><b>".ucwords($result['status_kebiasaan'])."</b></h1>
		<h3 class='h3 mb-0 '>Waktu</h5>
		<h1 class='h2 mb-2 text-black'><b>$waktu</b></h1>
		<h3 class='h3 mb-0 '>Ulang</h5>
		<h1 class='h2 mb-2 text-black'><b>".ucwords($result['ulang'])."</b></h1>
		<div style='text-align: center; margin-top: 24px;'>
			<button type='button' class='btn btn-lg bg-green text-white ' style='border-radius: 50px;' onclick='taskDone({$_GET['id_akun']}, {$_GET['id_keb']})'>
				<i class='ni ni-user-run'></i>
				Done the task!
			</button>
		</div>
	</div>";
}
else 
	echo "failed";

// Menutup koneksi database
$oKebiasaan->close();

?>