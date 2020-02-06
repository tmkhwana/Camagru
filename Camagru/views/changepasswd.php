<?php include('nav.php'); ?>
<html>
    <head>
    <title>ForotPassword</title>
    <link rel= "stylesheet" type= "text/css" href= "../css/login_style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
    rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
    <div class="loginbox">
            <img src="../img/camlogo.png" class="loginIcon">
        <h1>Password Reset</h1>
        <form action="../controllers/changepasswd.php" method="post">
            <p>Password:</p>
                <input type="password" name="password1" placeholder="Enter Password" required/>
            <p>Confirm Password:</p>
                <input type="password" name="password2" placeholder="Confirm Password" required/>
                <input type="submit" name="reset-password" value="Reset Password"/>
        </form>
    </div>
    </body>
</html>