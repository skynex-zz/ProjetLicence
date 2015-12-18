<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PublicationControllerTest extends AbstractHttpControllerTestCase
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
		$this->dispatch('/publication/fr/categ');
		$this->assertResponseStatusCode(200);

		$this->assertModuleName('Application');
		$this->assertControllerName('Application\Controller\Publication');
		$this->assertControllerClass('PublicationController');
		$this->assertMatchedRouteName('publications');
	}
	
	public function testIndexActionCantBeAccessed()
	{
		$this->dispatch('/publication');
		$this->assertResponseStatusCode(200);

		$this->assertModuleName('Application');
		$this->assertControllerName('Application\Controller\Publication');
		$this->assertControllerClass('PublicationController');
		$this->assertMatchedRouteName('publications');
	}
}
?>