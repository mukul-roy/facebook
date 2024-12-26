<?php 

date_default_timezone_set('asia/dhaka');

if (file_exists(__DIR__."/confiq/connection.php")) {
    require_once __DIR__."/confiq/connection.php";
}

// include functions
if( file_exists( __DIR__ .'/app/functions.php') ){
    require_once __DIR__.'/app/functions.php';
}


// include functions
if( file_exists( __DIR__ .'/app/models.php') ){
    require_once __DIR__.'/app/models.php';
}


?>