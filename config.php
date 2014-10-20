<?php

$config = array(
    'dev' => array(
        'db_host'=>'localhost',
        'db_name'=>'enade',
        'db_user'=>'root',
        'db_pass'=>'root'
    ),
    'test'=>array(
        'db_host'=>'localhost',
        'db_name'=>'enade_test',
        'db_user'=>'root',
        'db_pass'=>'root'
    ),
    'prod'=>array(
        'db_host'=>'localhost',
        'db_name'=>'enade',
        'db_user'=>'root',
        'db_pass'=>'root'
    )
);

if(defined('PHP_ENV')) {
} else if(getenv("PHP_ENV")) {
    define("PHP_ENV",getenv('PHP_ENV'));
} else if(file_exists('.env')) {
    $env = trim( file_get_contents('.env') );
} else if(file_exists('env_config.php')) {
    include 'env_config.php';
} else {
    define("PHP_ENV","dev");
}

foreach($config[PHP_ENV] as $k=>$v) {
    if(!defined(strtoupper($k))) {
        define(strtoupper($k),$v);
    }
}

