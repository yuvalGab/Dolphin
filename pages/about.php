<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link rel="stylesheet" href="stylesheets/global.css">
    <link rel="stylesheet" href="stylesheets/about.css">
</head>
<body>
    <div class="wrapper">
        <?php include "templates/header.temp.php"; ?>
        <div class="main">
            <div class="contents">
                <h2>אודות</h2>
                <p>אתר זה הוקם כחלק מתרגול בניית אתרים בסביבת שרת PHP.</p>
                <p>האתר משמש כפורטל להעלאת תוכן עבור הקהל הרחב, כל אחד יכול להירשם ולהוסיף תוכן ע"י הפורמט שהאתר מציע.</p>
                <p>ישנם שני סוגי משתמשים: האחד, משתמש עם הרשאה רגילה היכול להוסיף תוכן ולערוך את התוכן שלו בלבד, והשני משתמש בעל הרשאת מנהל אשר ביכולתו להוסיף תוכן ולערוך תוכן שלו ושל אחרים.</p>
                <p>את התוכן המועלה לאתר ניתן לראות בדף הראשי,לשונית ה"תוכן", ולסנן בהתאם לקטגוריות השונות הקיימות במערכת.</p>
                <p>כמו כן, באתר קיימת מערכת ליצירת תגובה מהירה לתוכן.</p>
                <p>גלישה נעימה!</p>
                <img src="images/dolphins.png" >
            </div>
            <?php include "templates/mobileMenu.temp.php"; ?>
        </div>
        <?php include "templates/footer.temp.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="includes/jquery-ui.min.js"></script>
    <script src="javascripts/global.js"></script>
    <script src="javascripts/about.js"></script>
    
</body>
</html>