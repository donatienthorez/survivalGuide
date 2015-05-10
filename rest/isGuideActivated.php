<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

include '../includes/database/Database.php';
include '../includes/entities/Guide.php';
include '../includes/model/GuideModel.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);

if(isset($_SESSION['username']) && isset($_SESSION['code_section'])) {

        $db = new Database("../includes/database/config.xml");
        $gm = new GuideModel($db);
        $array['isActivated'] = $gm->getGuide($_SESSION['code_section'])->isActivated();
        echo json_encode($array);

}
else
{
    echo "Vous n'êtes pas authentifié";
}
