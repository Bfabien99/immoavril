<?php
    require 'vendor/autoload.php';

    $router = new AltoRouter();

    $router->map('GET', '/immoavril/',function(){
        require 'views/home.php';
    });

    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) 
   {
	    call_user_func_array( $match['target'], $match['params'] ); 
    } 
    else 
    {
	    require 'views/error/404.php';
        die();
    }