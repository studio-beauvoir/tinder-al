<?php

require_once APP_ROOT.'/controllers/UserController.php';

$router->get('/', function(){ echo "Bienvenue sur ma homepage !"; }); 


$router->get('/users', function(){ UserController::index(); }); 
$router->get('/user/:id', function($id){ UserController::show($id); }); 