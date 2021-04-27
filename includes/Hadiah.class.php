<?php 

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/

class Hadiah extends DB{

	// Menambahkan data hadiah
	function tambah($nama_hadiah = '', $kode_hadiah = '', $deskripsi = '', $id_kebiasaan = ''){
		// Query mysql insert ke hadiah
		$query = "INSERT INTO `hadiah` (`nama_hadiah`, `kode_hadiah`, `deskripsi`, `id_kebiasaan`) VALUES ('{$nama_hadiah}', '{$kode_hadiah}', '{$deskripsi}', '{$id_kebiasaan}')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data hadiah
	function getRecord($id = ''){
		// Query mysql select data ke hadiah
		$query = "SELECT * FROM `hadiah`";

		// Jika ada masukan id hadiah
		if($id != '') $query .= " WHERE id_hadiah = " . $id;

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Memperbarui data hadiah
	function ubah($id, $nama_hadiah = '', $kode_hadiah = '', $deskripsi = '', $id_kebiasaan = ''){
		// Query mysql update data ke hadiah
		$query = "UPDATE `hadiah` SET `nama_hadiah` = '{$nama_hadiah}', `kode_hadiah` = '{$kode_hadiah}', `deskripsi` = '{$deskripsi}', `id_kebiasaan` = '{$id_kebiasaan}' WHERE `id_hadiah` = {$id}";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Menghapus data hadiah berdasarkan id (default: hapus semua data)
	function hapus($id = ''){
		// Query mysql delete data ke hadiah
		$query = "DELETE FROM `hadiah`";

		// Jika ada masukan id hadiah
		if ($id!='') $query .= " WHERE `id_hadiah` = ".$id;

		// Mengeksekusi query
		return $this->execute($query);
	}

}

?>
