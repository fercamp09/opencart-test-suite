[![Build Status](https://travis-ci.org/beyondit/opencart-test-suite.svg?branch=master)](https://travis-ci.org/beyondit/opencart-test-suite)

# OpenCart Testing Suite



## Motivation
The intend of this project is to provide a simple approach for setting up a test suite for custom OpenCart (v2.2.0.0) development. 

## Getting started

1. Descargar el proyecto de github (https://github.com/fercamp09/opencart-test-suite) o en git bash ejecutar: 
```bash
   git clone https://github.com/fercamp09/opencart-test-suite.git
```
2. Crear un archivo para pruebas. Ej: NuevoTest.php
```php
   <?php
   require_once __DIR__ . '/../src/OpenCartTest.php';

   class NuevoTest extends OpenCartTest
   {
       public function testIsAdmin()
       {
           $this->assertFalse($this->isAdmin());
       }  
   }
```
3. Agregar una entrada a <testsuite> en el archivo phpunit.xml,
dependiendo si es prueba de catalogo (name="catalog-tests") o de admin (name="admin-tests"). La entrada debe ser:
```bash
   <file>./tests/NuevoTest.php</file>
```
- Para correr las pruebas con travis:

4. Actualizar el proyecto en el repositorio: 
```bash
   git add . 
   git commit -m "Nuevotest implementado"
   git push origin master
```
5. Ir a travis, ver como se instala y se ejecuta el proyecto. Si hay errores, leerlos y luego corregirlos.

- Para correr las pruebas localmente (Alfa): 
Ir a la carpeta raiz donde se descargo el proyecto. Ejecutar los comandos del travis.yml en un bash o un cmd prompt:

Descomentar en src\OpenCartTest.php la linea 16
```bash
   composer install // si es que no lo tiene ya instalado
   echo "USE mysql;\nUPDATE user SET password=PASSWORD('root') WHERE user='root';\nFLUSH PRIVILEGES;\n" | mysql -u root
   bin/robo travis:opencart-setup
   bin/phpunit --testsuite catalog-tests
   bin/phpunit --testsuite admin-tests
```
Otra forma:
The easiest way to get started, is to use their [Opencart Project Template](https://github.com/beyondit/opencart-project-template).
			
## Examples

### Testing a Model

```php
class ModelCatalogManufacturerTest extends OpenCartTest
{	
	public function testASpecificManufacturer()
	{
		
		// load the manufacturer model
		$model = $this->loadModel("catalog/manufacturer");
		$manufacturer = $model->getManufacturer(5);		
		
		// test a specific assertion
		$this->assertEquals('HTC', $manufacturer['name']);
		
	}	
}
```

### Testing a Controller
```php
class ControllerCheckoutCartTest extends OpenCartTest
{	
	public function testAddingASpecificProductToTheCart()
	{
			
		$response = $this->dispatchAction('checkout/cart/add','POST',['product_id' => 28]);
        $output = json_decode($response->getOutput(),true);
        
        $this->assertTrue(isset($output['success']) && isset($output['total']));
        $this->assertRegExp('/HTC Touch HD/', $output['success']);
        
	}	
}
```

### Testing with logged in Customers
```php
class ControllerAccountEditTest extends OpenCartTest {  
    public function testEditAccountWithLoggedInCustomer() {

        $this->login('somebody@test.com','password');
        
        $response = $this->dispatchAction('account/edit');
        $this->assertRegExp('/Your Personal Details/',$response->getOutput());
        
        $this->logout();
        
    }   
}
```

### Testing with logged in Users inside Admin

In order to test classes inside the admin folder just call your test class ending with `AdminTest` e.g. `ModelCatalogCategoryAdminTest`

```php
class ControllerCommonDashboardAdminTest extends OpenCartTest {  
    public function testShowDashboardWithLoggedInUser() {

        $this->login('admin','admin');
        
        $response = $this->dispatchAction('common/dashboard');
        $this->assertRegExp('/Total Sales/', $response->getOutput());
        
        $this->logout();
        
    }   
}
```

