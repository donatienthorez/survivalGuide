<?php
    session_start();

    include '../includes/database/Database.php';
    include '../includes/entities/Category.php';
    include '../includes/model/CategoryModel.php';

    if(isset($_SESSION['username']) && isset($_SESSION['code_section'])) {

        if(isset($_GET['id']) && $_GET['id']!="") {

        $db = new Database("../includes/database/config.xml");
        $cs = new CategoryModel($db);

        $array = $cs->deleteCategory($_GET['id'],$_SESSION['code_section']);
        }
    }
    else
    {
        echo "Vous n'êtes pas authentifié";
    }
