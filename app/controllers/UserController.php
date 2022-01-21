<?php

class UserController {
    // CRUD
    
    // get all : index
    // get specific : show
    // create : create
    // modify : update
    // delete : delete
    
    public static function index() {
        // get all users

        require_once APP_ROOT . '/views/product.php';
    }

    public static function show($user_id) {
        // get user with this id
    }
}