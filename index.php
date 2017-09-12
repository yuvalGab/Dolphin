<?php 
    
    require "includes/AltoRouter.php";

    $router = new AltoRouter();
    $router->setBasePath("/dolphin");

    // map homepage
    $router->map( 'GET', '/', function() {
        require __DIR__ . '/pages/main.php';
    });

    // map view content
    $router->map( 'GET', '/content', function() {
        require __DIR__ . '/pages/content.php';
    });

    //map editors area
    $router->map( 'GET', '/editors', function() {
        if(isset($_COOKIE['username'])) {
            if(isset($_GET['category'])) {
                require __DIR__ . '/pages/editors_category.php';
            } else {
                require __DIR__ . '/pages/editors.php';
            }
        } else {
            require __DIR__ . '/pages/login.php';
        }
    });

    // map about
    $router->map( 'GET', '/about', function() {
        require __DIR__ . '/pages/about.php';
    });
    
    // map create new user
    $router->map( 'GET', '/create-user', function() {
        require __DIR__ . '/pages/new_user.php';
    });

    // map log-out user
    $router->map( 'GET', '/logout', function() {
        require __DIR__ . '/server/logout.php';
    });

    // map add new content
    $router->map( 'GET', '/add-content', function() {
        require __DIR__ . '/pages/add_content.php';
    });
    
    // map edit content
    $router->map( 'get', '/edit-content', function() {
        require __DIR__ . '/pages/edit_content.php';
    });

    // match current request url
    $match = $router->match();
    
    // call closure or throw 404 status
    if( $match && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    }else {
        // no route was matched
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
    