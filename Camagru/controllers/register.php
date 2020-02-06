<?php

if (isset($_POST['submit-signup']))
{
	session_start();
	require('../config/connection.php');
	include_once('../models/model.php');

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password1 = $_POST['passwd1'];
	$password2 = $_POST['passwd2'];
	$password = hash('sha1', $password1);
			
	$exists = FALSE;
	//check for the password strength 
	$upper = preg_match('@[A-Z]@', $password1);
	$lower = preg_match('@[a-z]@', $password1);
	$Digits   = preg_match('@[0-9]@', $password1);
	$Chars = preg_match('@[^\w]@', $password1);

	if(!$upper || !$lower || ! $Digits || !$Chars || strlen($password1) < 8) 
	{
		header("location:../views/register.php?pass");
		die();
	}
	if ($password1 != $password2)
	{
		header("location:../views/register.php?empty");
		die();
	}
	//check if the email entered is of the correct format
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("location:../views/register.php?email");
		die();
	}
	else if (!preg_match("/[a-z]/", $username))
	{
		header("location:../views/register.php?user");
		die();
	}
	else
	{
		header("location:../views/register.php?success");
	}
	
	try
	{
		
		$results = $dataModel->userExist($username, $email);
				
		if ($results)
		{
			$exists = TRUE;
			echo 'Username already exits';
		}
		else
		{
			echo "account created";
			$vkey = hash('sha1', $username);
		}

		} catch (PDOException $e)
		{
			echo $e->getMessage();
		}
}



	if (!$exists){

		try{
			$results = $dataModel->adduser($username, $email, $password, $vkey);
			echo 'successfull <br />';
			
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
?>