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
include("../includes/RekapKebiasaan.class.php");
include("../includes/Hadiah.class.php");
date_default_timezone_set("Asia/Jakarta");

// Membuat objek dari kelas akun, rekap kebiasaandan hadiah
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);
$oRekapKeb = new RekapKebiasaan($db_host, $db_user, $db_password, $db_name);
$oHadiah = new Hadiah($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();
$oRekapKeb->open();
$oHadiah->open();

// penampung data hasil
$data = null;

if(isset($_POST['period'])){
	$id_akun = $_COOKIE['id_akun'];
	$content = null;
	$uPoint = null;
	$uRank = null;
	$claimReward = "ongoing";

	if(mysqli_num_rows($oRekapKeb->getRekapChallenge($_POST['period'])) > 0){
		$leaderboard = [];
		$listID = [];
		while($res = $oRekapKeb->getResult()){
			if(array_search($res['id_akun'], $listID) > -1){
				$leaderboard[array_search($res['id_akun'], $listID)]["point"] += 100;
				$leaderboard[array_search($res['id_akun'], $listID)]["ketepatan"] += $res['ketepatan'];
			}else{
				array_push($listID, $res['id_akun']);
				$temp = array("id"=>$res['id_akun'], "point"=>100, "ketepatan"=>$res['ketepatan']);
				array_push($leaderboard, $temp);
			}
			// sort hasil leaderboard berdasarkan point(DESC) dan ketepatan(ASC)
			usort($leaderboard, function($a, $b) {
				if($a["point"] != $b["point"])
					return $b["point"] - $a["point"];
				else
					return $a["ketepatan"] - $b["ketepatan"];
			});
		}
		$i = 1;
		foreach($leaderboard as $lb){
			if(mysqli_num_rows($oAkun->getRecord($lb["id"])) > 0){
				$profil = $oAkun->getResult();
				$content .= "<div class='container p-2 pl-3 mb-2 bg-primary text-white' style='border-radius: 10px;'>
					<div class='row'>
					  <div class='ml-2 icon icon-shape bg-white text-white rounded shadow' >
							<h1 class='h1 text-black bold'>$i</h1>
						</div>
					  <div class='col-sm-2'>
						<div class='profilefull'>
						 <img src='../assets/img/theme/dummy-man.png' class='img-fluid rounded-circle border border-white' style='background: #e9ecef;'>
						</div>
					  </div>
					  <div class='col-sm-5'>
						<div class='agenda-name'>{$profil['nama_lengkap']}</div>
						<div class='agenda-time'>{$profil['username']}</div>
					  </div>
					  <div class='col-sm' >
						<h1 class='h1 text-white bold' style='margin-bottom: -8px;'>{$lb['point']}pts</h1><small>accuracy +{$lb['ketepatan']}</small>
					  </div>
					</div>
				  </div>";
			}
			$i++;
		}
		if($_POST['period'] > date("Y-m"))
			$claimReward = "soon";
		else{
			if(mysqli_num_rows($oHadiah->getRecord($id_akun, (($_POST['period'] == "") ? date("Y-m") : $_POST['period']))) > 0){
				$claimReward = $oHadiah->getResult()['claim'];
			}
		}
		$uRank = array_search($id_akun, array_column($leaderboard, "id"));
		if(is_numeric($uRank)){
			if(($claimReward == "") && ($uRank == 0)) $claimReward = "pending";
			$uPoint = $leaderboard[$uRank]["point"];
			$uRank++;
		}
		else $uRank = null;
	}

	// menyatukan semua data menjadi 1 array
	$data = array(
		"lb" => $content,
		"uPoint" => $uPoint,
		"uRank" => $uRank,
		"claim" => $claimReward,
		"period" => (($_POST['period'] == "") ? date("Y-m") : $_POST['period'])
	);
}
	// encode data menggunakan json_decode
	echo json_encode($data);

// Menutup koneksi database
$oAkun->close();
$oRekapKeb->close();
$oHadiah->close();

?>