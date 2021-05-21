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

// Membuat objek dari kelas kebiasaan dan rekap kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);
$oRekapKeb = new RekapKebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();
$oRekapKeb->open();

if(isset($_POST['id_akun']) && isset($_FILES['fupload'])){
	$id_akun = $_POST['id_akun'];
	$id_keb = $_POST['id_keb'];

	// ambil informasi dari foto yang diunggah
	$tmp_file = $_FILES['fupload']['tmp_name'];
	$nm_file = $_FILES['fupload']['name'];
	$ukuran_file = $_FILES['fupload']['size'];
	$max_size = 1000000; //limit 1MB
	if($ukuran_file < $max_size){
		// alamat direktori yang digunakan untuk menyimpan hasil unggahan
		$dir = "../assets/uploads/proofs/$id_akun-$id_keb-$nm_file";
		// menyimpan foto yang telah diunggah
		if(move_uploaded_file($tmp_file, $dir)){
			if(mysqli_num_rows($oKebiasaan->getRecordByStatus("challenge", $id_keb)) > 0){
				$result = $oKebiasaan->getResult();
				$temp = explode(":", $result['waktu']);
				$ketepatan = ((date("H")-$temp[0])*60)+(date("i")-$temp[1]);

				if($oRekapKeb->tambah($id_akun, $id_keb, $ketepatan, $dir))
					echo "success";
				else 
					echo "failed";
			}
			else 
				echo "failed";
		}
		else 
			echo "failed";
	}
	else 
		echo "error: size";
}
else 
	echo "failed";

// Menutup koneksi database
$oRekapKeb->close();
$oKebiasaan->close();

?>