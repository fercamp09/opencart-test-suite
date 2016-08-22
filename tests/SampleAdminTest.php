<?php


require_once __DIR__ . '/../src/OpenCartTest.php';

class SampleAdminTest extends OpenCartTest
{

    public function testLoggedInCall()
    {
        $this->login('admin','admin');
        $response = $this->dispatchAction('common/dashboard');
        $this->assertRegExp('/Ventas Totales/', $response->getOutput());
        $this->logout();
    }

    public function testIsAdmin()
    {
        $this->assertTrue($this->isAdmin());
    }

    public function testAdminController()
    {
        $this->login('admin','admin');
        $response = $this->dispatchAction('common/dashboard');
        $this->assertRegExp('/Panel de Control/', $response->getOutput());
    }



}

