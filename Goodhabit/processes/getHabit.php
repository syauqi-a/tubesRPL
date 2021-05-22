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
include("../includes/Kebiasaan.class.php");

// Membuat objek dari kelas kebiasaan dan rekap kebiasaan
$oKebiasaan = new Kebiasaan($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oKebiasaan->open();

if(isset($_COOKIE['id_akun'])){
	// melihat tabel kebiasaan
	$id_akun = $_COOKIE['id_akun'];
	$key = $_GET['key'];
	$sbTime = $_GET['sortByTime'];
	if(mysqli_num_rows($oKebiasaan->getRecord($id_akun, '', true, $key, $sbTime)) > 0){
		while($result = $oKebiasaan->getResult()){
			// membuat text jam
			$temp = explode(":", $result['waktu']);
			$waktu = $temp[0].".".$temp[1];

			echo "<div class='container text-white mb-2'>
                    <div class='row'>
                      <div class='col-sm-8 bg-primary rounded mr-2 pl-3'>
                        <div class='h2 pt-1 p-0 m-0 text-white'>{$result['nama_kebiasaan']}</div>
                        <div class='h3 p-0 m-0 text-white'>$waktu</div>
                      </div>
                      <button type='button' class='btn col-sm bg-success rounded mr-2 align-middle' onclick='editHabit({$result['id_kebiasaan']})'>
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
                      <button type='button' class='btn col-sm bg-danger rounded mr-2 align-middle' onclick=\"confirmDelHabit({$result['id_kebiasaan']}, '{$result['nama_kebiasaan']}')\">
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
                </div>
              </div>";
		}
	}
	else
		echo "<div class='container mb-2'>
                <div style='text-align:center;'>
                  <i class='far fa-frown' style='font-size: 4rem;'></i>
                  <h4 style='margin-top:8px;'>Nothing Habit</h4>
                </div>
              </div>";
}

// Menutup koneksi database
$oKebiasaan->close();

?>