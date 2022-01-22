<?php

require_once APP_ROOT . '/models/User.php';

// verif si cookie 
if( isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];

    // recup dans la bdd
    $userQuery = User::DBQuery()->where("nomEUser = '$username'");


    if($userQuery->exists()) {
        $GLOBALS["user"] = $userQuery->first();
    } 
} else {

    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    // si on est pas déjà sur la page de login
    if (parse_url($url, PHP_URL_PATH) !== '/login' ) {
        // redirection vers login
        header('Location: /login');
        die();
    }
}