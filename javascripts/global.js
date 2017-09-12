$(function() {
    
    //link to homepage when logo is clicked
    $('#logo').on('click', function() {
        window.location.href = "/dolphin/";
    });

    //mobile-menu code
    $('#menu-btn').on('click', function() {
        $('.mobile-menu').fadeToggle(500);
    });

    //mobile-sidebar function
    $('#sidebar-btn').on('click', function() {
        //$('.mobile-sidebar').fadeIn(500);
        $(".mobile-sidebar").show( "slide", {direction: "left" }, 800 );
    });
    $('.main').on('click', function(e) {
        if (!$(e.target).is(".mobile-sidebar") && !$(e.target).is("#sidebar-btn")) {
            //$('.mobile-sidebar').fadeOut(500);
            $(".mobile-sidebar").hide( "slide", {direction: "left" }, 800 );
        }
    });

});