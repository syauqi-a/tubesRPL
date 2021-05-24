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
include("../includes/RekapKebiasaan.class.php");
date_default_timezone_set("Asia/Jakarta");

// Membuat objek dari kelas kebiasaan dan rekap kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);
$oRekapKeb = new RekapKebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();
$oRekapKeb->open();

if(isset($_GET['id_akun'])){
	// melihat tabel kebiasaan
	$agendas = null;
	$id_akun = $_GET['id_akun'];
	if(mysqli_num_rows($oKebiasaan->getRecord($id_akun)) > 0){
		while($result = $oKebiasaan->getResult()){
			if(($result['ulang'] == "tiap hari") || (($result['ulang'] == "tiap minggu") && ($result['ket'] == date("l"))) || (($result['ulang'] == "tiap bulan") && ($result['ket'] == date("d")))){
				// mengecek apakah sudah dilakukan atau belum
				$belum = 1;
				if(mysqli_num_rows($oRekapKeb->getRecord($id_akun, $result['id_kebiasaan'])) > 0){
					while(($res = $oRekapKeb->getResult()) && $belum==1){
						$temp = explode(" ", $res['tanggal']);
						if($temp[0] == date("Y-m-d")){
							$belum = 0;
						}
					}
				}

				// membuat text jam
				$temp = explode(":", $result['waktu']);
				$waktu = $temp[0].".".$temp[1];

				$agendas .= "<div class='container p-2 pl-3 mb-2 bg-".(($belum == 1) ? "primary " : "success")." text-white' style='border-radius: 10px;".(($belum == 1) ? "cursor: pointer;' onclick='agendaDtl($id_akun, {$result['id_kebiasaan']})'" : "'").">
							   <div class='row'>
								 <div class='col-sm-10'>
								   <div class='agenda-name'>{$result['nama_kebiasaan']}</div>
								   <div class='agenda-time'>$waktu</div>
								 </div>
								 <div class='col-sm-2' style='font-size: 2rem;'>".
								 (($belum == 1) ? "" : "<i class='ni ni-check-bold text-white'></i>")."
								 </div>
							   </div>
							 </div>";
			}
		}
	}

	if(mysqli_num_rows($oKebiasaan->getRecordByStatus("challenge")) > 0){
		while($result = $oKebiasaan->getResult()){
			// mengecek apakah sudah dilakukan atau belum
				$belum = 1;
				if(mysqli_num_rows($oRekapKeb->getRecord($id_akun, $result['id_kebiasaan'])) > 0){
					while(($res = $oRekapKeb->getResult()) && $belum==1){
						$temp = explode(" ", $res['tanggal']);
						if($temp[0] == date("Y-m-d")){
							$belum = 0;
						}
					}
				}
			if(($result['ulang'] == "tiap hari") || (($result['ulang'] == "tiap minggu") && ($result['ket'] == date("l"))) || (($result['ulang'] == "tiap bulan") && ($result['ket'] == date("d")))){
				$temp = explode(":", $result['waktu']);
				$waktu = $temp[0].".".$temp[1];
				$agendas .= "<div class='container p-2 pl-3 mb-2 bg-yellow text-black' style='border-radius: 10px;".(($belum == 1) ? "cursor: pointer;' onclick='agendaDtl($id_akun, {$result['id_kebiasaan']}, true)'" : "'")."'>
							   <div class='row'>
								 <div class='col-sm-10'>
								   <div class='agenda-name'>{$result['nama_kebiasaan']}</div>
								 </div>
								 <div class='col-sm-2' style='font-size: 2rem;'>".
								 (($belum == 1) ? "" : "<i class='ni ni-check-bold text-white'></i>")."
								 </div>
							   </div>
							 </div>";
			}
		}
	}

	echo $agendas;
}

// Menutup koneksi database
$oKebiasaan->close();
$oRekapKeb->close();

?>