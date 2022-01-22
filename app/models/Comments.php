<?php


class Comment extends Model {

    public static $table="comments";
    
    public $columns = [
        'idUserC1',
        'idUserC2',
        'libComment'
    ];
}