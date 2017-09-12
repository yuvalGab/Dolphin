<?php

    //send new post to database

    include "database.php";

    $nickname = $_POST['nickname'];
    $comment = $_POST['comment'];
    $contentID = $_POST['contentID'];
    $postDate = $_POST['postDate'];
    
    $stmt = $db->prepare("INSERT INTO posts (contentID, nickname, comment, post_date) VALUES (:contentID, :nickname, :comment, :postDate)");
    $stmt->bindParam(':contentID', $contentID);
    $stmt->bindParam(':nickname', $nickname);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':postDate', $postDate);
    $stmt->execute();