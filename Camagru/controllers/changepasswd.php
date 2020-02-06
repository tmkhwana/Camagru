<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

    if(isset($_POST['reset-password'])){
        session_start();
        include('../models/model.php');

        //password 1 and 2 to compare the two to validate if they're corrrect or if they match
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if ($password1 == $password2){
            $userid = $_SESSION['userid'];
            $password = hash('sha1', $password1);
            $results = $dataModel->updatepassword($password, $userid);
            
            header('location:../views/login.php');
        }
        echo $password1 . " " . $password2;
    }

?>