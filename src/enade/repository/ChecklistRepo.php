<?php

namespace enade\repository;

use \enade\model\Step;

class ChecklistRepo {

    private $db;

    public function __construct() {
        $this->db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
    }

    public function markDone($user_id,$step_id) {
        $q = $this->db->prepare("INSERT INTO checklist (user_id,step_id) VALUES (?,?);");
        $r = $q->execute(array($user_id,$step_id));
        return $r;
    }

    public function getDone($user_id) {
        $done = array();
        $q = $this->db->prepare("SELECT * from checklist inner join steps on steps.step_id = checklist.step_id where user_id = ?");
        $q->execute(array($user_id));
        while($row = $q->fetchObject()) {
            $step =  new Step;
            foreach($row as $k=>$v) {
                $step->$k = $v;
            }
            $done[] = $step;
        }
        return $done;
    }

}
