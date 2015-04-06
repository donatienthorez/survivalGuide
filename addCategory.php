<?php
    include 'includes/connection/session.php';

    include 'includes/database/Database.php';
    include 'includes/entities/Category.php';
    include 'includes/model/CategoryModel.php';

    if(isset($_SESSION['username']) && isset($_SESSION['code_section'])) {
        if(isset($_POST['title']) && $_POST['title']!="" && isset($_POST['parent'])) {
            $db = new Database("includes/database/config.xml");
            $cs = new CategoryModel($db);
            $cs->addCategory($_POST['parent'],utf8_decode($_POST['title']),$_SESSION['code_section']);
        }
    }

    header("Location: /guide.php");
