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
} 