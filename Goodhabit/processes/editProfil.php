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
include("../includes/Akun.class.php");

// Membuat objek dari kelas Akun
$oAkun = new Akun($db_host, $db_user, $db_password, $db_name);

// open koneksi
$oAkun->open();

if(isset($_GET['id_akun'])){
	// melihat data akun
	$id_akun = $_GET['id_akun'];
	$data = null;
	if(mysqli_num_rows($oAkun->getRecord($id_akun)) > 0){
		$result = $oAkun->getResult();
		echo "<div style='text-align: center; margin: 24px;'>
				<h1 class='text-success'><b>Edit Profile</b></h1>
				<div style='margin: 24px 0'>
				  <form id='form-photo' method='post' enctype='multipart/form-data'>
					<img src='".(($result['foto_profil'] != "") ? "../assets/uploads/p-profiles/".$result['foto_profil'] : "../assets/img/theme/dummy-man.png")."' style='background: #e9ecef; width: 125px; height: 125px; object-fit: cover; cursor: pointer' class='rounded-circle border border-white' id='edit-photo-profile' onclick='changePhoto();' title='Click here to change photo'/>
					<input name='fphoto' type='file' id='fphoto' style='display:none' accept='image/*' onchange='savePhoto();'/>
					<input id='save-photo' type='submit' onclick='submitPhoto(event, {$result['id_akun']})' hidden>
				  </form>
				</div>
				<form id='form-edit'>
				  <input type='text' name='id_akun' value='{$result['id_akun']}' hidden/>
				  <div class='form-group mb-1'>
					<input type='text' class='form-control bdr-round inputan' name='fname' title='Input your full name here' value='{$result['nama_lengkap']}' required>
				  </div>
				  <div class='form-group mb-1'>
					<input type='email' class='form-control bdr-round inputan' name='email' title='Input your email here' value='{$result['email']}' required>
				  </div>
				  <div class='form-group mb-1'>
					<input type='tel' class='form-control bdr-round inputan' name='phone' title='Input your phone here' ".(($result['telepon'] == "") ? "placeholder='Phone'" : "value='{$result['telepon']}'").">
				  </div>
				  <div class='form-grou mb-1'>
					<input type='text' class='form-control bdr-round inputan' name='street' title='Input your street address here' ".(($result['jalan'] == "") ? "placeholder='Street'" : "value='{$result['jalan']}'").">
				  </div>
				  <div class='form-group mb-1'>
					<input type='text' class='form-control bdr-round inputan' name='city' title='Input your city here' ".(($result['kota'] == "") ? "placeholder='City'" : "value='{$result['kota']}'").">
				  </div>
				  <div class='form-group mb-3'>
					<input type='text' pattern='[0-9]{5}' class='form-control bdr-round inputan' name='postal' title='Input your 5 digit postal code here' ".(($result['kodePos'] == "") ? "placeholder='Postal code'" : "value='{$result['kodePos']}'").">
				  </div>
				  <button type='submit' name='update-profile' id='btn-update' class='btn btn-lg bg-green text-white bdr-round' style='padding: 8px 40px;' title='Click here to update profile' onclick='updateProfile(event, {$result['id_akun']})' /><b><span style='font-size:20px;'>Update</span></b></button>
				</form>
			  </div>";
	}
	else
		echo "failed";
}
else 
	echo "failed";

// Menutup koneksi database
$oAkun->close();

?>