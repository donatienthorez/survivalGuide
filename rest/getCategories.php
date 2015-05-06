<?php
	session_start();
	header('Content-Type: application/json; charset=utf-8');

	include '../includes/database/Database.php';
	include '../includes/entities/Category.php';
	include '../includes/model/CategoryModel.php';
    include '../includes/entities/Guide.php';
    include '../includes/model/GuideModel.php';

    $db = new Database("../includes/database/config.xml");
    $cs = new CategoryModel($db);
    $gm = new GuideModel($db);

    $code_section = (isset($_GET['code_section'])) ?  $_GET['code_section'] : $_SESSION['code_section'];

	if((isset($_GET['code_section']) && $gm->isActivated($code_section)) ||  (isset($_SESSION['username']) && isset($_SESSION['code_section']))) {
        $array = $cs->getCategories($code_section);
    }
    else
    {
        $array=array();
        $array['categories'] = $array;
    }

    $json = json_encode($array);
    echo $json;
