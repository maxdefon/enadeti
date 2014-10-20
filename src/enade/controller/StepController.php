<?php

namespace enade\controller;

use \Respect\Rest\Routable;

class StepController implements Routable {

  public function get() {
    $repo = new \enade\repository\StepRepo;
    $steps = $repo->getAll();
    $json = json_encode($steps);
    if(!headers_sent()) header('Content-Type: application/json');
    return $json;
  }

}

