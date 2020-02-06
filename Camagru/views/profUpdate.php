<?php
include('nav.php');
session_start();
if (!isset($_SESSION['id'])){
    header("location:publicGall.php");
    exit();
}
?>

<html>

<head>
	<title>Update Form</title>
	<link rel="stylesheet" type="text/css" href="../css/login_style.css">

</head>

<Body>
	<div class="loginbox">
	<img src="../img/camlogo.png" class="loginIcon">
		<h1>Update Info</h1>
		<form action="../controllers/profUpdate.php" method="POST">

			<select id = "myList" onChange="myFunction(value)" style="margin: 0 0 20 calc(50% - 50px)">
				<option value = "select_update" >Update OPTION</option>
				<option value = "username" >UserName</option>
				<option value = "passwd" >Password</option>
				<option value = "email" >Email</option>
				<option value = "notifications" >Notifications</option>
			</select>

			<input type="password" id='pass' name='password' placeholder='current password' required hidden>
			<input type="text" id='update' name='' placeholder='' required hidden>
			<input type="password" id='verify' name='verifypass' placeholder='verify password' required hidden>
			<input type="submit" id = "but" name='' value="Update Info" hidden>
		</form>

		<?php
			if (!empty($_SESSION['error'])){
				echo $_SESSION['error'];
				$_SESSION['error'] = '';
			}
		?>
	</div>

	<script>
        function myFunction(value){
			let toUpdate = document.getElementById("update");
			toVerify = document.getElementById("verify");

			toUpdate.hidden = false;
			toUpdate.placeholder = 'update ' + value;

			toVerify.hidden = true;
			toVerify.required = false;
			
			document.getElementById("pass").hidden = false;
			document.getElementById("but").name = value;
			document.getElementById("but").hidden = false;

            if (value === 'email'){
				toUpdate.name = 'u_' + value;
				toUpdate.type = 'email';

            } else if(value === 'username') {
				toUpdate.name = 'u_' + value;
				toUpdate.type = 'text';
			} else if(value === 'passwd'){
				toUpdate.name = 'new' + value;
				toUpdate.placeholder = 'new password';
				toUpdate.type = 'password';
				toVerify.hidden = false;
				toVerify.required = true;
			} else if(value === 'notifications'){
				toUpdate.name = 'u_' + value;
				toUpdate.placeholder = 'write 1 to activate or 0 to deactivate';
				toUpdate.type = 'text';
			}
        }
	</script>
</Body>

</html>