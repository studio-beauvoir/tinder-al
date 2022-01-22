<?php

require_once APP_ROOT . '/models/Genre.php';
require_once APP_ROOT . '/models/Likes.php';
require_once APP_ROOT . '/models/Matchs.php';

class User extends Model {

    // public $table = "user";
    public static $table = "user";

    public $primaryKey = ['idUser'];

    public $columns = [
        'idUser',
        'idGenr',
        'nomEUser',
        'prenomUser',
        'photo',
        'age',
        'biographie'
    ];

    public function getStaticTable() {
        return static::$tableT;
    }

    public function getFullName() : string
    {
        return $this->prenomUser . " " . $this->nomEUser;
    }

    public function getMatchs() 
    {
        return Matchs::DBQuery()
            ->where("idUserM1 = ".$this->idUser)
            ->orWhere("idUserM2 = ".$this->idUser)
            ->all();
    }

    public function getMatchedUsers() 
    {
        $matchs = $this->getMatchs();

        $usersMatched = [];

        foreach($matchs as $match) {
            $idUserMatched = 
                $match->idUserM1 === $this->idUser ? 
                    $match->idUserM2 : $match->idUserM1;
            
            array_push(
                $usersMatched,
                User::DBQuery()->where('idUser', $idUserMatched)->first()
            );
        }

        return $usersMatched;
    }

    public function getLikes() 
    {
        return Likes::DBQuery()
            ->where("idUserL1 = ".$this->idUser)
            ->andWhere("likeL1 = 1")
            ->all();
    }

    public function getDislikes() 
    {
        return Likes::DBQuery()
            ->where("idUserL1 = ".$this->idUser)
            ->andWhere("likeL1 = 0")
            ->all();
    }

    public function getLikesOrDislikes() 
    {
        return Likes::DBQuery()
            ->where("idUserL1 = ".$this->idUser)
            ->all();
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