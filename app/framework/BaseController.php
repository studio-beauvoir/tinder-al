<?php

class BaseController {

    public static function DBQuery($query) {
        global $db;
        $query = 'SELECT * FROM user;'; 

        // on passe le query à la bdd
        $result = $db->query($query);

        // on recup le resultat
        $users = $result->fetchAll();
        
    }

    public static function DBQuery($query) {
        global $db;
        $query = 'SELECT * FROM user;'; 

        // on passe le query à la bdd
        $result = $db->query($query);

        // on recup le resultat
        $users = $result->fetchAll();
        
    }
}