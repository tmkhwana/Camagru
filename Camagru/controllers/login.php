<?php
    session_start();
    //ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    require('../config/connection.php');
    include_once('../models/model.php');

    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password))
        {
            header("location:../views/login.php?Empty= Please Fill in the Blanks");
        }
        else
        {
            $password = hash('sha1', $password);

            $results = $dataModel->login($username, $password);

            if ($results)
            {
                $id = $dataModel->getId($username);
                $_SESSION['id'] = $id['id'];
                $_SESSION['username'] = $username;
                header("location:welcome.php");
            }
            else
            {
                header ("location:../views/login.php?Invalid= Please insert correct Username and Password");
            }
        }
    }
    else
    {
        echo "Something went wrong!";
    }
?>