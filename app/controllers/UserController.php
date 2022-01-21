<?php

class UserController {
    // CRUD
    
    // get all : index
    // get specific : show
    // create : create
    // modify : update
    // delete : delete
    
    public static function index() {
        // get all users

        // requete des data


        // affichage de la vue avec les data
        require_once APP_ROOT . '/views/user/index.php';
    }

    public static function show($user_id) {
        // get user with this id
    }
}