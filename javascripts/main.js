$(function() {

    //indicate the current page in the menu
    $('.option a').eq(0).addClass('selected-option');

    //view selected content
    setInterval(function () {
        $('.item-wrapper').on('click', function(){
            var contentID = $(this).find('.content-id').text();
            window.location.href = '/dolphin/content?contentID=' + contentID;
        });
    }, 1000);

    //items appearance
    var showDone = false;
    function showItems(firstItem) {
        var itemElement = $('.item-wrapper');
        showDone = false;
        var items = itemElement.length -1;
        for (var i = firstItem; i <= items; i++) {
            (function(n) {
                setTimeout(function(){
                    itemElement.eq(n).fadeIn(700, function() {
                        if (n == items - 5) {
                            showDone = true;
                        }
                    });
                }, 100 * i);
            }(i));
        }
    }

    
    //first items loading
    showItems(0);

    //upload more items when scrolling
    $('.contents').scroll(function() {
        var currentScrollTop = parseInt(this.scrollTop);
        var maxScroll = parseInt($(this).prop('scrollHeight') - $(this).innerHeight());
        if (currentScrollTop == maxScroll && showDone == true) {
            var loadedItems = $('.item-wrapper').length;
            var path = window.location.href.split( '/' );
            path = path[path.length - 1]; 
            if (path != "") {
                path = path.split('=');
                path = path[path.length - 1];
                var categoryName = decodeURIComponent(path);
            } 
            $.post( "server/loadMore.php", { category: categoryName, itemsPresent: loadedItems })
            .done(function(data) {
                var data = JSON.parse(data);
                var contentDiv = $('.contents');
                data.forEach(function(item) {
                    contentDiv.find('.clear').remove();
                    contentDiv.append(
                        "<div class='item-wrapper'>" +
                            "<div class='item'>" +
                                "<div class='text'>" +
                                    "<h3>" + item.headline + "</h3>" +
                                    "<h5>מאת:" + item.usernmae + "</h5>" +
                                    "<h4>" + item.intro + "</h4>" +
                                "</div>" +
                                "<div class='image' style='background-image: url(" + checkIfImageSet(item.pic) + "') ></div>" +
                                 "<p class='content-id' style='display: none;'>" + item.contentID + "</p>" +
                            "</div>" +
                        "</div>"
                    );
                });
                contentDiv.append("<div class='clear'></div>");
                showItems(loadedItems);
            });
        }
    });

    function checkIfImageSet(image) {
        if (image) {
            return "images/upload_images/m" + image;
        } else {
            return "images/placeholder-image.png";
        }
    }
    
});