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
	function tambah($nama_hadiah = '', $kode_hadiah = '', $deskripsi = '', $period = '', $id_akun = ''){
		// Query mysql insert ke hadiah
		$query = "INSERT INTO `hadiah` (`nama_hadiah`, `kode_hadiah`, `deskripsi`, `period`, `id_akun`) VALUES ('$nama_hadiah', '$kode_hadiah', '$deskripsi', '$period', '$id_akun')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data hadiah
	function getRecord($id_akun = '', $period = '', $id = '', $key = ''){
		// Query mysql select data ke hadiah
		$query = "SELECT * FROM `hadiah`";

		$temp = ""; // penampung klausa dibelakang WHERE

		// Jika ada masukan id akun
		if($id != '') $temp = "id_hadiah = $id";

		// Jika ada masukan id akun
		if($id_akun != '') $temp .= (($temp != '') ? " AND " : "")."id_akun = $id_akun";

		// Jika ada masukan periode
		if($period != '') $temp .= (($temp != '') ? " AND " : "")."`period` LIKE '$period%'";

		// Jika ada masukan kata kunci pencarian nama hadiah
		if($key != '') $temp .= (($temp != '') ? " AND " : "")."`nama_hadiah` LIKE '%$key%'";

		// Mengeksekusi query
		return $this->execute($query.(($temp != "") ? " WHERE $temp" : ""));
	}

	// Memperbarui data hadiah
	function ubah($id, $nama_hadiah = '', $kode_hadiah = '', $deskripsi = '', $period = ''){
		// Query mysql update data ke hadiah
		$query = "UPDATE `hadiah` SET `nama_hadiah` = '$nama_hadiah', `kode_hadiah` = '$kode_hadiah', `deskripsi` = '$deskripsi', `period` = '$period' WHERE `id_hadiah` = $id";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengirim hadiah kepada user
	function sendTo($id, $id_akun = ''){
		// Query mysql update data ke hadiah
		$query = "UPDATE `hadiah` SET `id_akun` = '$id_akun' WHERE `id_hadiah` = $id";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengirim hadiah kepada user
	function claim($id, $period = ''){
		// Query mysql update data ke hadiah
		$query = "UPDATE `hadiah` SET `claim` = 'n' WHERE `id_akun` = $id AND `period` LIKE '$period%'";

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
