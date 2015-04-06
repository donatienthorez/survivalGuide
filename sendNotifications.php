<?php 
	
	include 'includes/connection/session.php';
	include 'includes/database/Database.php';
	include 'includes/entities/Pushes.php';
	include 'includes/entities/RegId.php';
	include 'includes/model/NotificationModel.php';

	$db = new Database("includes/database/config.xml");
	$ns = new NotificationModel($db);

	if(isset($_SESSION['username']) && isset($_SESSION['code_section'])) {
		if(isset($_POST['subject']) && $_POST['subject']!="" && isset($_POST['message']) && isset($_POST['message'])) {

			$regIds = $ns->getRegIds($_SESSION['code_section']);
			$ns->saveNotification($_POST['subject'],$_POST['message'],$_SESSION['code_section']);

			if(isset($regIds))
			{
				echo "subject :" . $_POST['subject'] . "\n";
				echo "msg : " . $_POST['message'] . "\n" ;
				$pushStatus = $ns->sendMessageThroughGCM($regIds,$_POST['subject'],$_POST['message']);
				echo "Notification envoyée" . "\n" ;
			}
		}
	}

	header("Location: /notifications.php");



