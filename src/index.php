<?php
session_start();

require '../vendor/autoload.php';
include '../config.php';

use Respect\Rest\Router;

$r = new Router;

$r->get('/api/steps','\enade\controller\StepController');
$r->get('/api/user','\enade\controller\UserController');
$r->post('/api/user','\enade\controller\UserController');
$r->get('/api/checklist','\enade\controller\ChecklistController');
$r->post('/api/checklist','\enade\controller\ChecklistController');

$r->get('/',function(){
    header('Location: index.html');
});


