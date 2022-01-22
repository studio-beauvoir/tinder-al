<?php

require_once APP_ROOT.'/controllers/UserController.php';
require_once APP_ROOT.'/controllers/LikeController.php';
require_once APP_ROOT.'/controllers/AuthController.php';
require_once APP_ROOT.'/controllers/HomeController.php';

//$router->get('/', fn()=>ProfileController::show() ); 


$router->get('/login', fn()=>AuthController::showLogin()); //vue du login
$router->post('/login', fn()=>AuthController::attemptLogin()); //formulaire

$router->get('/users', fn()=>UserController::index());
$router->get('/user/:id', fn($id) =>UserController::show($id));
$router->get('/user/:id/matches', fn($id) =>UserController::matches($id));

$router->get('/likes', fn()=>LikeController::index());
$router->get('/likes/:id', fn($id) =>LikeController::show($id));

$router->get('/like/:id', fn($id) =>LikeController::like($id));

$router->get('/home', fn()=>HomeController::index());