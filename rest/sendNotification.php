<?php
	session_start();

	include '../includes/database/Database.php';
	include '../includes/entities/Pushes.php';
	include '../includes/entities/RegId.php';
	include '../includes/model/NotificationModel.php';

	
	$db = new Database("../database/config.xml");
	$ns = new NotificationModel($db);

	//TEST POUR LE PUSH DEPUIS LA CREATION D'EVENT SUR LE SAT

	if (isset($_POST)){
		$string = implode(',', $_POST);
	    	$objet = explode(',', $string);

		$code_section = $objet[0];
		$subject = $objet[1];
		$message = $objet[2];

		$regIds = $ns->getRegIds($code_section);
		$ns->saveNotification($subject,$message,$code_section);

		if(isset($regIds))
		{
			echo "subject :" . $subject . "\n";
			echo "msg : " . $message . "\n" ;
			$pushStatus = $ns->sendMessageThroughGCM($regIds,$subject,$message);
			echo "Notification envoyée" . "\n" ;
		}
	}

