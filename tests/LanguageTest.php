<?php

require_once __DIR__ . '/../src/OpenCartTest.php';

class LanguageTest extends OpenCartTest
{

    public function testEnglishLanguage()
    {
        $model = $this->loadModel("localisation/language");
        $language = $model->getLanguage(1);
        $this->assertEquals('English', $language['name']);
        $this->assertEquals('en-gb', $language['code']);
    }

}
