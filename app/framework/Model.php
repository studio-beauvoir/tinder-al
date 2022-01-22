<?php

require_once APP_ROOT . '/framework/Query.php';

class Model {


    // nom de la table dans la bdd
    // public $table = "";

    // colonnes de la table (id, ...)
    public $columns = [];

    // data récupérée depuis la bdd
    private $data;

    function __construct() {}
    
    function fillData($data) {
        $this->data = $data;
    }


    // permet de récupérer les données via une flèche
    function __get($name){
        if($name==="table") {
            return static::$table;
        }
        if(in_array($name, $this->columns)) {
            return $this->data[$name];
        }
    }


    public function getPrimaryKeyValue() {
        return $this->data[$this->primaryKey];
    }

    public static function DBExec($request, $params) {
        global $db;
    
        $result = $db->prepare($request);
        foreach($params as $key => $value) {
            $result->bindValue(":var".$key, $value);
        }
        var_dump($result);
        $result->execute();       
    }


    public static function DBCreate($params) {
        $request = static::DBQuery()->table(static::$table)->action('INSERT');

        $request->values($params);

        self::DBExec(
            $request->saveQueryToQueries()->getBuildedQuery(),
            $params
        );
    }

    public static function DBQuery() {
        return new Query(new static());
    }

    public function DBSelfQuery() {
        // permet de récup le 'UPDATE * FROM user WHERE idUser = 3 ;'
        // par exemple, depuis l'utilisateur déjà connecté (évite de nous faire faire le query)
        $query = new Query($this);
        return $query->buildFromModel($this);
    }

    public function DBExecOnSelf() {
        global $db;

        $request = $this->DBSelfQuery()->action('UPDATE');

        return $request;
    }

    public function DBUpdateOnSelf($params) {
        $request = $this->DBExecOnSelf();

        foreach($params as $key => $value) {
            $request->set($key." = :var".$key);
        }

        self::DBExec(
            $request->saveQueryToQueries()->getBuildedQuery(),
            $params
        );
    }

}