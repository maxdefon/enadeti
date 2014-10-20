<?php
session_start();

require '../vendor/autoload.php';
include '../config.php';

use Respect\Rest\Router;

$r = new Router;

$r->get('/api/steps','\enade\controller\StepController');

$r->get('/',function(){
    header('Location: index.html');
});


