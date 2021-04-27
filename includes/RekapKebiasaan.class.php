<?php 

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/

class RekapKebiasaan extends DB{

	// Menambahkan data rekap_kebiasaan
	function tambah($id_akun = '', $id_kebiasaan = ''){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date("Ymd");
		// Query mysql insert ke rekap_kebiasaan
		$query = "INSERT INTO `rekap_kebiasaan` VALUES ('{$id_akun}', '{$id_kebiasaan}', '{$tanggal}')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data rekap_kebiasaan
	function getRecord($id_akun = '', $id_kebiasaan = ''){
		// Query mysql select data ke rekap_kebiasaan
		$query = "SELECT * FROM `rekap_kebiasaan`";

		// Jika ada masukan id akun dan id kebiasaan
		if(($id_akun != '') && ($id_kebiasaan != ''))
			$query .= " WHERE id_akun = {$id_akun} AND id_kebiasaan = {$id_kebiasaan}";

		// Jika hanya ada masukan id akun
		else if($id_akun != '')
			$query .= " WHERE id_akun = {$id_akun}";

		// Jika hanya ada masukan id kebiasaan
		else if($id_kebiasaan != '')
			$query .= " WHERE id_kebiasaan = {$id_kebiasaan}";

		// Mengeksekusi query
		return $this->execute($query);
	}

}

?>
