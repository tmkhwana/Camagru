<?php
    require_once("../config/connection.php");

    class Queries
    {
        private $conn;

        //function to initialize class values
        function __construct($conn)
        {
            $this->conn = $conn;
        }

        //function to validate login details. if details are correct it will return an array or else it will return a blank/null/empty value
        function login($username, $password)
        {
            $sql = "SELECT * FROM users WHERE username = ? and `password` = ?";
            $stmt = $this->conn->prepare($sql);
            // $stmt->bindParam(1, $username);
            // $stmt->bindParam(2, $password);
		    $stmt->execute([$username, $password]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $results;
        }

        //get the user id using the username
        function getId($username){
            $sql = "SELECT * FROM `camagru`.`users` WHERE `username` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;
        }

        //function to get the username using the id
        function getuserinfo($id){
            $sql = "SELECT * FROM `camagru`.`users` WHERE `id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;
        }

        //function to validate if the function added by the user is correct
        function validatePass($pass, $id){
            $sql = "SELECT * FROM `camagru`.`users` WHERE `password` = ? AND id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$pass, $id]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results){ 
                return true;
            }
            return false;
        }

        //function to update username
        function updateuser($id, $username){
            $sql = "UPDATE `users` SET username = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username, $id]);
        }

        //function to update email
        function updatemail($email, $id){
            $sql = "UPDATE `users` SET email = ?, verified = 0 WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$email, $id]);
        }

        //function to update notification preferance
        function updatenotification($notifications, $id){
            $sql = "UPDATE `users` SET `notifications` = ? WHERE `id`= ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$notifications, $id]);
        }

        //function to verify user
        function verify($code)
        {
            $sql = "UPDATE `users` SET `verified` = '1' WHERE `users`.`vkey` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$code]);
        }

        //function to check if user exists
        function getuser($code)
        {
            $sql = "SELECT * FROM `camagru`.`users` WHERE `vkey` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$code]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            return $results;
        }

        //function to add a new user to the DB and get them verified
        function adduser($username, $email, $password, $vkey)
        {
            $sql = 'INSERT INTO users (username, email, `password`, vkey) VALUES (?, ?, ?, ?)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([$username, $email, $password, $vkey]);
        }

        //function to check if username or email exists??
        function userExist($username, $email)
        {
            $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username, $email]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            return ($results);
        }

        //function to check is email exists and get details for the user
        function getuserdetails($email)
        {
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$email]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            return ($results);
        }

        //function to verify code from the password reset
        function verifycode($code)
        {
            $sql = "SELECT * FROM users WHERE vkey = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$code]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            return ($results);
        }

        //function to update password after you have verified you vkey
        function updatepassword($password, $userid)
        {
            $sql = "UPDATE users SET `password` = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $results = $stmt->execute([$password, $userid]);
    
            return ($results);
        }

        //function to upload images to database
        function upload_image($username, $picture)
        {
            global $conn;
            
            $sql = "INSERT INTO images (username, picture) VALUES (?,?)";
            $stmt= $conn->prepare($sql);

            try{
                $stmt->execute([$username, $picture]);
                echo "picture successfully added";
            } 
            catch(Exception $ex) {
                die($ex->getMessage());
            }
        }

        //function to delete images from database
        function delete_image($pic_id)
        {
            global $conn;
            
            $sql = "DELETE FROM images WHERE id = ?";
            $stmt= $conn->prepare($sql);

            try{
                $stmt->execute([$pic_id]);
                echo "picture deleted";
            }
            catch(Exception $ex){
                die($ex->getMessage());
            }
        }

        //function to get images to put them in your database 
        function getAllImages()
        {
            global $conn;
            
            $sql = "SELECT * FROM images ORDER BY upload_date";
            $stmt= $conn->prepare($sql);

            try{
                $stmt->execute();
                $images = $stmt->fetchAll();
                return $images;
            }
            catch(Exception $ex){
                die($ex->getMessage());
            }   
        }

        //function to display comments
        function display_comment($comment_id)
        {
            $sql = "SELECT * FROM comments WHERE image_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $comment_id);
            $stmt->execute();
            $comments = $stmt->fetchAll();
        }

        //function to count the number of likes a user has
        function count_likes($like_id)
        {
            $sql = "SELECT * FROM likes WHERE image_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $like_id);
            $stmt->execute();
            echo $stmt->rowCount()." like";
        }

    }

    $dataModel = new Queries($conn);
?>