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
    
    public static function index() {
        // get all users
        $users = User::DBQuery()->all();

        // select only likeable users
        //iduserL1 : celui qui like
        //idUserL2 : celui liké
        //likeL1 : si liké true, disliké false

        // prendre tous les users
        // regarder pour chacun s'il est liké ou disliké par l'user actuel
        // c-a-d si une ligne (ou un record) existe
        // pour cela il suffit 

        // utilisateurs likés ou dislikés
        $userLikes = $GLOBALS["user"]->getLikesOrDislikes();

        $usersToLike = [];
        // naviquer dans les users et vérifier s'il a été liké ou disliké
        foreach ($users as $userToVerify) { // navigue dans tous les users
            $toAdd=true;

            if($userToVerify->idUser === $GLOBALS["user"]->idUser) {
                // si jamais l'id de user correspond à l'id de userLiked, on n'ajoute pas user à usersToLike
                $toAdd = false;

                // on passe au userToVerify suivant, inutile de continuer avec celui ci
                continue;
            }

            // vérifie si pas liké ou pas unliké
            foreach ($userLikes as $userLike) { // navigue dans les users liké ou dislikés
                if($userToVerify->idUser === $userLike->idUserL2) {
                    // si jamais l'id de user correspond à l'id de userLiked, on n'ajoute pas user à usersToLike
                    $toAdd = false;
                }
            }
            if($toAdd) array_push($usersToLike, $userToVerify);
        }

        self::view('home', [
            'usersToLike' => $usersToLike
        ]);
    }
    
}