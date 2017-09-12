
<?php

    //delete current edit content from database
    include "../server/database.php";

    $username = $_COOKIE['username'];
    $item = $_POST['item'];
    $existsPic = $_POST['pic'];

    if(isset($_COOKIE['permission']) && $_COOKIE['permission'] = 'admin') {
        $sql = "DELETE FROM contents WHERE contentID='$item'";
    } else {
        $sql = "DELETE FROM contents WHERE contentID='$item' AND username='$username'";
    }

    $db->exec($sql);

    //delete relative posts
    $sql = "DELETE FROM posts WHERE contentID='$item'";
    $db->exec($sql);

    //delete two relative images if exists
    if($existsPic != "") {
        unlink("../images/upload_images/" . $existsPic);
        unlink("../images/upload_images/m" . $existsPic);
    }

    echo "פריט נמחק בהצלחה!";