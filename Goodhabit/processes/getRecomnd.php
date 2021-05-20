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

// melihat tabel kebiasaan
$recomnds = null;
if(isset($_GET['id_akun'])){
	if(mysqli_num_rows($oKebiasaan->getRecordByStatus("rekomendasi", "", "ASC")) > 0){
		while($result = $oKebiasaan->getResult()){
			// membuat text jam
			$temp = explode(":", $result['waktu']);
			$waktu = $temp[0].".".$temp[1];

			$recomnds .= "<div class='container p-1 pl-3 mb-2 reccom'>
							<div class='row'>
							  <div class='col-sm-10'>
								<div class='agenda-name'>{$result['nama_kebiasaan']}</div>
								<div class='agenda-time'>$waktu</div>
							  </div>
							  <button type='button' class='btn icon icon-shape bg-success text-white rounded-circle shadow' onclick='recomndDtl({$_GET['id_akun']}, {$result['id_kebiasaan']});'>
									<i class='ni ni-fat-add text-white' style='font-size: 2rem;'></i>
								</button>
							</div>
						  </div>";
		}
	}
}

	echo $recomnds;

// Menutup koneksi database
$oKebiasaan->close();

?>