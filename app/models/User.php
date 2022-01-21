<?php

require_once APP_ROOT . '/models/Genre.php';

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
}