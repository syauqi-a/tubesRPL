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

// Membuat objek dari kelas akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();

if(isset($_POST['id_akun']) && isset($_FILES['fphoto'])){
	$id_akun = $_POST['id_akun'];

	// ambil informasi dari foto yang diunggah
	$tmp_file = $_FILES['fphoto']['tmp_name'];
	$nm_file = $_FILES['fphoto']['name'];
	$ukuran_file = $_FILES['fphoto']['size'];
	$max_size = 1000000; //limit 1MB
	if($ukuran_file < $max_size){

		// alamat direktori yang digunakan untuk menyimpan hasil unggahan
		$dir = "../assets/uploads/p-profiles/$id_akun-$nm_file";

		// menyimpan foto yang telah diunggah
		if(move_uploaded_file($tmp_file, $dir)){

			// meyimpan nama foto ke DB
			if($oAkun->ubahFoto($id_akun, "$id_akun-$nm_file")){
				if($oAkun->getAffectedRows() > 0){
					setrawcookie("photo-profile", rawurlencode("$id_akun-$nm_file"), time() + (86400), "/");
					echo "success";
				}
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
$oAkun->close();

?>