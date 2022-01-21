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
            'users' => User::DBQuery()->all()
        ];

        // affichage de la vue avec les data
        require_once APP_ROOT . '/views/user/index.php';
    }

    public static function show($user_id) {
        $viewData = [
            'user' => User::DBQuery()->where('idUser = '.$user_id)->first()
        ];

        // affichage de la vue avec les data
        require_once APP_ROOT . '/views/user/show.php';
    }


    public static function matches($user_id) {
        $viewData = [
            'currentUser' => User::DBQuery()->where("idUser = $user_id")->first(),
            'allUsers' => User::DBQuery()->all()
        ];

        foreach($viewData['allUsers'] as $userToCheck) {
            if($userToCheck->checkMatch($user_id)) {
                echo $userToCheck->getFullName();
            }
        }

        // affichage de la vue avec les data
        // require_once APP_ROOT . '/views/user/show.php';
    }
}