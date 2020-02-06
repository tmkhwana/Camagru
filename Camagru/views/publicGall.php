<?php
    session_start();
    include('nav.php');
    require_once ("../models/model.php");
    $image_array = $dataModel->getAllImages();
    
    foreach ($image_array as $image)
    {
        echo '<img src="'. $image['picture'] .'" alt="" class="src"></br>';
    }
?>