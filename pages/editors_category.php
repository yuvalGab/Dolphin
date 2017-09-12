<?php

    include "./server/database.php";

    $username = $_COOKIE['username'];

    $category = $_GET['category'];
    $category = trim($category,"'");

    $isAdmin = false;
    if(isset($_COOKIE['permission']) && $_COOKIE['permission'] = 'admin') {
        $isAdmin = true;
        $sth = $db->prepare("SELECT * FROM contents WHERE category = '$category' ORDER BY contentID DESC");
    } else {
        $sth = $db->prepare("SELECT * FROM contents WHERE username = '$username' AND category = '$category' ORDER BY contentID DESC");
    }
    
    $sth->execute();

    $contents = $sth->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link rel="stylesheet" href="stylesheets/global.css">
    <link rel="stylesheet" href="stylesheets/editors.css">
</head>
<body>
    <div class="wrapper">
        <?php include "templates/header.temp.php"; ?>
        <div class="main">
            <?php include "templates/editorsSidebar.temp.php"; ?>
            <div class="contents">
                <div class="user-contents">
                    <h2>התוכן שלך (<?= $category; ?>):</h2>
                    <?php if(!empty($contents)): ?>
                        <?php foreach($contents as $row) : ?>
                            <div class="item">
                                <p class="item-id"><?= $row['contentID']; ?></p>
                                <?php if($isAdmin) : ?>
                                    <p><?= $row['username']; ?> - </p>
                                <?php endif; ?>
                                <p><?= $row['add_date']; ?> - </p>
                                <p class="label"><?= $row['headline']; ?> : </p>
                                <p class="intro"> <?= $row['intro']; ?></p>
                            </div>
                        <?php endforeach; ?> 
                    <?php else: ?>
                        <p class="error">לא קיים תוכן</p>
                    <?php endif; ?>
                </div>
            </div>  
            <?php include "templates/mobileMenu.temp.php"; ?>   
            <?php include "templates/mobileEditorsSidebar.temp.php"; ?> 
        </div>
        <?php include "templates/footer.temp.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="includes/jquery-ui.min.js"></script>
    <script src="javascripts/global.js"></script>
    <script src="javascripts/editors.js"></script>

</body>
</html>