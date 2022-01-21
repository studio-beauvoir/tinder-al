<?php


class Likes extends Model {

    public $table="likes";

    public $columns = [
        'idUserL1',
        'idUserL2',
        'likeL1'
    ];
}