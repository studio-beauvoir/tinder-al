<?php
    require_once APP_ROOT .'/models/Likes.php';

    class LikeController {

        public static function index() { //récupérer tous les likes existants
            $viewData = [
                'likes' => Likes::DBQueryAll('*')
            ];
            require_once APP_ROOT . '/views/likes/index.php';
        }

        public static function show($userId) { //récupérer tous les likes d'une seule personne pour les autres
            $viewData = [
                'likesFromOne' => Likes::DBQuery('*', 'WHERE likeL1 = '.$userId->likeL1)
            ];
    
            // affichage de la vue avec les data
            require_once APP_ROOT . '/views/likes/show.php';
        }
    }
?>