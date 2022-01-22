<?php

require_once APP_ROOT .'/models/User.php';
require_once APP_ROOT .'/models/Likes.php';
require_once APP_ROOT .'/framework/Controller.php';

class HomeController extends Controller {
    // CRUD
    
    // get all : index
    // get specific : show
    // create : create
    // modify : update
    // delete : delete
    
    public static function show() {
        self::view('home', [
            'users' => User::DBQuery()->all(),
        ]);
    }
    
}