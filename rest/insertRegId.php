<?php
	session_start();
	
	include '../includes/database/Database.php';
	include '../includes/entities/Pushes.php';
	include '../includes/entities/RegId.php';
	include '../includes/model/NotificationModel.php';

	
	$db = new Database("../database/config.xml");
	$ns = new NotificationModel($db);

	if(isset($_POST['regId']) && isset($_POST['CODE_SECTION'])){
		
		$db = new Database("../database/config.xml");
		$ns = new NotificationModel($db);
		$ns->addRegId(new RegId($_POST['regId'],$_POST['CODE_SECTION']));
	}

?>
