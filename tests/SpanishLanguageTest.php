<?php

require_once __DIR__ . '/../src/OpenCartTest.php';

class SpanishLanguageTest extends OpenCartTest
{

    public function testCreatingAndLoggingInACustomer()
    {
        $model = $this->loadModel("localisation/language");
        $language = $model->getLanguage(2);
        $this->assertEquals('Español', $language['name']);
        $this->assertEquals('es-es', $language['code']);
    }

}
