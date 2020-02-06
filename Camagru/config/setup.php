<?php
    require 'connection.php';
    $conn->exec("CREATE TABLE `comments` (
        `id` int(11) NOT NULL,
        `username` varchar(255) NOT NULL,
        `image_id` int(11) NOT NULL,
        `comment` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
      CREATE TABLE `images` (
        `id` int(50) NOT NULL,
        `username` varchar(255) NOT NULL,
        `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `picture` varchar(100) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
      CREATE TABLE likes (
        `id` int(11) NOT NULL,
        `username` varchar(255) NOT NULL,
        `image_id` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

      CREATE TABLE `users` (
        `id` int(50) NOT NULL,
        `username` varchar(50) NOT NULL,
        `email` varchar(50) NOT NULL,
        `password` varchar(255) NOT NULL,
        `vkey` varchar(255) NOT NULL,
        `verified` tinyint(1) NOT NULL DEFAULT '0'
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
      ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);
    
  ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `images`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;");

header("location: ../views/publicGall.php");
?>