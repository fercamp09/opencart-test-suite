<?php

require_once __DIR__ . '/../src/OpenCartTest.php';

class CategoriesTest extends OpenCartTest
{

    public function testCategoryModel()
    {
        $model = $this->loadModel("catalog/category");
        $category = $model->getCategory(28);
        $this->assertEquals('Monitors', $category['meta_title']);
    }

}