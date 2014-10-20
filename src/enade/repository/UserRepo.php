<?php

namespace enade\repository;

use \enade\model\User ;

class UserRepo {

    private $db;

    public function __construct() {
        $this->db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
    }

    public function create($data) {
      if(!isset($data["email"]) || strlen($data["email"]) < 1) {
        return false;
      }
      if(!isset($data["password"]) || strlen($data["password"]) < 1) {
        return false;
      }
      if(!isset($data["registration"]) || strlen($data["registration"]) < 1) {
        return false;
      }

      if(!isset( $data["name"] )) $data["name"] = "";

      $exists = $this->getByEmail($data["email"]);
      if($exists) {
        return false;
      }
      $exists = $this->getByRegistration($data["registration"]);
      if($exists) {
        return false;
      }

      $data["user_id"] = uniqid();

      $query = $this->db->prepare("INSERT INTO users (user_id,email,name,password,registration,active) VALUES (?,?,?,?,?,?);");
      $query->execute(array($data["user_id"],$data["email"],$data["name"],md5($data["password"]),$data["registration"],1));

      $error = $query->errorInfo();
      if($error[0] != "00000") {
        throw new \Exception(json_encode($error));
      }  

      return true;
    }

    public function getByEmail($email) {
      return $this->getBy("email",$email);
    }
    public function getByRegistration($registration) {
      return $this->getBy("registration",$registration);
    }

    public function getBy($key,$value) {
      $query = $this->db->prepare("SELECT * FROM users WHERE ".$key." = ? ;");
      $query->execute(array($value));
      $data  = $query->fetchObject();
      if(!$data){
        return null;
      }

      $user = new User;
      foreach($data as $k=>$v) {
        $user->$k=$v;
      }
      return $user;
    }

    public function getByLogin($email,$password) {
    }

    public function deleteByEmail($email) {
    }

}

