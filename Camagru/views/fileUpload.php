<?php
require('../models/model.php');
include('nav.php');
session_start();
if (!isset($_SESSION['id'])){
    header("location:publicGall.php");
    exit();
}
    if(isset($_SESSION['error']))
        echo $_SESSION['error'];
    $_SESSION['error'] = '';
    
?>

<html>
    <head>
        <title>Imaging</title>
        <link rel="stylesheet" type="text/css" href="../css/cam.css">
    </head>
<body>

    
<form class="booth1" action="../controllers/fileUpload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Upload Image" name="upload">
</form>

<div class="booth">
    <video id="video" width="400" height="300" autoplay></video>
    <canvas id="canvas" width="400" height="300"></canvas>
</div>

<div class="booth">
    <img class="emojis" src="../img/e1.png" alt="" id="e1" onclick="addSticker('e1', 0, 0)">
    <img class="emojis" src="../img/e2.png" alt="" id="e2" onclick="addSticker('e2', 300, 0)">
    <img class="emojis" src="../img/e3.png" alt="" id="e3" onclick="addSticker('e3', 0, 200)">
    <img class="emojis" src="../img/e4.png" alt="" id="e4" onclick="addSticker('e4', 300, 200)">
</div>

<form class="booth1" action="../controllers/fileUpload.php" method="post">
    <input type="hidden" id="img" name="img">
    <input type="submit" id="cam_pic" name="cam_pic" value="Upload picture">
</form>

<div class="booth1">
    <input type="submit" id="capture" name="capture" value="Capture">
    <input type="submit" id="clear" name="clear" value="Clear">
</div>

<script src="../javascript/cam.js"></script>
</body>
</html>