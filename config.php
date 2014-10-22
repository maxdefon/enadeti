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
} else if(isset($_SERVER['HTTP_HOST']) && preg_match('/^([a-z]+)\.localhost$/',$_SERVER['HTTP_HOST'],$reg)) {
    define("PHP_ENV",$reg[1]);
} else if(getenv("PHP_ENV")) {
    define("PHP_ENV",getenv('PHP_ENV'));
} else if(file_exists(__DIR__.'/.env')) {
    $env = trim( file_get_contents(__DIR__.'/.env') );
} else {
    define("PHP_ENV","dev");
}

foreach($config[PHP_ENV] as $k=>$v) {
    if(!defined(strtoupper($k))) {
        define(strtoupper($k),$v);
    }
}

