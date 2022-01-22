<?php
    require_once APP_ROOT .'/models/Likes.php';
    require_once APP_ROOT .'/models/User.php';
    require_once APP_ROOT .'/framework/Controller.php';
    
    require_once APP_ROOT .'/controllers/MatchController.php';

    class LikeController extends Controller {
 
        public static function index() { //récupérer tous les likes existants
            self::view('likes/index', [
                'likes' => Likes::DBQuery()->all()
            ]);
        }



        public static function likes() { //récupérer tous les likes donnés d'une seule personne

            $likesFromOne = $GLOBALS["user"]->getLikes();
            $likedUsers = [];
            foreach($likesFromOne as $like) {
                array_push(
                    $likedUsers,
                    $like->getLikedUser()
                );
            }
            self::view('likes/likes', [
                'likesFromOne' => $likesFromOne,
                'likedUsers' => $likedUsers
            ]);
        }

        public static function dislikes() { //récupérer tous les deslikes donnés d'une seule personne

            $dislikesFromOne = $GLOBALS["user"]->getDislikes();
            $dislikedUsers = [];
            foreach($dislikesFromOne as $dislike) {
                array_push(
                    $dislikedUsers,
                    
                    // ici c'est quand même la méthode get Liked user
                    $dislike->getLikedUser() 
                );
            }
            self::view('likes/dislikes', [
                'dislikesFromOne' => $dislikesFromOne,
                'dislikedUsers' => $dislikedUsers
            ]);
        }





        // c'est ici qu'il faut modifier
        // j'ai fait ça hier 

        public static function like($userToLike) {

            // vérification de si le like existe déjà
            $likeRequest = Likes::DBQuery()
                ->where("idUserL1 = ".$GLOBALS["user"]->idUser)
                ->andWhere("idUserL2 = ".$userToLike);
            
            if($likeRequest->exists()) {
                // on mets à jour 
                $like = $likeRequest->first();

                $like->DBUpdateOnSelf([
                    'likeL1'=>1
                ]);
                
            } else {
                // on insert les données dans la bdd
                Likes::DBCreate([
                    'idUserL1'=>$GLOBALS["user"]->idUser,
                    'idUserL2'=>$userToLike,
                    'likeL1'=>1
                ]);
            }

            if($GLOBALS["user"]->checkMatch($userToLike)) {
                // y'a match

                MatchController::create($GLOBALS["user"]->idUser, $userToLike);
            }

            header('Location: /discover'); 
        }
        

        public static function dislike($userId) {

            // vérification de si le like existe déjà
            $likeRequest = Likes::DBQuery()
                ->where("idUserL1 = ".$GLOBALS["user"]->idUser)
                ->andWhere("idUserL2 = ".$userId);
            
            if($likeRequest->exists()) {
                // on mets à jour 
                $like = $likeRequest->first();

                $like->DBUpdateOnSelf([
                    'likeL1'=>0
                ]);
                
            } else {
                // on insert les données dans la bdd
                Likes::DBCreate([
                    'idUserL1'=>$GLOBALS["user"]->idUser,
                    'idUserL2'=>$userId,
                    'likeL1'=>0
                ]);
            }

            header('Location: /discover'); 
        }
    
    }
?>