<?php 

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/

class Kebiasaan extends DB{

	// Menambahkan data kebiasaan
	function tambah($nama_kebiasaan = '', $status_kebiasaan = '', $waktu = '', $ulang = '', $deskripsi = '', $id_akun = ''){
		// tambahkan keterangan
		$ket = null;

		// Query mysql insert ke kebiasaan
		$query = "INSERT INTO `kebiasaan` (`nama_kebiasaan`, `status_kebiasaan`, `waktu`, `ulang`, `deskripsi`, `ket`, `id_akun`) VALUES ('$nama_kebiasaan', '$status_kebiasaan', '$waktu', '$ulang', '$deskripsi', '$ket', '$id_akun')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data kebiasaan
	function getRecord($id_akun = '', $id_kebiasaan = ''){
		// Query mysql select data ke kebiasaan
		$query = "SELECT * FROM `kebiasaan` WHERE status_kebiasaan = 'pribadi'";

		// Jika ada masukan id kebiasaan
		if($id_kebiasaan != '') $query .= " AND id_kebiasaan = $id_kebiasaan";

		// Jika ada masukan id akun
		if($id_akun != '') $query .= " AND id_akun = $id_akun ORDER BY waktu";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data kebiasaan berdasarkan status kebiasaan
	function getRecordByStatus($status){
		// Query mysql select data ke kebiasaan
		$query = "SELECT * FROM `kebiasaan` WHERE status_kebiasaan = '$status'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Menghitung jumlah kebiasaan berdasarkan id_akun
	function countKeb($id_akun){
		// Query mysql select data ke kebiasaan
		$query = "SELECT COUNT(`id_kebiasaan`) AS jml FROM `kebiasaan` WHERE id_akun = $id_akun";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Memperbarui data kebiasaan
	function ubah($id, $nama_kebiasaan = '', $status_kebiasaan = '', $waktu = '', $ulang = '', $deskripsi = ''){
		// Query mysql update data ke kebiasaan
		$query = "UPDATE `kebiasaan` SET `nama_kebiasaan` = '$nama_kebiasaan', `status_kebiasaan` = '$status_kebiasaan', `waktu` = '$waktu', `ulang` = '$ulang', `deskripsi` = '$deskripsi' WHERE `id_kebiasaan` = $id";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Menghapus data kebiasaan berdasarkan id (default: hapus semua data)
	function hapus($id = ''){
		// Query mysql delete data ke kebiasaan
		$query = "DELETE FROM `kebiasaan`";

		// Jika ada masukan id kebiasaan
		if ($id!='') $query .= " WHERE `id_kebiasaan` = $id";

		// Mengeksekusi query
		return $this->execute($query);
	}

}

?>
