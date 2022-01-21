<?php


class Model {


    // nom de la table dans la bdd
    // public $table = "";

    // colonnes de la table (id, ...)
    public $columns = [];

    // data récupérée depuis la bdd
    private $data;

    function __construct($data) {

        $this->data = $data;
    }


    // permet de récupérer les données via une flèche
    function __get($name){
        if(in_array($name, $this->columns)) {
            return $this->data[$name];
        }
    }


    public static function DBExec($query, $params) {
        global $db;
    
        $request = '';
        
        // query à bind;
        $query = $db->prepare($request);
    
        // on bind les parametres un à un
        // i va de 1 à longueur de(params)
        // chaque paramètre doit avoir la forme [valeur, type]
        for($i=1; $i<=count($params); $i++) {
            $query->bindValue($i, $params[$i][0], $params[$i][1]);
        }
    
        $query->execute();
        $query->closeCursor();        
    }

    public static function getQueryResult($columns, $query) {
        global $db;
        
        $fullQuery = 'SELECT '.$columns.' FROM '.static::$table.' '.$query.';';

        return $db->query($fullQuery);
    }
    
    public static function DBQueryAll($columns, $query='') {
        // on passe le query à la bdd
        $result = self::getQueryResult($columns, $query);
    
        // on recup les resultat
        $queryResults = $result->fetchAll();
    
        return self::instancializeResults($queryResults);
    }
    
    public static function DBQuery($columns, $query='') {
        $result = self::getQueryResult($columns, $query);
    
        // on recup le resultat
        $queryResult = $result->fetch();

        return self::instancializeResult($queryResult);
    }


    
    // instantialise les classes DES RESULTATS
    public static function instancializeResults($queryResults) {
        $models = [];
        foreach($queryResults as $queryResult) {
            array_push($models, self::instancializeResult($queryResult));
        }

        return $models;
    }

    // instantialise les classes D'UN RESULTAT
    public static function instancializeResult($queryResult) {
        return new static($queryResult);
    }

}