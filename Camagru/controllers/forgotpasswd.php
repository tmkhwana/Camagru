<?php

    require('../config/connection.php');
    include_once('../models/model.php');
    if (isset($_POST['reset-password']))
    {
        $email = $_POST["email_address"];
        try
        {
            $results = $dataModel->getuserdetails($email);
            if ($results){
                $vkey = $results['vkey'];
                $msg= "click the link to verify your account: http://127.0.0.1:8080/Camagru/controllers/confirm.php?v_code=$vkey";
                $headers = array(
                    'From: noreply');


                mail($email, "Password Reset", $msg, implode("\r\n",$headers));
                echo "<br />Check your email ";
                header("location:../views/forgotpasswd.php?sent");
            }

		} catch (PDOException $e){
            echo $e->getMessage();
        }
    }
?>