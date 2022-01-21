<?php

// pseudo-framework;
require_once './app/framework/Model.php';


// configuration
require_once './app/config/config.php';
require_once './app/config/env.php';



// connect to db
require_once './app/providers/db.php';

// helpers
require_once './app/helpers.php';

// get view router etc
require_once './app/controllers/UserController.php';


UserController::index();

// UserController::show(1);


