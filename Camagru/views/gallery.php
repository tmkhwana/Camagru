<?php
session_start();
include('nav.php');
if (isset($_SESSION['id']))
{
    $login_id = $_SESSION['id'];
    $login_username = $_SESSION['username'];
}
else
{
    header("location:publicGall.php");
    exit();
}
?>
<?php
    require ("../models/model.php");
    $image_array = $dataModel->getAllImages();
    require("../config/connection.php");


    $img_id = null;
    if (isset($_GET['img_id']))
    {
        $img_id = $_GET['img_id'];
    }
    if (isset($_POST['submit_comment']))
    {
        $comment = strip_tags($_POST['comment']);
        if (empty($comment))
        {
            echo "<p>blank comment</p>";
        }
        else
        {
            $sql = "INSERT INTO comments (username, image_id, comment) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $login_username);
            $stmt->bindParam(2, $img_id);
            $stmt->bindParam(3, $comment);
            $stmt->execute();

            $username = $_GET['id'];

            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $username);
            $stmt->execute();
            
            $result = $stmt->fetch();
        }
        
    }

    if (isset($_POST['like']))
    {
       
        $login_id = $_SESSION['id'];
        $login_username = $_SESSION['username'];

        if ($login_username)
        {
            $username = $_GET['id'];
            $img_id = $_GET['img_id'];

            $sql = "SELECT * FROM likes WHERE username = ? AND image_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$login_username, $img_id]);
            $res = $stmt->fetch();
            if ($stmt->rowCount() < 1){
                $sql = "INSERT INTO likes (username, image_id) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $login_username);
                $stmt->bindParam(2, $img_id);
                $stmt->execute();
            }
        }
    }

    function display_comment($comment_id)
    {
        global $conn;
        $sql = "SELECT * FROM comments WHERE image_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $comment_id);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        if ($stmt->rowCount() > 0)
        {
            foreach($comments as $comment)
            {
                echo "<h5>".$comment['username']."</h5>";
                echo "<p>".$comment['comment']."</p>";
            }
        }
    }

    function count_likes($like_id)
    {

        global $conn;
        $sql = "SELECT * FROM likes WHERE image_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $like_id);
        $stmt->execute();
        echo $stmt->rowCount()." like";
    }

?>
<?php foreach($image_array as $image):?>


<img src="<?php 
    echo $image["picture"]; 

?>" alt="<?php echo $image["picture"]; ?>"><br>
<form method="post" action="?id=<?$_SESSION['username'];?>&img_id=<?php echo $image['id']; ?>">
    <input type="text" name="comment" placeholder="type comment here ..."><br>
    <button name="submit_comment" type="submit">submit comment</button><br>
    <?php 
    $img_id = $image['id'];
    $sql = "SELECT * FROM likes WHERE username = ? AND image_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $img_id]);
            $res = $stmt->fetch();
            if ($stmt->rowCount() < 1){
    count_likes($image['id']);} ?>
    <button type="submit" name="like">like</button><br>
    <?php
        if(isset($_POST['delete']))
        {
            $img_id = $_GET['img_id'];
            $sql = "DELETE FROM images WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$img_id]);
            //refresh page
            header("Refresh:0");
        }
    ?>
    <button type="submit" name="delete">delete</button>
   
</form>
<?php display_comment($image['id']) ?>
<?php endforeach; ?>