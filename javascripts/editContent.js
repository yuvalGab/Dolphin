$(function() {

    //indicate the current page in the menu
    $('.option a').eq(1).addClass('selected-option');
    
    //selecte the old seted category
    $('select').val($('#old-category').text());

    $('#delete-content').on('click', function(e) {
        var userConfrim = confirm("האם אתה בטוח שברצונך למחוק תוכן זה לצמיתות?");
        if (userConfrim) {
            var contentID = $('#content-id').val();
            var existsPic = $('#content-pic').val();
            $.post( "server/deleteItem.php", { item: contentID, pic: existsPic } )
             .done(function(data) {
                alert( data );
                window.location.href = "/dolphin/editors";
             });
        } else {
            return;
        }
    });

    //check image upload size
    $('#image').bind('change', function() {
        if ($(this).val != "") {
            var size = this.files[0].size;
            var imageError = $('#image-error');
            if (size > 2097152) {
                $(this).val("");
                imageError.text("ניתן לעלות תמונה עד 2mb");
            } else {
                imageError.text("");
            }
        }
    });

});