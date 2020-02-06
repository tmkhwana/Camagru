<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

	// require('../config/connection.php');
	session_start();
	include_once('../models/model.php');
	
	$id = $_SESSION['id'];
	$pass = $_POST['password'];

	if (isset($_POST['username']))
	{
		//Check if the user is valid, check if the password is correct then upadate username
		$username = $_POST['u_username'];
		if (validateUser($username) && $dataModel->validatePass(hash('sha1', $pass), $id)){
			$result = $dataModel->updateuser($id, $username);
			$_SESSION['error'] = "your username has been updated";
		}
		else{
			$_SESSION['error'] = "invalid password";
		}
	}
	//Check if the password is valid then upadate the email
	else if (isset($_POST['email']))
	{
		$email = $_POST['u_email'];
		if ($dataModel->validatePass(hash('sha1', $pass), $id)){
			try{
				$dataModel->updatemail($email, $id);
				$info = $dataModel->getuserinfo($id);
				$vkey = $info['vkey'];
				
				$msg= "click the link to verify your account: http://127.0.0.1:8080/Camagru/controllers/confirm.php?ver_code=$vkey
					";
				$headers = array(
					'From: noreply');
	
				mail($email, "Verification email", $msg, implode("\r\n",$headers));
				echo "<br />Check your email ";
	
			} catch (PDOException $e){
				echo $e->getMessage();
			}
		}
	}
	//Check if the password is valid then update notification preference
	else if (isset($_POST['notifications']))
	{
		$notifications = $_POST['u_notifications'];
		if ($dataModel->validatePass(hash('sha1', $pass), $id)){
			if ($notifications == 0 || $notifications == 1){
				$dataModel->updatenotification($notifications, $id);
				$_SESSION['error'] = "your notification preference has been updated";
			}
			else {
				$_SESSION['error'] = "invalid response - has to be 1 or 0";
			}
			
		}
	}

	//Check if the password is valid then update the pasword from the old one to the new one 
	else if (isset($_POST['passwd']))
	{
		$password = hash('sha1', $_POST['newpasswd']);
		if ($dataModel->validatePass(hash('sha1', $pass), $id)){
			$dataModel->updatepassword($password, $id);
			$_SESSION['error'] = "your password has been updated";
		}
		else {
			$_SESSION['error'] = "wrong passsword";
		}
	}
	var_dump($_POST);
	
	//check if password is valid
	function validatePass($password){ 
		if (!preg_match("/[a-z]/", $password)){
			$_SESSION['error'] = "must contain lowercase";
			header("location:../views/register.php");
		}

		if (!preg_match("/[A-Z]/", $password)){
			$_SESSION['error'] = "must contain uppercase";
			header("location:../views/register.php");
		}

		if (!preg_match("/[0-9]/", $password)){
			$_SESSION['error'] = "must contain lowercase";
			header("location:../views/register.php");
		}

		if (strlen($password)< 8){
			$_SESSION['error'] = "Password too short";
			header("location:../views/register.php");
		}
		return (true);
	}

	//check if username is valid
	function validateUser($username){
		global $dataModel;

		if($dataModel->userExist($username, "")){
			$_SESSION['error'] = "Username already taken";
			header("location:../views/profUpdate.php");
		}
	
		if (strlen($username)< 6){
			$_SESSION['error'] = "Username too short";
			header("location:../views/profUpdate.php");
		}

		return true;
	}
	header("location:../views/profUpdate.php");
?>