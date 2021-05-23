<?php

	if(isset($_COOKIE['id_akun'])){
		if($_COOKIE['id_akun'] == 1)
			echo true;
		else
			echo false;
	}
	else
		echo false;

?>