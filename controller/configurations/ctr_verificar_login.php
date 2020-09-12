<?php
	session_start();
	if(!$_SESSION['usuario']) {
		header('Location: ../../view/pages/login.php');
		exit();
	}
?>