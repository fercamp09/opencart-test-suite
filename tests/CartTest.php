<?php

require_once __DIR__ . '/../src/OpenCartTest.php';

class CartTest extends OpenCartTest
{
    public function testDispatchingToCartAdd()
    {
        $response = $this->dispatchAction('checkout/cart/add','POST',['product_id' => 28]);
        $output = json_decode($response->getOutput(),true);
        $this->assertTrue(isset($output['success']) && isset($output['total']));
        $this->assertRegExp('/HTC Touch HD/', $output['success']);
    }
}