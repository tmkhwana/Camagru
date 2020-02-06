<?php
require("../config/connection.php");
require("../models/model.php");
if (isset($_SESSION['login']))
{
    $login_id = $_SESSION['login']['id'];
    $login_username = $_SESSION['login']['username'];
}
    //function to display images you upload to the database to the gallery 
    $image_array = $dataModel->getAllImages();

    $img_id = null;
    if (isset($_GET['img_id']))
    {
        $img_id = $_GET['img_id'];    
    }
    if (isset($_POST['submit_comment']))
    {
        $comment = $_POST['comment'];
        if (empty($comment))
        {
            echo "<p>blank comment</p>";
        }
        else
        {
            $sql = "INSERT INTO comments (username, comment) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_username);
            $stmt->bindParam(2, $img_id);
            $stmt->bindParam(3, $comment);
            $stmt->execute();
        }
    }

    if (isset($_POST['like']))
    {
        if ($login_username)
        {
            $sql = "INSERT INTO likes (username, image_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_username);
            $stmt->bindParam(2, $img_id);
            $stmt->execute();
        }
    }

    
    {
        $dataModel->userExist($username, $email);
        if ($stmt->rowCount() > 0)
        {
            foreach($comments as $comment)
            {
                echo "<h5>".$comment['username']."</h5>";
                echo "<p>".$comment['comment']."</p>";
            }
        }
    }

        $dataModel->count_likes($likes_id)

?>