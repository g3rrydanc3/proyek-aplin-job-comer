<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once(__DIR__ . '/../header.php');
	
	if(!strlen($_SESSION["current"]) == 0 && !is_numeric($_SESSION["role"])){	//company login
		if(!isset($_GET["id"])){
			require_once("profile/myprofile.php");
		}
		else{
			header("location:http://". getFolderUrl() ."company.php" . passingGet());
		}
	}
	else{	//student or guest
		if(!isset($_GET["id"])){
			header("location:http://". getFolderUrl() ."error.php");
		}
		else{
			require_once("profile/profile.php");
		}
	}
	require_once(__DIR__ . '/../header.php');
	
?>