<?php

group('db',function(){
    task('truncate',function(){
        include 'config.php';
        $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
        $db->exec("TRUNCATE steps;");
        var_dump($db->errorInfo());
        $db->exec("TRUNCATE users;");
        var_dump($db->errorInfo());
    });

    task('drop',function(){
        include 'config.php';
        $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
        $db->exec("DROP TABLE steps;");
        var_dump($db->errorInfo());
        $db->exec("DROP TABLE users;");
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

group('test',function(){

  task('all',function(){
    passthru('export PHP_ENV=test && phake db:drop db:init db:load && phpunit tests && behat');
  });

  task('unit',function(){
      passthru('export PHP_ENV=test && phake db:drop db:init db:load && phpunit tests');
  });

  task('ui',function(){
      passthru('export PHP_ENV=test && phake db:drop db:init db:load && behat');
  });
});


