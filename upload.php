<?php
	if(!isset($_POST["Access"])) {
		die('Direct access not permitted');
	}
	define('Access', TRUE);
	require_once("config.php");
	$output;
	if (empty($_FILES['images'])) {
		echo json_encode(['error'=>'No files found for upload.']); 
	}
	else{
		$images = $_FILES['images'];
		$id = $_POST["id"];
		
		$ext = explode('.', basename($images['name']));
		$filename = $id . "." . array_pop($ext);
		$target = null;
		if($_POST["role"] == "Company"){
			$target = "img/company/" . $filename;
		}
		else{
			$target = "img/user/" . $filename;
		}
		
		if(move_uploaded_file($images['tmp_name'], $target)) {
			$db->where ('id', $id);
			if($_POST["role"] == "Company"){
				$data = Array ('logo' => $filename);
				if ($db->update ('company', $data)){
					$output = ['uploaded' => 'Success'];
				}
				else{
					$output = ['error'=>'Error while uploading images. Contact the system administrator'];
				}
			}
			else{
				$data = Array ('foto' => $filename);
				if ($db->update ('user', $data)){
					$output = ['uploaded' => 'Success'];
				}
				else{
					$output = ['error'=>'Error while uploading images. Contact the system administrator'];
				}
			}
		} else {
			$output = ['error'=>'Error while uploading images. Contact the system administrator'];
			unlink($target);
		}
		echo json_encode($output);
	}
	
?>