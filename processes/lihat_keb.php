<!doctype html>
<html>
	<head>
		<title>Lihat Kebiasaan</title>
	</head>
	<body>
<?php

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/
//session_start();
include("../conf.php");
include("../includes/DB.class.php");
include("../includes/Kebiasaan.class.php");
date_default_timezone_set("Asia/Jakarta");

// Membuat objek dari kelas akun
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();

// melihat tabel kebiasaan
if(mysqli_num_rows($oKebiasaan->getRecord(2)) > 0){
	$temp = "<table border='1 solid'>
				<tr>
				  <td>No.</td>
				  <td>Nama</td>
				  <td>Status</td>
				  <td>Waktu</td>
				  <td>Ulang</td>
				  <td>Deskripsi</td>
				  <td>Ket</td>
				</tr>";
	$data = "<h3>Tabel kebiasaan</h3>".$temp;
	$jadwal = "<h3>Jadwal kebiasaan hari ini</h3>".$temp;
	$i = 1;
	while($result = $oKebiasaan->getResult()){
		$temp = "<tr>
					<td>$i</td>
					<td>{$result['nama_kebiasaan']}</td>
					<td>{$result['status_kebiasaan']}</td>
					<td>{$result['waktu']}</td>
					<td>{$result['ulang']}</td>
					<td>{$result['deskripsi']}</td>
					<td>{$result['ket']}</td>
				  </tr>";
		$data .= $temp;
		if($result['ulang'] == "tiap hari")
			$jadwal .= $temp;
		else if(($result['ulang'] == "tiap minggu") && ($result['ket'] == date("l")))
			$jadwal .= $temp;
		else if(($result['ulang'] == "tiap bulan") && ($result['ket'] == date("d")))
			$jadwal .= $temp;
		$i++;
	}
	$data .= "</table>";
	$jadwal .= "</table>";
	// Menampilkan ke layar
	echo $data."<br>";
	echo $jadwal."<br>";
}

// melihat tabel jadwal kebiasaan hari ini


// Menutup koneksi database
$oKebiasaan->close();

?>
	</body>
</html>