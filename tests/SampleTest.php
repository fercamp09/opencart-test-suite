<?php

require_once '../src/OpenCartTest.php';
OpenCartTest::$_OPENCART = dirname(dirname(__DIR__)) . "/";

class SampleTest extends OpenCartTest {
	

	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testACallToARequiredLoginAction() {
	
		$response = $this->dispatchAction('account/wishlist');
		$response->output();
	
	}
	
	public function testACallToARequiredLoginActionWithLoggedInCustomer() {
	
		$this->customerLogin("stefan.huber.mail@gmail.com", "password");		
		$response = $this->dispatchAction('account/wishlist');
		// $response->output();
	
	}
	
	public function testLoadingExamplaryController() {
		
		$controller = $this->loadControllerByRoute('product/product');			
		$this->assertInstanceOf('ControllerProductProduct', $controller);
		
	}
	
	public function testDispatchingExamplaryAction() {
		
		$response = $this->dispatchAction('product/product');
		$this->assertInstanceOf('Response', $response);
		
	}
	
	public function testLoadingExamplaryModel() {
		
		$model = $this->loadModelByRoute('catalog/category');
		$this->assertInstanceOf('ModelCatalogCategory', $model);
		
	}
	
	// this test only works if there exists a user with email: stefan.huber.mail@gmail.com and the password: password
	public function testLoggingInAndOutACustomer() {
		
		$this->customerLogin("stefan.huber.mail@gmail.com", "password");
		$this->assertGreaterThan(0,$this->customer->isLogged());
		
		$this->customerLogout();	
		$this->assertEmpty($this->customer->isLogged());		
		
	}

	
}