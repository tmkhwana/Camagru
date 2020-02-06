<?php include('nav.php'); ?>
<html>
    <head>
        <title>Login</title>
        <link rel= "stylesheet" type= "text/css" href= "../css/login_style.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <body>
        <!-- <div class="menu-bar">
        <ul>
            <li class="active"><a href="#"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="#"><i class="fa fa-picture-o"></i>Gallery</a></li>
            <li><a href="#"><i class="fa fa-user"></i>About</a></li>
            <li><a href="#"><i class="fa fa-clone"></i>Register</a></li>
        </ul>
        </div> -->

        <div class="loginbox">
            <img src="../img/camlogo.png" class="loginIcon">
            <h1>Login</h1>
            <form action="../controllers/login.php" method="post">
                Username:<input type="text" name="username" placeholder="Enter Username" required/><br />
                Password:<input type="password" name="password" placeholder="Enter Password" required/><br />
                    <input type="submit" name="login" value="login">
                    <a href="forgotpasswd.php">Forgot your password?</a><br>
                    <a href="register.php">Don't have an account?</a>   
            </form>
        </div>
    </body>
    </head>
</html>