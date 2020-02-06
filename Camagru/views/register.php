<?php include('nav.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register</title>
    <link rel= "stylesheet" type= "text/css" href= "../css/login_style.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
	rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>

	<div class="loginbox">
		<img src="../img/camlogo.png" class="loginIcon">
		<h1>Sign Up</h1>
		<form  action="../controllers/register.php" method="POST">
			Username:<input type="text" placeholder="username" name="username" required/><br />
			Email:<input type="text" placeholder="email address" name="email" required/><br />
			Password:<input type="password" placeholder="password" name="passwd1" required/><br />
			Confirm password:<input type="password" placeholder="confirm" name="passwd2" required/><br /> 
			<input type="submit" name="submit-signup" value="Register" />
			<a href="login.php">Have an account?</a>  
		</form>
		<?php
		//error messages for the register 
			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			{	
				if (strpos($url, "pass") == true)
				{
					echo "<p>Password should be at least 8 characters in length and should include at least one upper case letter, 
					one number, and one special character</p>";
				}
				else if (strpos($url, "email") == true)
                {
                    echo "<p>Invalid Email</p>";
				}
				else if (strpos($url, "user") == true)
                {
                    echo "<p>Only Letters Allowed</p>";
				}
				else if (strpos($url, "success") == true)
                {
                    echo "<p>SUCCESS!!!! PLEASE CHECK YOUR EMAIL</p>";
                }
			}
		?>
	</div>
</body>
</html>