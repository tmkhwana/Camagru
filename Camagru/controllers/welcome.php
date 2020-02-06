<?php
    session_start();
    
    if(isset($_SESSION['user']))
        echo ' Welcome ' . $_SESSION['user'];
        header("location:../views/gallery.php");
?>