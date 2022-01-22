<?php
    require_once APP_ROOT .'/models/Likes.php';
    require_once APP_ROOT .'/framework/Controller.php';

    class LikeController extends Controller {
 
        public static function index() { //récupérer tous les likes existants
            self::view('likes/index', [
                'likes' => Likes::DBQuery()->all()
            ]);
        }

        public static function show() { //récupérer tous les likes donnés d'une seule personne
            self::view('likes/show', [
                'likesFromOne' => $GLOBALS["user"]->getLikes()
            ]);
        }

        public static function like($userId) { //récupérer tous les likes donnés d'une seule personne
            Likes::DBCreate([
                'idUserL1'=>$GLOBALS["user"]->idUser,
                'idUserL2'=>$userId,
                'likeL1'=>1
            ]);
        }
        
    
    }
?>