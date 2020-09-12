<?php
	session_start();
	if(!$_SESSION['idUsuario']) {
		header('Location: ../../view/pages/login.php');
		exit();
	}
?>