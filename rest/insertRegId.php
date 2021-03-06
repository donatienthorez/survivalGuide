<?php
    session_start();

    include '../includes/database/Database.php';
    include '../includes/entities/RegId.php';
    include '../includes/entities/Pushes.php';
    include '../includes/model/NotificationModel.php';

    $db = new Database("../includes/database/config.xml");

    if(isset($_GET["regId"]) && isset($_GET["code_section"])) {

        $db = new Database("../includes/database/config.xml");
        $ns = new NotificationModel($db);

        $ns->addRegId(new RegId($_GET['regId'],$_GET['code_section']));

        echo "Reg Id ajouté avec succès";
    }
