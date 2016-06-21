<?php

require_once __DIR__ . '/../src/OpenCartTest.php';

    class ManufacturerTest extends OpenCartTest
    {
        public function testModel()
        {
            $model = $this->loadModel("catalog/manufacturer");
            $manufacturer = $model->getManufacturer(5);
            $this->assertEquals('HTC', $manufacturer['name']);
        }
        
    }
