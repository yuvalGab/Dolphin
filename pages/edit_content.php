<?php
    
    //query selected content item data

    include "./server/database.php";

    $username = $_COOKIE['username'];
    $contentID = $_GET['contentID'];

    $isAdmin = false;
    if(isset($_COOKIE['permission']) && $_COOKIE['permission'] = 'admin') {
        $isAdmin = true;
        $sth = $db->prepare("SELECT * FROM contents WHERE contentID = '$contentID'");
    } else {
        $sth = $db->prepare("SELECT * FROM contents WHERE username = '$username' AND contentID = '$contentID'");
    }

    $sth->execute();

    $content = $sth->fetchAll();
    $content = $content[0];

    if(!$content) {
        header("Location: /dolphin/editors");
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
    <link rel="stylesheet" href="stylesheets/add_content.css">
</head>
<body>
    <div class="wrapper">
        <?php include "templates/header.temp.php"; ?>
        <div class="main">
            <div class="contents">
                <h2>עדכון תוכן קיים</h2>
                <p id="date"><?= $content['add_date']; ?></p>
                 <?php if($isAdmin) : ?>
                    <p>כותב: <?= $content['username']; ?></p>
                <?php endif; ?>
                <form action="/dolphin/server/editContent.php" method="post" enctype="multipart/form-data">
                    <hr />
                    <label>כותרת:
                        <input id="headline" name="headline" type="text" minlength="3" maxlength="50" required value="<?= $content['headline']; ?>">
                    </label>
                    <label>כותרת משנית/הקדמה:
                        <textarea id="intro" name="intro" rows="2" minlength="10" maxlength="150" required ><?= $content['intro']; ?></textarea>
                    </label>
                    <hr />
                    <p id="old-category"><?= $content['category']; ?></p>
                    <label>קטגוריה:
                        <select name="category" required >
                            <option value="פוליטיקה">פוליטיקה</option>
                            <option value="ספורט">ספורט</option>
                            <option value="עסקים">עסקים</option>
                            <option value="תיירות">תיירות</option>
                            <option value="מחשבים">מחשבים</option>
                            <option value="בריאות">בריאות</option>
                            <option value="מוזיקה">מוזיקה</option>
                            <option value="אוכל">אוכל</option>
                            <option value="סרטים">סרטים</option>
                            <option value="תרבות">תרבות</option>
                            <option value="פנאי">פנאי</option>
                            <option value="אחר">אחר</option>
                        </select>
                    </label>
                    <label>הוספת/שינוי תמונה - אופציונלי (עד 2 מגה):
                        <input id="image" name="image" type="file" accept="image/*">
                        <p id="image-error" class="error"></p>
                    </label>
                        <?php if($content['pic'] != ""): ?>
                            <div class="current-image">
                                <p>תמונה נוכחית:</p>
                                <img src="/dolphin/images/upload_images/m<?= $content['pic']; ?>" >
                            </div>
                        <?php endif; ?>
                    <hr />
                    <label><span id="text-label">טקסט:</span>
                        <textarea id="text" name="text" rows="30" minlength="200" maxlength="10000"  required><?= $content['main_text']; ?></textarea>
                    </label>
                    <input id="content-id" name="content-id" type="text" value="<?= $content['contentID']; ?>" style="display: none;">
                    <input id="content-pic" name="content-pic" type="text" value="<?= $content['pic']; ?>" style="display: none;">
                    <input id="username" name="username" type="text" value="<?= $content['username']; ?>" style="display: none;">
                    <hr />
                    <input id="add" class="button" type="submit" value="עדכן">
                    <hr />
                </form>
                <button id="delete-content">מחק תוכן זה</button>
            </div>   
            <?php include "templates/mobileMenu.temp.php"; ?>   
        </div>
        <?php include "templates/footer.temp.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="javascripts/global.js"></script>
    <script src="javascripts/editContent.js"></script>

</body>
</html>