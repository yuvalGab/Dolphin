$(function() {

    //indicate the current page in the menu
    $('.option a').eq(1).addClass('selected-option');

    //force clean inputs fields
    $(".login-inputs").val("");

    //username validation
    var username = "";
    var usernameValid = false; 
    var newUsernameInput = $("input[name='username']");
    newUsernameInput.keyup(function(){
        usernameValid = false;
        username = newUsernameInput.val();
        var error = '';
        $('#username-error').css({color: 'red'});
        if (username == "") {
            error = "אנא מלא שם משתמש";
        } else if (username.length > 15) {
            error = "שם משתמש יכול להכיל עד 15 תווים";
        } else if (username.length < 5) {
            error = "שם משתמש צריך להכיל לפחות 5 תווים";
        } else {
            usernameValid = true;
            error = "שם משתמש תקין";
            $('#username-error').css({color: 'blue'});
        }
        $('#username-error').text(error);
    });

    //password validation
    var password = "";
    var passwordValid = false; 
    var newPasswordInput = $("input[name='password']");
    newPasswordInput.keyup(function(){
        passwordValid = false;
        password = newPasswordInput.val();
        var error = '';
        $('#password-error').css({color: 'red'});
        if (password == "") {
            error = "אנא מלא סיסמה";
        } else if (password.length < 6) {
            error = "סיסמה חייבת להכיל לפחות 6 תווים";
        } else if (password.length > 15) {
            error = "סיסמה יכולה להכיל עד 15 תווים";
        } else {
            passwordValid = true;
            error = "סיסמה תקינה";
            $('#password-error').css({color: 'blue'});
        }
        $('#password-error').text(error);
    });

    $("#login").on('click', function(e) {
        e.preventDefault();
        if (!usernameValid || !passwordValid) {
            $('#login-error').show().text("אנא הכנס נתונים תקינים").fadeOut(4000);
        } else {
            $.post( "server/login.php", { user: username, password: password })
            .done(function(data) {
                if (data == "כניסה") {
                    window.location.href = "/dolphin/editors";
                } else {
                    $('#login-error').show().text(data).fadeOut(4000);
                }
            });
        }
    });

});