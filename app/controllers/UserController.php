<?php

require_once APP_ROOT .'/models/User.php';

class UserController {
    // CRUD
    
    // get all : index
    // get specific : show
    // create : create
    // modify : update
    // delete : delete
    
    public static function index() {
        // get all users

        $viewData = [
            'users' => User::DBQueryAll('*')
        ];

        // affichage de la vue avec les data
        require_once APP_ROOT . '/views/user/index.php';
    }

    public static function show($user_id) {
        $viewData = [
            'user' => User::DBQuery('*', 'WHERE idUser = '.$user_id)
        ];

        // affichage de la vue avec les data
        require_once APP_ROOT . '/views/user/show.php';
    }


    public static function matches($user_id) {
        $viewData = [
            'allUsers' => User::DBQueryAll('*')
        ];

        foreach($viewData['allUsers'] as $userToCheck) {
            echo $userToCheck->checkMatch($user_id);
        }

        // affichage de la vue avec les data
        // require_once APP_ROOT . '/views/user/show.php';
    }
}