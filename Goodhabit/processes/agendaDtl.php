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
date_default_timezone_set("Asia/Jakarta");

// Membuat objek dari kelas kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();

if(isset($_GET['clg']) && $_GET['clg']=="true"){
	if(mysqli_num_rows($oKebiasaan->getRecordByStatus("challenge", $_GET['id_keb'])) > 0)
		write($oKebiasaan->getResult(), true);
	else
		echo "failed";
}
else if(isset($_GET['id_akun'])){
	if(mysqli_num_rows($oKebiasaan->getRecord($_GET['id_akun'], $_GET['id_keb'])) > 0)
		write($oKebiasaan->getResult());
	else
		echo "failed";
}
else 
	echo "failed";

function write($result, $clg=false){
	$id_akun = $_GET['id_akun'];
	$id_keb = $_GET['id_keb'];

	// membuat text jam
	$temp = explode(":", $result['waktu']);
	$waktu = $temp[0].".".$temp[1];
	$allow = ((date("H.i") > $waktu) ? true : false);

	echo ("<div class='card-header bg-transparent'>
		<h3 class='h2 mb-0 '><b>".(($clg) ? "Challenge Details" : "Agenda Details")."</b></h3>
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
		<h1 class='h2 mb-2 text-black'><b>".ucwords($result['ulang'])."</b></h1>
		<div style='text-align: center; margin-top: 24px;'>
			".(($clg) ? "
				<form id='upload-proof' method='post' enctype='multipart/form-data'>
					<input type='text' name='id_akun' value='$id_akun' hidden />
					<input type='text' name='id_keb' value='$id_keb' hidden />
					<button type='button' id='btn-upload-proof' class='btn btn-lg bg-blue text-white ' style='border-radius: 50px;".(($allow) ? "' onclick='uploadProof();'" : "cursor: no-drop;' disabled").">
						<i class='ni ni-cloud-upload-96'></i>
						Upload your proof!
					</button>
					<input name='fupload' type='file' id='fupload' style='display:none' accept='image/*' />
					<br><br>" : "")."
					<button type='".(($clg) ? "submit' name='upload' value='Upload'"  :"button'")." id='btn-task-done' class='btn btn-lg bg-green text-white ' style='border-radius: 50px; ".(($allow) ? (($clg) ? "cursor: no-drop;' disabled onclick='clgDone(event, $id_akun, $id_keb);'" : "' onclick='taskDone($id_akun, $id_keb);'") : "cursor: no-drop;' disabled").">
						<i class='ni ni-user-run'></i>
						Done the task!
					</button>
			".(($clg) ? "</form>" : "")."
		</div>
	</div>");
}

// Menutup koneksi database
$oKebiasaan->close();

?>