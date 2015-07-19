<?php

	session_start();
	
	// Annule les magic quotes si activées
	if(get_magic_quotes_gpc()) {
		function stripslashes_deep($value) {
			return (is_array($value)) ? array_map('stripslashes_deep', $value) : stripslashes($value);
		}
		$_GET    = array_map('stripslashes_deep', $_GET);
		$_POST   = array_map('stripslashes_deep', $_POST);
		$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
	}	

	if(!isset($_SESSION['username']) || !isset($_SESSION['code_section'])) {
		header('Location: index.php');
	}
	
