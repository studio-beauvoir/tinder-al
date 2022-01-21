<?php

// configuration
require_once __DIR__.'/app/config/config.php';
require_once __DIR__.'/app/config/env.php';


// pseudo-framework;
require_once __DIR__.'/app/framework/Model.php';
require_once __DIR__.'/app/framework/Router.php';


// connect to db
require_once __DIR__.'/app/providers/db.php';

// helpers
require_once __DIR__.'/app/helpers.php';

// get view router etc

$router = new Router($_GET['url']); 
require_once __DIR__.'./app/routes.php';
$router->run(); 