<?php
session_start();

if(isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Headers: Content-Type');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

require '../vendor/autoload.php';
include '../config.php';

use Respect\Rest\Router;

$r = new Router;

$r->get('/api/steps','\enade\controller\StepController');
$r->get('/api/user','\enade\controller\UserController');
$r->post('/api/user','\enade\controller\UserController');
$r->get('/api/checklist','\enade\controller\ChecklistController');
$r->post('/api/checklist','\enade\controller\ChecklistController');
$r->get('/api/logout',function(){
  unset( $_SESSION['user_id'] );
});

$r->get('/',function(){
    header('Location: index.html');
});


