<?php

namespace enade\repository ;

include_once 'vendor/autoload.php';

class StepRepoTest extends \PHPUnit_Framework_TestCase {

    public function setup() {
        include 'config.php';
    }

    public function testList() {
        $repo = new StepRepo;
        $steps = $repo->getAll();
        $this->assertEquals(count($steps),3);
    }

}

