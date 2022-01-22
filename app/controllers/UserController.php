<?php

require_once APP_ROOT .'/models/User.php';
require_once APP_ROOT .'/framework/Controller.php';

class UserController extends Controller {
    // CRUD
    
    // get all : index
    // get specific : show
    // create : create
    // modify : update
    // delete : delete
    
    public static function index() {
        // get all users

        self::view('user/index', [
            'users' => User::DBQuery()->all()
        ]);
    }

    public static function show($user_id) {
        // affichage de la vue avec les data
        self::view('user/show', [
            'user' => User::DBQuery()->where('idUser = '.$user_id)->first()
        ]);
    }


    
}