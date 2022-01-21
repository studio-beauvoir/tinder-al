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

    public function checkMatch($userB_Id) {
        // context : userA a liké userB
        // à ce moment une ligne a été ajouté dans la table like 
        // si on cherche à vérif qu'il y ai un match, c'est que ce like est true
        // on peut alors chercher si userB a liké en retour userA

        // $firstLike = Likes::DBQuery('*', 'WHERE likeL1 ='.this->likeL1);

        // on regarde parmi les likes qui existent, si userB like userA
        // c-a-d WHERE idUserL1 = userB->idUser AND idUserL2 = userA->idUser

        // ligne de la table like
        // on a 3 colonnes :
        // - idUserL1 : c'est la personne qui a liké
        // - idUserL2 : c'est la personne qui est liké
        // - likeL1 : est ce qu'on like?

        $queryAtoB = 'WHERE idUserL1 ='.$userB_Id.' AND WHERE idUserL2 ='.$this->idUser. ' AND likeL1 = 1';
        $queryBtoA = 'WHERE idUserL1 ='.$this->idUser.' AND WHERE idUserL2 ='.$userB_Id. ' AND likeL1 = 1';
        $query = $queryAtoB . ' UNION ' . $queryBtoA;
        
        $reciproqueLike = Likes::DBQuery('*', $query);
        // print_r($reciproqueLike);

        return $reciproqueLike;
        // if($reciproqueLike)
        // ...
    }
}