<?php

group('db',function(){
    task('drop',function(){
        include 'config.php';
        $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
        $db->exec("TRUNCATE steps");
        var_dump($db->errorInfo());
    });

    task('init',function(){
        include 'config.php';
        $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
        $db->exec(file_get_contents('schema.sql'));
        var_dump($db->errorInfo());
    });

    task('load',function(){
        include 'config.php';
        $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
        $db->exec(file_get_contents('load.sql'));
        var_dump($db->errorInfo());
    });
});

task('test',function(){
    passthru('PHP_ENV=test vendor/bin/phake db:drop db:init db:load');
    passthru('PHP_ENV=test vendor/bin/phpunit tests');
});

task('test-ui',function(){
    passthru('PHP_ENV=test vendor/bin/phake db:drop db:init db:load');
    passthru('PHP_ENV=test vendor/bin/behat features');
});

