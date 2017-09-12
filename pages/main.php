<?php

    include "./server/database.php";

    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        $sth = $db->prepare("SELECT * FROM contents WHERE category = '$category' ORDER BY contentID DESC LIMIT 20");
    } else {
        $sth = $db->prepare("SELECT * FROM contents ORDER BY contentID DESC LIMIT 20");
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
    <link rel="stylesheet" href="stylesheets/main.css">
</head>
<body>
    <div class="wrapper">
        <?php include "templates/header.temp.php"; ?>
        <div class="main">
            <?php include "templates/mainSidebar.temp.php"; ?>
            <div class="contents">
                <?php if(!empty($contents)): ?>
                    <?php foreach($contents as $row) : ?>
                        <div class="item-wrapper">
                            <div class="item">
                                <div class="text">
                                    <h3><?= $row['headline']; ?></h3>
                                    <h5>מאת: <?= $row['username']; ?></h5> 
                                    <h4><?= $row['intro']; ?></h4>
                                </div>
                                <?php if($row['pic'] != "" ) : ?>
                                    <div class="image" style="background-image: url(<?= "images/upload_images/m".$row['pic']; ?>);"></div>
                                <?php else : ?>
                                    <div class="image"></div>
                                <?php endif; ?>
                                <p class="content-id" style="display: none;"><?= $row['contentID']; ?></p>
                            </div>  
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="error">לא קיים תוכן</p>
                <?php endif; ?> 
                <div class="clear"></div>
            </div>
            <?php include "templates/mobileMenu.temp.php"; ?>   
            <?php include "templates/mobileMainSidebar.temp.php"; ?> 
        </div>
        <?php include "templates/footer.temp.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="includes/jquery-ui.min.js"></script>
    <script src="javascripts/global.js"></script>
    <script src="javascripts/main.js"></script>
    
</body>
</html>