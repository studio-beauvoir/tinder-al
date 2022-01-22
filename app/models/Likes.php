<?php

require_once APP_ROOT . '/models/User.php';

class Likes extends Model {

    public static $table="likes";

    public $columns = [
        'idUserL1',
        'idUserL2',
        'likeL1'
    ];


    public function getUser() {
        return User::DBQuery()->where('idUser = '.$this->idUserL1)->first();
    }

    public function getLikedUser() {
        return User::DBQuery()->where('idUser = '.$this->idUserL2)->first();
    }
}