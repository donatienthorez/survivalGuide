<?php
	session_start();
	header('Content-Type: application/json; charset=utf-8');

	include '../includes/database/Database.php';
	include '../includes/entities/Category.php';
	include '../includes/model/CategoryModel.php';

	if(isset($_SESSION['username']) && isset($_SESSION['code_section']))
	{

		$db = new Database("../includes/database/config.xml");
		$cs = new CategoryModel($db);
		$array = $cs->getCategories($_SESSION['code_section']);
		$json = json_encode($array);
		echo $json;

	}

