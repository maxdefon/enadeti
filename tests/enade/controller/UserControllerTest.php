<?php

namespace enade\controller ;

include_once 'vendor/autoload.php';

use \enade\controller\UserController;
use \enade\repository\UserRepo;

class UserControllerTest extends \PHPUnit_Framework_TestCase {

    public function setup() {
        include 'config.php';
    }

    public function testLogin() {
        $control = new UserController ; 

        $_POST["email"] = "foo@bar.com";
        $_POST["password"] = "123";

        $json = $control->post();
        $obj = json_decode($json);
        $this->assertFalse($obj);

        $_POST["registration"] = "321";
        $json = $control->post();
        $obj = json_decode($json);
        $this->assertEquals($obj->email,"foo@bar.com");

        $_GET["email"] = "foo@bar.com";
        $_GET["password"] = "321";
        $json = $control->get();
        $obj = json_decode($json);
        $this->assertNull($obj);

        $_GET["email"] = "foo@bar.com";
        $_GET["password"] = "123";
        $json = $control->get();
        $obj = json_decode($json);
        $this->assertEquals($obj->email,"foo@bar.com");

        (new UserRepo)->deleteByEmail("foo@bar.com");
    }

}


