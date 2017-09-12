<?php

    include "database.php";

    //grab the posted data
    $username = $_COOKIE['username'];
    $headline = $db->quote($_POST['headline']);
    $intro = $db->quote($_POST['intro']);
    $text = $db->quote($_POST['text']);
    $category = $_POST['category'];
    $contentID = $_POST['content-id'];
    $contentExistsPic = $_POST['content-pic'];
    
    //update current content in the database
    if(isset($_COOKIE['permission']) && $_COOKIE['permission'] = 'admin') {
        $sql = "UPDATE contents SET headline = $headline, intro = $intro, main_text = $text, category = '$category' WHERE contentID = '$contentID' ";
    } else {
        $sql = "UPDATE contents SET headline = $headline, intro = $intro, main_text = $text, category = '$category' WHERE contentID = '$contentID' AND username = '$username' ";
    }
    $db->exec($sql);

    //check if image set and upload/replace it
    if($_FILES['image']['name'] != "") {
        $currentID = $contentID;
        //check if image already exists and delete it
        if($contentExistsPic != "") {
            unlink("../images/upload_images/" . $contentExistsPic);
            unlink("../images/upload_images/m" . $contentExistsPic);
        }
        $imgRealName = $_FILES['image']['name'];
        $ext = pathinfo($imgRealName, PATHINFO_EXTENSION);
        $newImgName =  $currentID . "." . $ext;
        $uploaddir = '../images/upload_images/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
            rename ( $uploaddir .$imgRealName, $uploaddir . $newImgName);
            //set image name in database
            $stmt = $db->prepare("UPDATE contents SET pic = '$newImgName' WHERE contentID = '$currentID'");
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
