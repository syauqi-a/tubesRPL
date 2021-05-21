<?php

/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
******************************************/

class Akun extends DB{

	// Menambahkan data akun
	function tambah($nama_lengkap = '', $username = '', $email = '', $password = '', $jenis_kelamin = ''){
		// Query mysql insert data ke akun
		$query = "INSERT INTO `akun` (`nama_lengkap`, `username`, `email`, `password`, `jenis_kelamin`) VALUES ('{$nama_lengkap}', '{$username}', '{$email}', '{$password}', '{$jenis_kelamin}')";

		// Mengeksekusi query
		if($this->execute($query)){
			// Query mysql insert data alamat akun
			$query = "INSERT INTO `alamat` (`id_akun`) VALUES ({$this->getLastID()})";

			// Mengeksekusi query
			return $this->execute($query);
		}
	}

	// Mengambil data akun
	function getRecord($id = ''){
		// Query mysql select data ke akun
		$query = "SELECT a.*, b.* FROM `akun` a, `alamat` b WHERE a.`id_akun` = b.`id_akun`";

		// Jika ada masukan id akun
		if ($id!='') $query .= " AND a.`id_akun` = ".$id;

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Memperbarui data akun
	function ubah($id, $nama_lengkap = '', $email = '', $telepon = '', $jalan = '', $kota = '', $kodePos = ''){
		// Query mysql update data ke akun
		$query = "UPDATE `akun` SET `nama_lengkap` = '{$nama_lengkap}', `email` = '{$email}', `telepon` = '{$telepon}' WHERE `id_akun` = {$id}";

		// Mengeksekusi query
		if($this->execute($query)){
			// Query mysql update data alamat akun
			$query = "UPDATE `alamat` SET `jalan` = '{$jalan}', `kota` = '{$kota}', `kodePos` = '{$kodePos}' WHERE `id_akun` = {$id}";

			// Mengeksekusi query
			return $this->execute($query);
		}
		else return $this->execute($query);
	}

	// Menghapus data akun berdasarkan id (default: hapus semua data)
	function hapus($id = ''){
		// Query mysql delete data ke akun
		$query = "DELETE FROM `akun`";

		// Jika ada masukan id akun
		if ($id!='') $query .= " WHERE `id_akun` = ".$id;

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Memperbarui data akun
	function ubahFoto($id, $foto_profil = ''){
		// Query mysql update data ke akun
		$query = "UPDATE `akun` SET `foto_profil` = '{$foto_profil}' WHERE `id_akun` = {$id}";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Memperbarui data akun
	function login($username = '', $password = ''){
		// Query mysql update data ke akun
		$query = "SELECT * FROM `akun` WHERE `username` = '{$username}'";
		// Jika ada masukan password
		if ($password != '') $query .= " AND `password` = '{$password}'";
		// Mengeksekusi query
		return $this->execute($query);
	}

}

?>
