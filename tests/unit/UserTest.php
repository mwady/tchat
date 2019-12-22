<?php

final class UserTest extends \PHPUnit_Framework_TestCase
{

    public function testThatWeCanFindUser(){

        $user = new \App\Models\User;
        $user->signIn('mwady');

        $this->assertEquals($user->signIn(), 'mwady');

    }

    public function testThatWeCanGetUserConnected(){

        $user = new \App\Models\User;
        $user->getUserConnected(1);

        $this->assertEquals($user->getUserConnected(), 1);

    }

}