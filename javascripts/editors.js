$(function() {

    //indicate the current page in the menu
    $('.option a').eq(1).addClass('selected-option');

    //add content button function
    $('#add-content').on('click', function() {
        window.location.href = "/dolphin/add-content";
    }) ;

    //click on item function
    $('.item').on('click', function() {
        var contentID = $(this).find('.item-id').text();
        window.location.href = "/dolphin/edit-content?contentID=" + contentID;
    });
    
});
