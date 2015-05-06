<?php
session_start();

include '../includes/database/Database.php';
include '../includes/entities/Guide.php';
include '../includes/model/GuideModel.php';

if(isset($_SESSION['username']) && isset($_SESSION['code_section'])) {

    if(isset($_GET['status']) && ($_GET['status']==Guide::STATUS_ON || $_GET['status']==Guide::STATUS_OFF)) {

        $db = new Database("../includes/database/config.xml");
        $gm = new GuideModel($db);

        $array = $gm->updateGuide(new Guide($_SESSION['code_section'],$_GET['status']));
    }
}
else
{
    echo "Vous n'êtes pas authentifié";
}
