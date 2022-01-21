<?php

require_once APP_ROOT . '/models/Genre.php';
require_once APP_ROOT . '/models/Likes.php';

class User extends Model {

    static $table = "user";

    public $columns = [
        'idUser',
        'idGenr',
        'nomEUser',
        'prenomUser',
        'photo',
        'age',
        'biographie'
    ];


    public function getGenreModel() {
        return Genre::DBQuery('*', 'WHERE idGenr = '.$this->idGenr);
    }

    public function checkMatch($userBId) {
        // context : userA a liké userB
        // à ce moment une ligne a été ajouté dans la table like 
        // si on cherche à vérif qu'il y ai un match, c'est que ce like est true
        // on peut alors chercher si userB a liké en retour userA

        // $firstLike = Likes::DBQuery('*', 'WHERE likeL1 ='.this->likeL1);

        // on regarde parmi les likes qui existent, si userB like userA
        // c-a-d WHERE idUserL1 = userB->idUser AND idUserL2 = userA->idUser
        $query = 'WHERE likeL1 ='.$this->likeL1. 'UNION' . 'WHERE likeL1 ='.$userBId->likeL1;
        $reciproqueLike = Likes::DBQuery('*', $query);
        print_r($reciproqueLike);

        // if($reciproqueLike)
        // ...
        return false;
    }
}