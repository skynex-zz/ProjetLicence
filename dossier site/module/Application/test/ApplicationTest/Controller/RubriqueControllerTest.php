<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class RubriqueControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include 'C:/wamp/www/zf2/config/application.config.php'
        );
        parent::setUp();
    }

	public function testIndexActionCanBeAccessed()
	{
		$this->dispatch('/rubrique/fr/2');
		$this->assertResponseStatusCode(200);

		$this->assertModuleName('Application');
		$this->assertControllerName('Application\Controller\Rubrique');
		$this->assertControllerClass('RubriqueController');
		$this->assertMatchedRouteName('laRubrique');
	}
	public function testIndexActionCantBeAccessed()
	{
		$this->dispatch('/rubrique');
		$this->assertResponseStatusCode(200);

		$this->assertModuleName('Application');
		$this->assertControllerName('Application\Controller\Rubrique');
		$this->assertControllerClass('RubriqueController');
		$this->assertMatchedRouteName('laRubrique');
	}
}
?>