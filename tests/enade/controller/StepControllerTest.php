<?php

namespace enade\controller ;

include_once 'vendor/autoload.php';

use \enade\controller\StepController;

class StepControllerTest extends \PHPUnit_Framework_TestCase {

    public function setup() {
        include 'config.php';
    }

    public function testList() {
        $control = new StepController ; 
        $json = $control->get();
        $obj = json_decode($json);
        $this->assertTrue(is_array($obj));
        $this->assertEquals(count($obj),3);
    }

}

