<?php 
	session_start();
	$_SESSION['logged'] = 0;
	header("Location: ".$_SESSION['base_url']);
?>