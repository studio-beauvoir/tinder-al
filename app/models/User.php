<?php

require_once APP_ROOT . '/models/Genre.php';
require_once APP_ROOT . '/models/Likes.php';

class User extends Model {

    public $table = "user";

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
        // return Genre::DBQuery('*', 'WHERE idGenr = '.$this->idGenr);
        return Genre::DBQuery()->where('idGenr = '.$this->idGenr)->first();
    }

    public function checkMatch($userB_id) {
        $userA_id = $this->idUser;
        // on regarde parmi les likes qui existent, si userA like userB
        $queryAtoB = "WHERE idUserL1 = $userB_id AND idUserL2 = $userA_id AND likeL1 = 1";
        $likeAtoB = Likes::DBQuery()->where("idUserL1 = $userB_id")->andWhere("idUserL2 = $userA_id")->andWhere("likeL1 = 1")->exists();
        
        // var_dump(empty($likeAtoB));
        // if($likeAtoB) {
            var_dump($likeAtoB);
        // }

        // on regarde parmi les likes qui existent, si userB like userA
        // c-a-d WHERE idUserL1 = userB->idUser AND idUserL2 = userA->idUser

        // ligne de la table like
        // on a 3 colonnes :
        // - idUserL1 : c'est la personne qui a liké
        // - idUserL2 : c'est la personne qui est liké
        // - likeL1 : est ce qu'on like?

        $queryBtoA = "WHERE idUserL1 = $userA_id AND idUserL2 = $userB_id  AND likeL1 = 1";


        $likeBtoA = Likes::DBQuery('*', $queryBtoA);
        

        // var_dump(empty($likeBtoA));
        // print_r($likeBtoA->data);

        // return $reciproqueLike;
        // if($reciproqueLike)
        // ...
    }
}