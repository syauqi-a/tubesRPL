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
	function tambah($id_akun = '', $id_kebiasaan = '', $ketepatan = '', $bukti = ''){
		// Query mysql insert ke rekap_kebiasaan
		$query = "INSERT INTO `rekap_kebiasaan` VALUES ('$id_akun', '$id_kebiasaan', NOW(), '$ketepatan', ".(($bukti != '') ? "'$bukti'" : "NULL").")";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data rekap_kebiasaan
	function getRecord($id_akun = '', $id_kebiasaan = ''){
		// Query mysql select data
		$query = "SELECT a.tanggal, b.nama_lengkap, c.nama_kebiasaan FROM `rekap_kebiasaan` a, `akun` b, `kebiasaan` c WHERE a.id_akun = b.id_akun AND a.id_kebiasaan = c.id_kebiasaan";

		// Jika ada masukan id akun dan id kebiasaan
		if(($id_akun != '') && ($id_kebiasaan != ''))
			$query .= " AND a.id_akun = $id_akun AND a.id_kebiasaan = $id_kebiasaan";

		// Jika hanya ada masukan id akun
		else if($id_akun != '')
			$query .= " AND a.id_akun = $id_akun";

		// Jika hanya ada masukan id kebiasaan
		else if($id_kebiasaan != '')
			$query .= " AND a.id_kebiasaan = $id_kebiasaan";

		// Mengeksekusi query
		return $this->execute($query." ORDER BY tanggal DESC");
	}

	// Menghitung jumlah kebiasaan yang telah dilakukan
	function countRec($id_akun){
		// Query mysql select data
		$query = "SELECT COUNT(b.`id_kebiasaan`) as jml FROM `kebiasaan` a, `rekap_kebiasaan` b WHERE a.`id_kebiasaan`= b.`id_kebiasaan` AND a.`status_kebiasaan`='pribadi' AND b.`id_akun` = $id_akun";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Menghitung jumlah challenge yang telah diikuti
	function countClg($id_akun){
		// Query mysql select data
		$query = "SELECT COUNT(DISTINCT b.`id_kebiasaan`) as jml FROM `kebiasaan` a, `rekap_kebiasaan` b WHERE a.`id_kebiasaan`= b.`id_kebiasaan` AND a.`status_kebiasaan`='challenge' AND b.`id_akun` = $id_akun";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Menghitung point challenge user
	function getPoints($id_akun, $period = ''){
		// mengecek nilai parameter periode
		if($period == ''){
			date_default_timezone_set("Asia/Jakarta");
			$period = date("Y-m");
		}

		// Query mysql select data
		$query = "SELECT COUNT(b.`id_akun`) as jml FROM `kebiasaan` a, `rekap_kebiasaan` b WHERE a.`id_kebiasaan`= b.`id_kebiasaan` AND a.`status_kebiasaan`='challenge' AND b.`tanggal` LIKE '$period%' AND b.`id_akun` = $id_akun";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Merekap point challenge pada bulan tertentu
	function getRekapChallenge($period = ''){
		// mengecek nilai parameter periode
		if($period == ''){
			date_default_timezone_set("Asia/Jakarta");
			$period = date("Y-m");
		}

		// Query mysql select data
		$query = "SELECT b.`id_akun`, b.`tanggal`, b.`ketepatan` FROM `kebiasaan` a, `rekap_kebiasaan` b WHERE a.`id_kebiasaan`= b.`id_kebiasaan` AND a.`status_kebiasaan`='challenge' AND `tanggal` LIKE '$period%' ORDER BY b.`id_akun`";

		// Mengeksekusi query
		return $this->execute($query);
	}

}

?>
