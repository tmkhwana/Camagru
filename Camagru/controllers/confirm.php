<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include('../models/model.php');

	if (isset($_GET['ver_code'])){
		$code = $_GET['ver_code'];

		$results = $dataModel->getuser($code);

		if ($results)
		{
			echo "Welcome to Camagru";
			$dataModel->verify($code);
			header("Location: ../views/login.php");
		}
	}
	else if(isset($_GET['v_code'])){
		session_start();
		$code = $_GET['v_code'];
		$results = $dataModel->verifycode($code);

		if ($results){
			$_SESSION['userid'] = $results['id'];
			header("location: ../views/changepasswd.php");
		}
		else
		{
			die ('invalid v_code');
		}
	}
?>