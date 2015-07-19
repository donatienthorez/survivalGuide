<?php
ini_set("include_path", '/home/esnlille/php:' . ini_get("include_path"));

    //	include 'session.php';
    include 'CAS.php';
    include '../database/Database.php';
    include '../entities/Member.php';
    include '../entities/Guide.php';
    include '../model/MemberModel.php';
    include '../model/GuideModel.php';

    // Enable debugging
    phpCAS::setDebug("debug.txt");
    // Initialize phpCAS

    phpCAS::client(CAS_VERSION_2_0, "galaxy.esn.org", 443, "/cas");


    phpCAS::setNoCasServerValidation();
    // force CAS authentication
    phpCAS::forceAuthentication();
    // at this step, the user has been authenticated by the CAS server
    // and the user's login name can be read with phpCAS::getUser().
    // logout if desired

    $user = phpCAS::getUser();
    $attributes = phpCAS::getAttributes();


    if (in_array("Local.regularBoardMember", $attributes['roles'])) {
        if (isset($user)) {

            $_SESSION['username'] = phpCAS::getUser();
            $_SESSION['cas'] = true;

            $_SESSION['code_section'] = $attributes['sc'];

            $db = new Database("../database/config.xml");
            $ms = new MemberModel($db);
            $gm = new GuideModel($db);
            $ms->addMember(new Member($_SESSION['username'], $attributes['mail'], $_SESSION['code_section'], "member"));
            $_SESSION['role'] = $ms->getRole($_SESSION['username']);

            if ($gm->getGuide($_SESSION['code_section']) == null) {
                $gm->addGuide(new Guide($_SESSION['code_section']));
            }

            header("Location: ../../guide.php");
        }
    }
    header("Location: ../../index.php");


