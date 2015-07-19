<?php

    include '../database/Database.php';
    include '../entities/RegId.php';
    include '../entities/Pushes.php';
    include '../model/NotificationModel.php';

    if(isset($_POST["regId"]) && isset($_POST["CODE_SECTION"])) {

        $db = new Database("../database/config.xml");
        $ns = new NotificationModel($db);

        $ns->addRegId(new RegId($_POST['regId'],$_POST['CODE_SECTION']));

        echo "Reg Id ajouté avec succès";
    }
