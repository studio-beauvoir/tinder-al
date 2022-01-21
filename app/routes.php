<?php

require_once APP_ROOT.'/controllers/UserController.php';

$router->get('/test/:id', function($id){ echo "Bienvenue sur ma homepage !"; }); 
$router->get('/', function($id){ echo "Bienvenue sur ma homepage !"; }); 
$router->get('/posts/:id', function($id){ echo "Voila l'article $id"; }); 