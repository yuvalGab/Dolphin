<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link rel="stylesheet" href="stylesheets/global.css">
    <link rel="stylesheet" href="stylesheets/login.css">
</head>
<body>
    <div class="wrapper">
        <?php include "templates/header.temp.php"; ?>
        <div class="main">
            <div class="login">
                <h2>כניסת עורך:</h2>
                <form>
                    <label>שם משתמש:
                        <input class="login-inputs" name="username" type="text" autocomplete="off" autofocus>
                    </label>
                    <p class="error" id="username-error"></p>
                    <label>סיסמה:
                        <input class="login-inputs" name="password" type="password"  autocomplete="off">
                    </label>
                    <p class="error" id="password-error"></p>
                    <input id="login" class="button" type="submit" value="כניסה">
                    <p class="error" id="login-error"></p>
                </form>
                <div class="new-user">
                    <a href="/dolphin/create-user">יצירת משתמש חדש</a>
                </div>
            </div>
            <?php include "templates/mobileMenu.temp.php"; ?>   
        </div>
        <?php include "templates/footer.temp.php"; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="javascripts/global.js"></script>
    <script src="javascripts/login.js"></script>

</body>
</html>