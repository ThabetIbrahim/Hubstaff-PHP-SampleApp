<?php 
	session_start();
	$_SESSION['logged'] = 1;
	header("Location: ".$_SESSION['base_url']."?page=pages/dashboard");
?>