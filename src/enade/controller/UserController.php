<?php

namespace enade\controller;

use \Respect\Rest\Routable;

class UserController implements Routable {

  public function get() {
    $repo = new \enade\repository\UserRepo;
    $user = $repo->getByLogin($_GET["email"],$_GET["password"]);
    if(is_object($user)) $_SESSION["user_id"] = $user->user_id;
    $json = json_encode($user);
    if(!headers_sent()) header('Content-Type: application/json');
    return $json;
  }

  public function post() {
    $repo = new \enade\repository\UserRepo;
    $user = $repo->create($_POST);
    if(is_object($user)) $_SESSION["user_id"] = $user->user_id;
    $json = json_encode($user);
    if(!headers_sent()) header('Content-Type: application/json');
    return $json;
  }

}


