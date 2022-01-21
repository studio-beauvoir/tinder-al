<?php


class Comment extends Model {

    static $table="comments";
    
    public $columns = [
        'idUserC1',
        'idUserC2',
        'libComment'
    ];
}