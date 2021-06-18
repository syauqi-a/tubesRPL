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

// Membuat objek dari kelas kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();

if(isset($_GET['id_akun'])){
	if($oKebiasaan->getRecordByStatus("rekomendasi", $_GET['id_keb'])){
		$result = $oKebiasaan->getResult();
		$id_akun = $_GET['id_akun'];
		$id_keb = $_GET['id_keb'];

		// membuat text jam
		$temp = explode(":", $result['waktu']);
		$waktu = $temp[0].".".$temp[1];

		echo "<div class='card-header bg-transparent'>
			<h3 class='h2 mb-0 '><b>Recommendation Details</b></h3>
		</div>
		<div class='card-body'>
			<h3 class='h3 mb-0 '>Habit Name</h5>
			<h1 class='h2 mb-2 text-black'><b>{$result['nama_kebiasaan']}</b></h1>
			<h3 class='h3 mb-0 '>Description</h5>
			<h1 class='h2 mb-2 text-black'><b>".(($result['deskripsi'] == "") ? "-" : $result['deskripsi'])."</b></h1>
			<h3 class='h3 mb-0 '>Habit Status</h5>
			<h1 class='h2 mb-2 text-black'><b>".ucwords($result['status_kebiasaan'])."</b></h1>
			<h3 class='h3 mb-0 '>Time</h5>
			<h1 class='h2 mb-2 text-black'><b>$waktu</b></h1>
			<h3 class='h3 mb-0 '>Repeat</h5>
			<h1 class='h2 mb-2 text-black'><b>".ucwords($result['ulang']);
		if($result['ulang'] == "tiap minggu") echo " on ".$result['ket'];
		$x = ["th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th", "th", "th", "th", "th"];
		if($result['ulang'] == "tiap bulan") echo " on the ".$result['ket'].($result['ket'] > 13 ? $x[$result['ket']%10] : $x[$result['ket']]);
		echo "</b></h1>
			<div style='text-align: center; margin-top: 24px;'>
				<button type='button' class='btn btn-lg bg-blue text-white ' style='border-radius: 50px;' onclick='addRecomnd($id_akun, $id_keb);'>
					<i class='ni ni-fat-add' ></i>
					Add Habit
				</button>
			</div>
		</div>";
	}
	else
		echo "failed";
}
else
	echo "failed";

// Menutup koneksi database
$oKebiasaan->close();

?>