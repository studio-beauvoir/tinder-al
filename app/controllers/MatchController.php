<?php

require_once APP_ROOT .'/models/User.php';
require_once APP_ROOT .'/models/Likes.php';
require_once APP_ROOT .'/framework/Controller.php';

class MatchController extends Controller {
    // CRUD
    
    // get all : index
    // get specific : show
    // create : create
    // modify : update
    // delete : delete

    public static function index() {
        self::view('matches/index', [
            'matchedUsers' => User::DBQuery()->all(),
            'user_id' => $GLOBALS["user"]->idUser
        ]);
        // affichage de la vue avec les data
        // require_once APP_ROOT . '/views/user/show.php';
    }
}