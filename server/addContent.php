<?php

    include "database.php";

    //grab the posted data
    $username = $_COOKIE['username'];
    $headline = $_POST['headline'];
    $intro = $_POST['intro'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    $date = $_POST['date'];

    //create new content in the database
    $stmt = $db->prepare("INSERT INTO contents (username, headline, intro, main_text, category, add_date) VALUES (:username, :headline, :intro, :main_text, :category, :add_date)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':headline', $headline);
    $stmt->bindParam(':intro', $intro);
    $stmt->bindParam(':main_text', $text);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':add_date', $date);
    $stmt->execute();

    //check if image set and upload it
    if($_FILES['image']['name'] != "") {
        $lastId = $db->lastInsertId();
        $imgRealName = $_FILES['image']['name'];
        $ext = pathinfo($imgRealName, PATHINFO_EXTENSION);
        $newImgName =  $lastId . "." . $ext;
        $uploaddir = '../images/upload_images/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
            rename ( $uploaddir .$imgRealName, $uploaddir . $newImgName);
            //set image name in database
            $stmt = $db->prepare("UPDATE contents SET pic = '$newImgName' WHERE contentID = '$lastId'");
            $stmt->execute();
        }

        //make a mini image for view
        $originalFile = $uploaddir . $newImgName;
        $resizeFile = $uploaddir . "m" . $newImgName;
        $info = getimagesize($originalFile);
        $mime = $info['mime'];
        
        switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    break;

            default: 
                    throw Exception('Unknown image type.');
        }

        $newWidth = 120;
        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);
        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $image_save_func($tmp, $resizeFile);

    }

    //relocation to editors page
    header("Location: /dolphin/editors");
