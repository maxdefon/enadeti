<?php

namespace enade\controller ;

include_once 'vendor/autoload.php';

use \enade\controller\ChecklistController;
use \enade\controller\UserController;
use \enade\repository\ChecklistRepo;
use \enade\repository\UserRepo;

class ChecklistControllerTest extends \PHPUnit_Framework_TestCase {

    public function setup() {
        if ( !isset( $_SESSION ) ) $_SESSION = array(  );
        include 'config.php';
    }

    public function testMarkDone() {
      $userRepo = new UserRepo;
      $user = $userRepo->create(['email'=>"foo@bar.com","password"=>'123','registration'=>'321']);

      unset($_SESSION["user_id"]);

      $control = new ChecklistController;

      $_POST["step_id"]=1;
      $_POST["user_id"]=$user->user_id;

      $nok = $control->post();
      $this->assertEquals($nok,"false");

      $_SESSION["user_id"] = $user->user_id;

      $control->post();

      $checklistJson = $control->get();
      $checklist = json_decode($checklistJson);

      $this->assertEquals(count( $checklist ),1);
      $this->assertEquals($checklist[0]->step_id, 1);

      $_POST["step_id"]=2;
      $_POST["user_id"]=$user->user_id;

      $control->post();

      $checklistJson = $control->get();
      $checklist = json_decode($checklistJson);

      $this->assertEquals(count( $checklist ),2);
      $this->assertEquals($checklist[0]->step_id, 1);
      $this->assertEquals($checklist[1]->step_id, 2);

      $userRepo->deleteByEmail("foo@bar.com");
    }
}

