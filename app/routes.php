<?php

require_once APP_ROOT.'/controllers/UserController.php';
require_once APP_ROOT.'/controllers/LikeController.php';
require_once APP_ROOT.'/controllers/AuthController.php';
require_once APP_ROOT.'/controllers/HomeController.php';
require_once APP_ROOT.'/controllers/MatchController.php';

//$router->get('/', fn()=>ProfileController::show() ); 


$router->get('/login', fn()=>AuthController::showLogin()); //vue du login
$router->post('/login', fn()=>AuthController::attemptLogin()); //formulaire
$router->post('/logout', fn()=>AuthController::attemptLogout()); //formulaire

$router->get('/users', fn()=>UserController::index());
$router->get('/user/matches', fn() =>MatchController::index());
$router->get('/user/likes', fn() =>LikeController::likes());
$router->get('/user/dislikes', fn() =>LikeController::dislikes());
$router->get('/user/:id', fn($idUser) =>UserController::show($idUser));

// requêtes pour like ou dislike 
// $idUserTarget correspond à l'id de l'user à liker ou disliker
// l'user effectuant l'action est celui connecté
$router->post('/like/:idUserTarget', fn($idUserTarget) =>LikeController::like($idUserTarget));
$router->post('/dislike/:idUserTarget', fn($idUserTarget) =>LikeController::dislike($idUserTarget));



$router->get('/home', fn()=>HomeController::index());
$router->get('/match/:idUserWithMatch', fn($idUserWithMatch)=>MatchController::index($idUserWithMatch));