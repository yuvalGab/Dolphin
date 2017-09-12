<?php

    //query the selected content fro database

    include "./server/database.php";

    $contentID = $_GET['contentID'];

    $sth = $db->prepare("SELECT * FROM contents WHERE contentID = '$contentID'");
    $sth->execute();

    $content = $sth->fetchAll();
    if($content) {
        $content = $content[0];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link rel="stylesheet" href="stylesheets/global.css">
    <link rel="stylesheet" href="stylesheets/content.css">
</head>
<body>
    <div class="wrapper">
        <?php include "templates/header.temp.php"; ?>
        <div class="main">
            <?php include "templates/mainSidebar.temp.php"; ?>
            <div class="contents">
                <?php if(!empty($content)) : ?>
                    <div class="content">
                        <h6>קטגוריה: <?= $content['category']; ?></h6>
                        <h5><?= $content['add_date']; ?></h5>
                        <h2><?= $content['headline']; ?></h2>
                        <h3><?= $content['intro']; ?></h3>
                        <h4>נכתב ע"י <?= $content['username']; ?></h4>
                        <p><?= nl2br($content['main_text']); ?></p>
                        <?php if(!empty($content['pic'])) : ?>
                            <img src="images/upload_images/<?= $content['pic']; ?>" >
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <p class="error">לא קיים תוכן</p>
                <?php endif; ?>
                <?php include "templates/posts.php"; ?>  
            </div>   
            <?php include "templates/mobileMenu.temp.php"; ?>   
        </div>
        <?php include "templates/footer.temp.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="javascripts/global.js"></script>
    <script src="javascripts/content.js"></script>

</body>
</html>