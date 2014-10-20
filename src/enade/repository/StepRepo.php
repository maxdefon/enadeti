<?php

namespace enade\repository;

class StepRepo {

    private $db;

    public function __construct() {
        $this->db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
    }

    public function getAll() {
        $steps = array();
        $q = $this->db->query("select * from steps order by step_order;");
        while($row = $q->fetchObject()) {
            $step = new \enade\model\Step;
            foreach($row as $k=>$v) {
                $step->$k = $v;
            }
            $steps[]=$step;
        }

        return $steps;
    }
}

