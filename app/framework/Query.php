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
        "condition"=>["1"],
    ];
    
    private $datas;
    private $records = [];

    private $instancialized = false;

    function __construct($model, $fetchAll=false) {
        $this->model = $model;
        $this->fetchAll = $fetchAll;

        $this->baseQueryData["table"] = $model->table;

        $this->emptyQuery();
    }

    function saveQueryToQueries() {
        array_push($this->queries, $this->currentQuery);
        $this->emptyQuery();
    }
    function emptyQuery() {
        $this->currentQuery = $this->baseQueryData;
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
        $this->saveQueryToQueries();
        global $db;

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



    // query building
    public function getPartialOperation($qd) {
        $txt = "";
        if(!isset($qd["operation"]) || !$qd["operation"]) return $txt;
        $txt.= $qd["operation"];
        $txt.= " ";
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
    public function getBuildedPartialQuery($qd) {
        return $this->getPartialOperation($qd) . $qd["action"] . " " . $qd["columns"] . " FROM " . $qd["table"] . $this->getPartialCondition($qd) . " ";
    }

    public function getBuildedQuery() {
        $query = "";
        foreach($this->queries as $q) {
            $query.= $this->getBuildedPartialQuery($q);
        }
        $query.=";";

        return $query;
    }

   
}
