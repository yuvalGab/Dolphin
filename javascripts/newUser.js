$(function() {

    //indicate the current page in the menu
    $('.option a').eq(1).addClass('selected-option');

    //username validation
    var username = "";
    var usernameValid = false; 
    var newUsernameInput = $("input[name='new_username']");
    newUsernameInput.keyup(function(){
        usernameValid = false;
        username = newUsernameInput.val();
        var error = '';
        $('#username-error').css({color: 'red'});
        $.post( "server/userExists.php", { user: username })
            .done(function( data ) {
                if (data == "exists") {
                    error = "שם משתמש כבר קיים";
                } else if (username == "") {
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
    });

    //password validation
    var password = "";
    var passwordValid = false; 
    var newPasswordInput = $("input[name='new_password']");
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

    //email validation
    var email = "";
    var emailValid = false;
    var newEmailInput = $("input[name='new_email']");
    //var pattern = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
    var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    newEmailInput.keyup(function() {
        emailValid = false;
        email = newEmailInput.val();
        var error = '';
        $('#email-error').css({color: 'red'});
        if (email == '') {
            error = "אנא מלא אימייל";
        } else if (email.length > 50) {
            error = "אימייל יכול להכיל עד 50 תווים";
        } else if (!pattern.test(email)) {
            error = "תבנית אימייל לא חוקית";
        } else {
            emailValid = true;
            error = "כתובת אימייל תקינה";
            $('#email-error').css({color: 'blue'});
        }
        $('#email-error').text(error);
    });

    //send new user to database
    $("#create-user").on('click', function(e) {
        e.preventDefault();
        if (!usernameValid || !passwordValid || !emailValid) {
            $('#create-error').show().text("אנא הכנס נתונים תקינים").fadeOut(3000);
        } else {
            $.post( "server/createUser.php", { user: username, password: password, email: email })
            .done(function() {
                $('#create-error').show().css({color: 'blue'}).text("שם משתמש נוצר בהצלחה!").fadeOut(3000);
                setTimeout(function() {
                   window.location.href = "/dolphin/editors";
                }, 500);
            });
        }
    });

});