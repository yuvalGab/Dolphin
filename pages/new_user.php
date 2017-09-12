<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link rel="stylesheet" href="stylesheets/global.css">
    <link rel="stylesheet" href="stylesheets/new_user.css">
</head>
<body>
    <div class="wrapper">
        <?php include "templates/header.temp.php"; ?>
        <div class="main">
            <div class="new-user">
                <h2>יצירת משתמש חדש:</h2>
                <form>
                    <label>שם משתמש:
                        <input name="new_username" type="text" autocomplete="off" autofocus>
                    </label>
                    <p class="error" id="username-error"></p>
                    <label>סיסמה:
                        <input name="new_password" type="text" autocomplete="off">
                    </label>
                    <p class="error" id="password-error"></p>
                    <label>אימייל:
                        <input name="new_email" type="text" autocomplete="off">
                    </label>
                    <p class="error" id="email-error"></p>
                    <input id="create-user" class="button" type="submit" value="צור משתמש">
                    <p class="error" id="create-error"></p>
                </form>
            </div>
            <?php include "templates/mobileMenu.temp.php"; ?>   
        </div>
        <?php include "templates/footer.temp.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="javascripts/global.js"></script>
    <script src="javascripts/newUser.js"></script>

</body>
</html>