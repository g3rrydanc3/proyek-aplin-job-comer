<?php
	//menghindari direct access header,footer,db,dll
	define('Access', TRUE);
	require_once("pages/header.php");
	
	if(strlen($_SESSION["current"]) == 0){
		if(!isset($GET["id"])){
			header("location:error.php");
		}
		else{
			require_once("profile/profile.php");
		}
	}
	else{
		if(!isset($_GET["id"])){
			require_once("profile/myprofile.php");
		}
		else{
			require_once("profile/profile.php");
		}
	}
	
	require_once("pages/footer.php");
?>