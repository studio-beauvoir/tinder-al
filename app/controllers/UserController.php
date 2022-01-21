<?php

class UserController {
    // CRUD
    
    // get all : index
    // get specific : show
    // create : create
    // modify : update
    // delete : delete
    
    public static function index() {
        global $db;
        // get all users

        // requete des data
        $query = 'SELECT * FROM user;'; 

        // on passe le query à la bdd
        $result = $db->query($query);

        // on recup le resultat
        $users = $result->fetchAll();

        // affichage de la vue avec les data
        require_once APP_ROOT . '/views/user/index.php';
    }

    public static function show($user_id) {
        // get user with this id
    }
}