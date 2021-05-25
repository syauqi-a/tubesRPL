<?php


/******************************************
Tubes RPL - Kelompok 7
 o Samuel Nelson (1901584)
 o Alya Chairunnisa Faz (1908324)
 o Hendi Yahya (1902370)
 o Khamidah Ahmad Syauqi (1904312)
 ******************************************/

class DB{
	var $db_host = ''; // host
	var $db_user = ''; // user basis data
	var $db_password = ''; // password
	var $db_name = ''; // nama basis data
	var $db_link = ''; // connection
	var $result = 0;

	function DB($db_host='', $db_user='', $db_password='', $db_name=''){
		// konstruktor
		$this->db_host = $db_host;
		$this->db_user = $db_user;
		$this->db_password = $db_password;
		$this->db_name = $db_name;
	}

	function open(){
		// membuka koneksi
		$this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_name);
	}

	function execute($query=""){
		//echo $query."<br/>";
		// mengeksekusi query
		$this->result = mysqli_query($this->db_link, $query);

		return $this->result;
	}

	function getResult(){
		// mengambil ekseskusi query
		return mysqli_fetch_assoc($this->result);
	}

	function getAffectedRows(){
		// mengembalikan nilai baris yang terpengaruh
		return ($this->db_link->affected_rows);
	}

	function getLastID(){
		// mengambil ID dari data terakhir yang ditambahkan
		return $this->db_link->insert_id;
	}

	function close(){
		// menutup koneksi
		mysqli_close($this->db_link);
	}
}

?>