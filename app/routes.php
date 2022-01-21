<?php

require_once APP_ROOT.'/controllers/UserController.php';

$router->get('/', fn()=>ProfileController::show() ); 




$router->get('/users', fn()=>UserController::index());
$router->get('/user/:id', fn($id) =>UserController::show($id));
$router->get('/user/:id/matches', fn($id) =>UserController::matches($id));