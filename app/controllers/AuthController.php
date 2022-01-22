<?php

require_once APP_ROOT .'/models/User.php';
require_once APP_ROOT .'/framework/Controller.php';

class AuthController extends Controller {
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
            setcookie('username', $user['nomEUser']);
            header('Location: /home'); //dès qu'on créé le cookie, on part sur le home.php
        }
        else {
            header('Location: /login');
        }
    }

    public static function attemptLogout() {

        // supression du cookie
        setcookie('username', '', time()-3600);
        
        //dès qu'on retire le cookie on revient sur login
        header('Location: /login'); 
    }

    public static function showLogin() { //affichage formulaire
        self::view('auth/login', [
            'users' => User::DBQuery()->all()
        ]);
    }
}