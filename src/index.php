<?php
session_start();

require '../vendor/autoload.php';
include '../config.php';

use Respect\Rest\Router;

$r = new Router;

$r->get('/api/steps',function(){
	$repo = new \enade\repository\StepRepo;
	$steps = $repo->getAll();
	$json = json_encode($steps);
	header('Content-Type: application/json');
	return $json;
});


$r->get('/',function(){
    header('Location: index.html');
});


