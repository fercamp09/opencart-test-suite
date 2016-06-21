<?php

require_once __DIR__ . '/../src/OpenCartTest.php';

class AccountTest extends OpenCartTest
{
    public function testDispatchingToLogin()
    {
        $response = $this->dispatchAction('account/login');
        $this->assertRegExp('/I am a returning customer/',$response->getOutput());

        $this->assertTrue($this->login('somebody@test.com','password'));
        $this->assertTrue(!!$this->customer->isLogged());
    }
    
}