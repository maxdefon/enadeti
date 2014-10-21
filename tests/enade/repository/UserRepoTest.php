<?php

namespace enade\repository ;

include_once 'vendor/autoload.php';

class UserRepoTest extends \PHPUnit_Framework_TestCase {

    public function setup() {
        include 'config.php';
    }

    public function testCreation() {
      $repo = new UserRepo;

      $this->assertFalse($repo->create(['name'=>'Foo']),"Should not create without email");
      $this->assertFalse($repo->create(['email'=>"foo@bar.com"]),"Should not create without password");
      $this->assertFalse($repo->create(['email'=>'foo@bar.com','password'=>"123"]),"Should not create without registration");
      $this->assertTrue($repo->create(['email'=>"foo@bar.com","password"=>"123","registration"=>"321"]),"Should create with all data");
      $this->assertFalse($repo->create(['email'=>"foo@bar.com","password"=>"123","registration"=>"321"]),"Should not create repeated email");
      $this->assertFalse($repo->create(['email'=>"fuz@bar.com","password"=>"123","registration"=>"321"]),"Should not create repeated registration");

      $user = $repo->getByEmail("foo@bar.com");
      $this->assertEquals("321",$user->registration,"Should find inserted user");
      $repo->deleteByEmail("foo@bar.com");
      $user = $repo->getByEmail("foo@bar.com");
      $this->assertNull($user,"Should not find deleted user");
    }

    public function testLogin() {
      $repo = new UserRepo;
      $repo->create(['email'=>"foo@bar.com","password"=>"123","registration"=>"321"]);
      $user = $repo->getByLogin("foo@bar.com","111");
      $this->assertNull($user);
      $user = $repo->getByLogin("foo@bar.com","123");
      $this->assertEquals($user->registration,"321");
    }

}

