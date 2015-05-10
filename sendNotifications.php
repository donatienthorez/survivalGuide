<?php 
	
	include 'includes/connection/session.php';
	include 'includes/database/Database.php';
	include 'includes/entities/Pushes.php';
	include 'includes/entities/RegId.php';
	include 'includes/entities/Member.php';
	include 'includes/model/NotificationModel.php';
	include 'includes/model/MemberModel.php';

	$db = new Database("includes/database/config.xml");
	$ns = new NotificationModel($db);
	$ms = new MemberModel($db);

	if(isset($_SESSION['username']) && isset($_SESSION['code_section'])) {
		if(isset($_POST['subject']) && $_POST['subject']!="" && isset($_POST['message']) && isset($_POST['message'])) {

                if($ms->getRole($_SESSION['username'])==Member::ROLE_ADMIN)
                {
                    switch($_SESSION['code_section'])
                    {
                        case "ALL":
                            $regIds = $ns->getAllRegIds();
                            break;
                        case "FR":
                            $regIds = $ns->getCountryRegIds("FR");
                            break;
                        case "DEV":
                            $regIds = $ns->getRegIds($_SESSION['code_section']);
                            break;
                        default:
                            $regIds = $ns->getRegIds($_SESSION['phpCAS']['attributes']['sc']);
                    }
                }
                else
                {
                    $regIds = $ns->getRegIds($_SESSION['code_section']);
                }

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



