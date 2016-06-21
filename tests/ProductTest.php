<?php

require_once __DIR__ . '/../src/OpenCartTest.php';

class ProductTest extends OpenCartTest
{
    public function testProductName()
    {
        $model = $this->loadModel("catalog/product");
        $product = $model->getProduct(35);
        $this->assertEquals('Product 8', $product['name']);

    }

    public function testProductQuantity()
    {
        $model = $this->loadModel("catalog/product");
        $product = $model->getProduct(28);
        $this->assertEquals('939', $product['quantity']);

    }
}
