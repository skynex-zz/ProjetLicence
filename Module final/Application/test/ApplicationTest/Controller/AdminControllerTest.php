<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Application\Controller\AdminController;
use Zend\Session\Container;

class AdminControllerTest extends AbstractHttpControllerTestCase
{
    private $session;
    private $controller;
    protected $traceError = true;
    
    public function setUp()
    {
        $this->setApplicationConfig(
            include '/wamp/www/zf2/config/application.config.php'
        );
        parent::setUp();
        $this->controller = new AdminController();
        $this->session = new Container('user');
        $this->session->token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
    }
    
    /**
     * Test emmene bien sur login si on n'est pas déjà connecté
     */
    public function testLoginActionPasConnecte()
    {
        $this->session->token = null;
        $this->dispatch('/login/fr');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Admin');
        $this->assertControllerClass('AdminController');
        $this->assertMatchedRouteName('login');
    }
    
    /**
     * Test redirige bien sur l'admin si on tente de se connecter alors qu'on est déjà connecté
     */
    public function testLoginActionDejaConnecte()
    {
        $this->dispatch('/login/fr');
        $this->assertResponseStatusCode(302); //test si redirection
        $this->assertResponseHeaderContains('Location' , '/admin/fr'); //test si redirection vers home
    }
    
    /**
     * Test avec les bons identifiants -> interface d'admin
     */
    public function testConnexionAdminOk() {
        $this->session->token = null;
        $this->dispatch('/login/fr', 'POST', array('login' => 'admin', 'password' => 'admin'));
        $this->assertResponseStatusCode(302); //test si redirection 
        $this->assertResponseHeaderContains('Location' , '/admin/fr'); //test si redirection vers admin
    }
    
    /**
     * Test avec les mauvais identifiants -> réactualise login
     */
    public function testConnexionAdminNotOk() {
        $this->session->token = null;
        $this->dispatch('/login/fr', 'POST', array('login' => 'maison', 'password' => 'asse'));
        $this->assertResponseStatusCode(200); //reste sur login
    }
    
    public function testIndexActionPasConnecte() {
        $this->session->token = null;
        $this->dispatch('/admin/fr');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }
    
    public function testIndexActionConnecte() {
        $this->dispatch('/admin/fr');
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('admin');
        /*$vm = $this->controller->dispatch('/admin/fr');
        $this->assertResponseStatusCode(200);
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $vm);
        $vars = $vm->getVariables();
        $this->assertTrue(isset($vars['listeRubrique']));
        $this->assertTrue(isset($vars['listePublications']));
        $this->assertTrue(isset($vars['langue']));*/
    }
    
    /**
     * Test déconnexion -> home
     */
    public function testDeconnexion() {
       $this->dispatch('/disconnect/fr');
       $this->assertResponseStatusCode(302); //test si redirection
       $this->assertResponseHeaderContains('Location' , '/'); //test si redirection vers home
       //$this->assertRedirectTo('home'); 
    }
    
}