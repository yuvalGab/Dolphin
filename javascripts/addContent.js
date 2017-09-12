$(function() {

    //indicate the current page in the menu
    $('.option a').eq(1).addClass('selected-option');

    //set date
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    date = day + "/" + month + "/" + year;
    $('#date').text(date);
    $('#send-date').val(date);

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