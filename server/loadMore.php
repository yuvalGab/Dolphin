<?php

    include "../server/database.php";

    $fromItem = $_POST['itemsPresent'];

    //load more items from database to the main page 
    if (isset($_POST['category'])) {
        $category = $POST['category'];
        $sth = $db->prepare("SELECT * FROM contents WHERE category = '$category' ORDER BY contentID DESC LIMIT 20, $fromItem");
    } else {
        $sth = $db->prepare("SELECT * FROM contents ORDER BY contentID DESC LIMIT 20, $fromItem");
    }
    $sth->execute();

    $contents = $sth->fetchAll();

    if(!empty($contents)) {
        echo json_encode($contents);
    } else {
        return;
    }