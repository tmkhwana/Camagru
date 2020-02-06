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
        <form action="../controllers/forgotpasswd.php" method="post">
            <p>Email:</p>
                <input type="email" name="email address" placeholder="email" required/><br />
                <input type="submit" name="reset-password" value="send email"/>
        </form>
        <?php
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            //find the first occurance of ..."
            if (strpos($url, "sent") == true)
            {
                echo "<br />Check your email ";
            }
        ?>
    </div>
    </body>
</html>