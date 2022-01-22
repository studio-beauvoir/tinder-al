<?php

require_once APP_ROOT .'/models/User.php';
require_once APP_ROOT .'/models/Likes.php';
require_once APP_ROOT .'/models/Matchs.php';
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
            'matchedUsers' => $GLOBALS["user"]->getMatchedUsers()
        ]);
    }

    public static function create($idUserA, $idUserB) {

        // vérification de si le match existe déjà
        $matchRequest = Matchs::DBQuery()
            ->where("idUserM1 = ".$idUserA)
            ->andWhere("idUserM2 = ".$idUserB);
    
        if(!$matchRequest->exists()) {
            // si le match n'existe pas
            // on insert les données dans la bdd
            Matchs::DBCreate([
                'idUserM1'=>$idUserA,
                'idUserM2'=>$idUserB
            ]);
        }

    }

    
}