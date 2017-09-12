<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin</title>
    <link rel="icon" type="image/x-icon" href="imageslogo.png">
    <link rel="stylesheet" href="stylesheets/global.css">
    <link rel="stylesheet" href="stylesheets/add_content.css">
</head>
<body>
    <div class="wrapper">
        <?php include "templates/header.temp.php"; ?>
        <div class="main">
            <!--<?php include "templates/sidebar.temp.php"; ?>-->
            <div class="contents">
                <h2>פורמט יצירת תוכן חדש</h2>
                <p id="date"></p>
                <form action="/dolphin/server/addContent.php" method="post" enctype="multipart/form-data">
                    <hr />
                    <label>כותרת:
                        <input id="headline" name="headline" type="text" minlength="3" maxlength="50" required>
                    </label>
                    <label>כותרת משנית/הקדמה:
                        <textarea id="intro" name="intro" rows="2" minlength="10" maxlength="150" required></textarea>
                    </label>
                    <hr />
                    <label>קטגוריה:
                        <select name="category" required>
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
                    <label>הוספת תמונה - אופציונלי (עד 2 מגה):
                        <input id="image" name="image" type="file" accept="image/*">
                        <p id="image-error" class="error"></p>
                    </label>
                    <hr />
                    <label><span id="text-label">טקסט:</span>
                        <textarea id="text" name="text" rows="30" minlength="200" maxlength="10000"  required></textarea>
                    </label>
                    <input id="send-date" name="date" type="text" style="display:none;">
                    <hr />
                    <input id="add" class="button" type="submit" value="הוסף">
                    <hr />
                </form>
            </div>
            <?php include "templates/mobileMenu.temp.php"; ?>      
        </div>
        <?php include "templates/footer.temp.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="javascripts/global.js"></script>
    <script src="javascripts/addContent.js"></script>

</body>
</html>