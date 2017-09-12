<?php

    include "database.php";

    if(isset($_POST['user'])) {
        $username = $_POST['user'];
        $sql = "SELECT * FROM editors WHERE username = :user;";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':user' => $username));
        $isExists = !!$stmt->fetch(PDO::FETCH_ASSOC);
        if($isExists) {
            echo 'exists';
        }
    }