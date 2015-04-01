<?php
include 'includes/connection/session.php';

include 'includes/database/Database.php';
include 'includes/entities/Category.php';
include 'includes/model/CategoryModel.php';

var_dump($_SESSION);
var_dump($_POST);

if(isset($_SESSION['username']) && isset($_SESSION['code_section']))
{
    echo "test";
    if(isset($_POST['content']) && isset($_POST['title']) && $_POST['title']!="" && isset($_POST['id']))
    {

        $db = new Database("includes/database/config.xml");
        $cs = new CategoryModel($db);

        $cs->updateCategory($_POST['id'],utf8_decode($_POST['title']),utf8_decode($_POST['content']),$_POST['position'],$_SESSION['code_section']);
    }
}
header("Location: /guide.php");
