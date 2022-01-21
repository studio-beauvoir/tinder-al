<?php


class Comment extends Model {

    public $table="comments";
    
    public $columns = [
        'idUserC1',
        'idUserC2',
        'libComment'
    ];
}