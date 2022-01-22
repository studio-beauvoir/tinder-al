<?php

class Query {


    private $model;

    private $fetchAll;


    private $queries = [];
    private $currentQuery = [];

    private $baseQueryData = [
        "action"=>"SELECT",
        "columns"=>"*",
        "table"=>null,
        "set"=>false,
        "values"=>false,
        "condition"=>["1"],
    ];
    
    private $datas;
    private $records = [];

    private $instancialized = false;
    private $fetched = false;

    function __construct($model, $fetchAll=false) {
        $this->model = $model;
        $this->fetchAll = $fetchAll;

        $this->baseQueryData["table"] = $model->table;

        $this->emptyQuery();

        return $this;
    }

    function saveQueryToQueries() {
        array_push($this->queries, $this->currentQuery);
        $this->emptyQuery();

        return $this;
    }
    function emptyQuery() {
        $this->currentQuery = $this->baseQueryData;

        return $this;
    }


    //methods for the query
    public function action($action)
    {
        // SELECT, UPDATE, DELETE ...
        $this->currentQuery["action"] = $action;
        return $this;
    }

    public function buildFromModel() 
    {
        // create condition WHERE from table primary key
        $cond = $this->model->primaryKey . " = " . $this->model->getPrimaryKeyValue();
        $this->where($cond);
        return $this;
    }

    
    public function values($values) {
        if($this->currentQuery["values"] === false) {
            $this->currentQuery["values"] = [];
        }

        foreach($values as $col => $val) {
            $this->currentQuery["values"][$col]=$val;
        }
        return $this;
    }

    public function set($set) {
        if($this->currentQuery["set"] === false) {
            $this->currentQuery["set"] = [];
        }
        array_push(
            $this->currentQuery["set"],
            $set
        );
        return $this;
    }

    //methods for the query
    public function table($tableName) {
        $this->currentQuery["table"] = $tableName;
        return $this;
    }

    //methods for the query
    public function where($cond) {
        $this->currentQuery["condition"] = [$cond];
        return $this;
    }
    public function andWhere($cond) {
        array_push(
            $this->currentQuery["condition"],
            "AND $cond"
        );
        return $this;
    }
    public function orWhere($cond) {
        array_push(
            $this->currentQuery["condition"],
            "OR $cond"
        );

        return $this;
    }




    public function all() {
        $this->fetchAll=true;
        $this->fetch();
        // if(count($this->records) <= 0) throw new QueryException('There is no record in this query');
        return $this->records;
    }

    public function get() {
        $this->fetch();
        // if(count($this->records) <= 0) throw new QueryException('There is no record in this query');
        return $this->records;
    }

    public function first() {
        $this->fetch();
        if(count($this->records) <= 0) throw new QueryException('There is no record in this query');
        return $this->records[0];
    }

    public function exists() {
        $this->fetch();
        return count($this->records) > 0;
    }

    public function count() {
        $this->fetch();
        if(!$this->instancialized) throw new QueryException('Query not yet fetched.');
        return count($this->records);
    }



    

    public function fetch() {
        if($this->fetched) return;

        $this->fetched = true;

        $this->saveQueryToQueries();
        global $db;

        // var_dump($this->queries);
        // echo $this->getBuildedQuery();
        // die();
        $result = $db->query($this->getBuildedQuery());

        if($this->fetchAll) {
            $this->datas = $result->fetchAll();
        } else {
            $this->datas = [$result->fetch()];
        }

        $this->instancializeResults();
    }

    public function instancializeResults() {
        foreach($this->datas as $data) {
            if($data) {
                $newModel = clone $this->model;
                $newModel->fillData($data);
                array_push($this->records, $newModel);
            }
        }
        $this->instancialized = true;
    }



    public function getPartialOperation($qd) {
        // UNION etc.
        $txt = "";
        if(!isset($qd["operation"]) || !$qd["operation"]) return $txt;
        $txt.= $qd["operation"];
        $txt.= " ";
        return $txt;
    }

    public function getPartialSet($qd) {
        $txt = "";

        if(!isset($qd["set"]) || !$qd["set"] || count($qd["set"]) < 0) return $txt;
        
        $txt.=" SET";

        foreach($qd["set"] as $index => $cond) {
            $txt.=" ";
            $txt.=$cond;
            if($index !== array_key_last($qd["set"])) {
                $txt.=",";
            }
        }

        return $txt;
    }

    public function getPartialValues($qd) {
        $txt = "";

        if(!isset($qd["values"]) || !$qd["values"] || count($qd["values"]) < 0) return $txt;
        
        $txt.=" ";

        $cols = "(";
        $values = "(";
        foreach($qd["values"] as $col => $val) {
            $cols .= $col;
            $values .= $val;
            if($col !== array_key_last($qd["values"])) {
                $cols .= ", ";
                $values .= ", ";
            }
        }
        $cols .= ")";
        $values .= ")";

        $txt.=$cols;
        $txt.=" VALUES ";
        $txt.=$values;

        return $txt;
    }

    public function getPartialCondition($qd) {
        $txt = "";
        if(!isset($qd["condition"]) || !$qd["condition"] || count($qd["condition"]) < 0) return $txt;
        
        $txt.=" WHERE";

        foreach($qd["condition"] as $cond) {
            $txt.=" ";
            $txt.=$cond;
        }

        return $txt;
    }

    public function getBuildedPartialAction($qd) {
        switch($qd['action']) {
            case "UPDATE":
                return "UPDATE ".$qd["table"] . $this->getPartialSet($qd) . $this->getPartialCondition($qd);
            case "SELECT":
                return "SELECT ".$qd["columns"] . " FROM " . $qd["table"] . $this->getPartialCondition($qd);
            case "INSERT":
                return "INSERT INTO ".$qd["table"].$this->getPartialValues($qd);
        }
    }

    public function getBuildedPartialQuery($qd) {
        return $this->getPartialOperation($qd) . $this->getBuildedPartialAction($qd) . " ";
    }

    public function getBuildedQuery() {
        $query = "";
        foreach($this->queries as $q) {
            $query.= $this->getBuildedPartialQuery($q);
        }
        $query.=";";
        // var_dump($query);

        return $query;
    }

   
}
