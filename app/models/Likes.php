<?php


class Likes extends Model {

    static $table="likes";

    public $columns = [
        'idUserL1',
        'idUserL2',
        'likeL1'
    ];
}