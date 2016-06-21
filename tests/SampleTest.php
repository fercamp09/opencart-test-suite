<?php

require_once __DIR__ . '/../src/OpenCartTest.php';

class SampleTest extends OpenCartTest
{
    public function testIsAdmin()
    {
        $this->assertFalse($this->isAdmin());
    }
    
    
}
