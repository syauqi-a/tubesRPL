<?php

	if(isset($_COOKIE['id_akun'])){
		if($_COOKIE['id_akun'] == 1)
			header("location:admin/home.html");
		else
			header("location:home.html");
	}
	else
		header("location:../login.html");

?>