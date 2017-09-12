$(function() {

    //indicate the current page in the menu
    $('.option a').eq(0).addClass('selected-option');

    //add post function 
    $('#send-post').on('click', function() {
        var nickname = $('#nickname').val();
        var comment = $('#comment').val();
        var contentID = $('#content-id').val();
        var postDate = setDate();
        var error = "";
        //post validation
        if (nickname == '') {
            error = "יש להכניס כינוי";
        } else if (nickname.length < 3) {
            error = "יש להזין לפחות שלוש אותיות בכינוי";
        } else if (nickname.length > 15) {
            error = "ניתן להזין עד 15 אותיות בכינוי";
        } else if (comment == "") {
            error = "יש להכניס תגובה";
        } else if (comment.length < 5) {
            error = "תגובה חייבת להכיל לפחות 5 אותיות"; 
        } else if (comment.length > 1000) {
            error = "תגובה יכולה להכיל עד 1000 אותיות";
        }
        if (error != "") {
            $('#send-error').text(error);
        } else {
            $('#send-error').text("");
            sendPost(nickname, comment, contentID, postDate);
            $('#nickname').val("");
            $('#comment').val("");
        }
    });

    //set date to the new post
    function setDate() { 
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        var hour = date.getHours();
        if (hour < 10) {
            hour = "0" + hour; 
        }
        var minutes = date.getMinutes();
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        date = day + "/" + month + "/" + year + " - " + hour + ":" + minutes;
        return date;
    }

    //send the post to the database
    function sendPost(nickname, comment, contentID, postDate) {
        $.ajax({
            method: "POST",
            url: "server/sendPost.php",
            data: { nickname: nickname, comment: comment, contentID: contentID, postDate: postDate }
        })
            .done(function( data ) {
                $('.posts-list').prepend("<div class='comment-box'>" + 
                    "<p class='post-date'>" + postDate +"</p>" +
                    "<p class='nickname'>כינוי: <strong>" + nickname + "</strong></p>" +
                    "<p class='main-comment'>"+ comment +"</p>" + 
                "</div>");
            });
            if($('#show-error').show()) {
                $('#show-error').hide();
            } 
    }

});