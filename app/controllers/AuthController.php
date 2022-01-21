<?php

require_once APP_ROOT .'/models/User.php';

class AuthController {
    // CRUD
    
    // get all : index
    // get specific : show
    // create : create
    // modify : update
    // delete : delete
    
    public static function attemptLogin() { //check
        // get all users

        global $db;

        $query = 'SELECT * FROM user WHERE nomEUser = ?;';
        $result = $db->prepare($query);
        $result->execute([$_POST['name']]);
        $user = $result->fetch();

        if($user) { //cookie
            setcookie('user', $user['nomEUser']);
            header('Location: /home'); //dès qu'on créé le cookie, on part sur le home.php
        }
        else {
            header('Location: /login');
        }

        print_r($user);

    //     if(true) {
    //         echo "connexion";
    //         header('Location: /home');
    //     }
    //     else {
    //         echo "mauvais identifiant";
    //         header('Location: /login');
    //     }
    }

    public static function showLogin() { //affichage formulaire
        require_once APP_ROOT . '/views/auth/login.php';
    }
}