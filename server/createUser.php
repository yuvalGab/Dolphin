<?php

    include "database.php";

    //create new editor user in database
    $username = $_POST['user'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $permission = 0;
    
    $stmt = $db->prepare("INSERT INTO editors (username, password, email, permission) VALUES (:username, :password, :email, :permission)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':permission', $permission);
    $stmt->execute();