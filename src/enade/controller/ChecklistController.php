<?php
namespace enade\controller;

use \Respect\Rest\Routable;
use \enade\repository\ChecklistRepo;

class ChecklistController implements Routable {

  public function get() {
    if(!headers_sent()) header('Content-Type: application/json');

    if(!isset($_SESSION["user_id"])) {
      return json_encode(false);
    }

    $repo = new ChecklistRepo;
    $r = $repo->getDone($_SESSION["user_id"]);
    return json_encode($r);
  }

  public function post() {
    if(!headers_sent()) header('Content-Type: application/json');

    if(!isset($_SESSION["user_id"])) {
      return json_encode(false);
    }

    $repo = new ChecklistRepo;
    $r = $repo->markDone($_POST["user_id"],$_POST["step_id"]);
    return json_encode($r);
  }

}

