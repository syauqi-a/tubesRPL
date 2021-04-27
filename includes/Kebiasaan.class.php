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
	function tambah($nama_kebiasaan = '', $status_kebiasaan = '', $waktu = '', $ulang = '', $deskripsi = ''){
		// Query mysql insert ke kebiasaan
		$query = "INSERT INTO `kebiasaan` (`nama_kebiasaan`, `status_kebiasaan`, `waktu`, `ulang`, `deskripsi`) VALUES ('{$nama_kebiasaan}', '{$status_kebiasaan}', '{$waktu}', '{$ulang}', '{$deskripsi}')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data kebiasaan
	function getRecord($id = ''){
		// Query mysql select data ke kebiasaan
		$query = "SELECT * FROM `kebiasaan`";

		// Jika ada masukan id kebiasaan
		if($id != '') $query .= " WHERE id_kebiasaan = " . $id;

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data kebiasaan berdasarkan status kebiasaan
	function getRecordByStatus($status){
		// Query mysql select data ke kebiasaan
		$query = "SELECT * FROM `kebiasaan` WHERE status_kebiasaan = '{$status}'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Memperbarui data kebiasaan
	function ubah($id, $nama_kebiasaan = '', $status_kebiasaan = '', $waktu = '', $ulang = '', $deskripsi = ''){
		// Query mysql update data ke kebiasaan
		$query = "UPDATE `kebiasaan` SET `nama_kebiasaan` = '{$nama_kebiasaan}', `status_kebiasaan` = '{$status_kebiasaan}', `waktu` = '{$waktu}', `ulang` = '{$ulang}', `deskripsi` = '{$deskripsi}' WHERE `id_kebiasaan` = {$id}";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Menghapus data kebiasaan berdasarkan id (default: hapus semua data)
	function hapus($id = ''){
		// Query mysql delete data ke kebiasaan
		$query = "DELETE FROM `kebiasaan`";

		// Jika ada masukan id kebiasaan
		if ($id!='') $query .= " WHERE `id_kebiasaan` = ".$id;

		// Mengeksekusi query
		return $this->execute($query);
	}

}

?>
