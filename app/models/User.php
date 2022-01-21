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

    public function getFullName() 
    {
        return $this->prenomUser . " " . $this->nomEUser;
    }

    public function getGenreModel() : Genre
    {
        // return Genre::DBQuery('*', 'WHERE idGenr = '.$this->idGenr);
        return Genre::DBQuery()->where('idGenr = '.$this->idGenr)->first();
    }

    public function checkMatch($userB_id) : bool
    {
        $userA_id = $this->idUser;

        // on regarde parmi les likes qui existent, si userB like userA
        // c-a-d WHERE idUserL1 = userB->idUser AND idUserL2 = userA->idUser AND likeL1 = 1
        
        // ligne de la table like
        // on a 3 colonnes :
        // - idUserL1 : c'est la personne qui a liké
        // - idUserL2 : c'est la personne qui est liké
        // - likeL1 : est ce qu'on like(1/true) ou on dislike(0/false)?

        // on regarde parmi les likes qui existent, si userA like userB
        $likeAtoB = Likes::DBQuery()->where("idUserL1 = $userA_id")->andWhere("idUserL2 = $userB_id")->andWhere("likeL1 = 1");

        
        if($likeAtoB->exists()) {

            // réciproque
            // puis on regarde si userA figure dans les likes de userB
            $likeBtoA = Likes::DBQuery()->where("idUserL1 = $userB_id")->andWhere("idUserL2 = $userA_id")->andWhere("likeL1 = 1");

            if($likeBtoA->exists()) {
                return true;
            }
        }
        return false;
    }
}