<?php

namespace enade\repository ;

include_once 'vendor/autoload.php';

class ChecklistRepoTest extends \PHPUnit_Framework_TestCase {

    public function setup() {
        include 'config.php';
    }

    public function testMarkDone() {
        $userRepo = new UserRepo;
        $userRepo->create(['email'=>"foo@bar.com",'password'=>'123','registration'=>'321']);
        $user = $userRepo->getByEmail('foo@bar.com');

        $checkRepo = new ChecklistRepo;
        $checkRepo->markDone($user->user_id,1);
        $checkRepo->markDone($user->user_id,2);

        $done = $checkRepo->getDone($user->user_id);

        $this->assertEquals(count($done),2);
        $this->assertEquals($done[0]->step_id,1);
        $this->assertEquals($done[1]->step_id,2);

        $userRepo->deleteByEmail("foo@bar.com");
    }

}
