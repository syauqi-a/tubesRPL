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
include("../includes/Hadiah.class.php");

// Membuat objek dari kelas hadiah
$oHadiah = new Hadiah($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oHadiah->open();

if(isset($_COOKIE['id_akun'])){
	// melihat tabel hadiah
	$key = $_GET['key'];
	if(mysqli_num_rows($oHadiah->getRecord($_COOKIE['id_akun'], "", "", $key)) > 0){
		while($result = $oHadiah->getResult()){
			echo "<div class='row mb-2'>
                    <div class='col-sm-8 bg-primary rounded mr-2 pl-3'>
                      <div class='h2 pt-1 p-0 m-0 text-white'>{$result['nama_hadiah']}</div>
                      <div class='h3 p-0 m-0 text-white'>".(($result['deskripsi'] == "") ? "-" : $result['deskripsi'])."</div>
                    </div>
                    <button type='button' class='btn col-sm bg-success rounded mr-2 align-middle' onclick='editReward({$result['id_hadiah']})'>
                      <div class='row'>
                        <div class='col-sm p-0 m-0'>
                          <div class='icon icon-shape bg-success text-white rounded-circle shadow text-center' >
                             <i class='ni ni-ruler-pencil text-white' style='font-size: 2rem;'></i>
                          </div>
                        </div>
                        <div class='col-sm p-0 m-0'>
                          <h2 class='text-bottom text-white pt-2'> EDIT </h2>
                        </div>
                      </div>
                    </button>
                    <button type='button' class='btn col-sm bg-danger rounded mr-2 align-middle' onclick=\"confirmDelRwd({$result['id_hadiah']}, '{$result['nama_hadiah']}')\">
                      <div class='row'>
                        <div class='col-sm p-0 m-0'>
                          <div class='icon icon-shape text-white rounded-circle shadow text-center' >
                            <i class='ni ni-basket text-white' style='font-size: 2rem;'></i>
                          </div>
                        </div>
                        <div class='col-sm p-0 m-0'>
                          <h2 class='text-bottom text-white pt-2'> DELETE </h2>
                        </div>
                      </div>
                    </button>
                  </div>";
		}
	}
	else
		echo "<div style='text-align:center; color: black;'>
                <i class='far fa-frown' style='font-size: 4rem;'></i>
                <h4 style='margin-top:8px;'>Nothing Reward</h4>
              </div>";
}

// Menutup koneksi database
$oHadiah->close();

?>