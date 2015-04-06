<?php

	include 'session.php';
	include 'CAS.php';
	include '../database/Database.php';
	include '../entities/Member.php';
	include '../model/MemberModel.php';

	// Enable debugging
	phpCAS::setDebug();
	// Initialize phpCAS

	phpCAS::client(CAS_VERSION_2_0, "galaxy.esn.org", 443, "/cas");

	phpCAS::setNoCasServerValidation();
	// force CAS authentication
	phpCAS::forceAuthentication();
	// at this step, the user has been authenticated by the CAS server
	// and the user's login name can be read with phpCAS::getUser().
	// logout if desired

	$user = phpCAS::getUser();


	if (isset($user)) {

		$_SESSION['username'] = phpCAS::getUser();
		$_SESSION['cas'] = true;
		$attributes = phpCAS::getAttributes();
		$_SESSION['code_section']=$attributes['sc'];

	        $db = new Database("../database/config.xml");
	        $ms = new MemberModel($db);
	        $ms->addMember(new Member($_SESSION['username'],$attributes['mail'],$_SESSION['code_section'],"member"));
	        $_SESSION['role'] = $ms->getRole($_SESSION['username']);
		header('Location: /guide.php');
	}

	?>


