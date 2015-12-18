<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Session\Container;

class AdminPublicationControllerTest extends AbstractHttpControllerTestCase
{
    private $session;
    protected $traceError = true;
    
    public function setUp()
    {
        $this->setApplicationConfig(
            include '/wamp/www/zf2/config/application.config.php'
        );
        parent::setUp();
        $this->session = new Container('user');
        $this->session->token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
    }
    
    public function testCreatePublicationActionAccesPasConnecte() {
        $this->session->token = null;
        $this->dispatch('/admin/fr/createpublication');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }
    
    public function testCreatePublicationActionAccessConnecte() {
        $this->dispatch('/admin/fr/createpublication');
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('createpublication');
    }
    
    public function testCreatePublicationActionAvecGoodDatas() {
        $postDatas = array(
            'titre' => 'title', 
            'reference' => 'ref',
            'auteurs' => 'auteurs',
            'categorie_id' => '1',
            'date' => '1900-01-01',
            'journal' => 'journaloooo', //optionnel
        );
        $this->dispatch('/admin/fr/createpublication', 'POST', $postDatas);
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/admin/fr?successCrP=creationpublication');
        //$this->assertMatchedRouteName('createpublication');
    }
    
    public function testCreatePublicationActionManqueUnChampObligatoire() {
        $postDatas = array(
            'titre' => 'title', 
            'reference' => 'ref',
            //'auteurs' => 'auteurs',
            'categorie_id' => '1',
            'date' => '1900-01-01',
            'journal' => 'journaloooo', //optionnel
        );
        $this->dispatch('/admin/fr/createrubrique', 'POST', $postDatas);
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('createrubrique');
    }
    
    public function testModifPublicationActionAccesPasConnecte() {
        $this->session->token = null;
        $this->dispatch('/admin/fr/publication/5469');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }
    
    public function testModifPublicationActionAccessConnecte() {
        $this->dispatch('/admin/fr/publication/5469');
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('admpublication');
    }
    
    /*public function testModifPublicationActionAvecBadId() {
        $this->dispatch('/admin/fr/publication/0');
        /*$this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('createrubrique');
        //faire des que j'ai actualisé mon contrôleur
    }
    
    public function testModifPublicationActionAvecGoodDatas() {
        /*$postDatas = array(
        );
        $this->dispatch('/admin/fr/createrubrique', 'POST', $postDatas);
        //$this->assertResponseStatusCode(302);
        //$this->assertRedirectTo('/admin/fr');
        $this->assertMatchedRouteName('createrubrique');
    }
    
    public function testModifPublicationActionAvecBadDatas() {
        /*$postDatas = array(
        );
        $this->dispatch('/admin/fr/createrubrique', 'POST', $postDatas);
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('createrubrique');
    }
    
    public function testDeletePublicationActionAccesPasConnecte() {
        $this->session->token = null;
        $this->dispatch('/admin/fr/deleterubrique/5470');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }
    
    public function testDeletePublicationActionAccessConnecte() {
        $this->dispatch('/admin/fr/deleterubrique/5470');
        $this->assertResponseStatusCode(302);
        $this->assertMatchedRouteName('admin');
    }
    
    public function testDeletePublicationActionAvecBadId() {
        $this->dispatch('/admin/fr/deleterubrique/0');
        /*$this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('createrubrique');
        //faire des que j'ai actualisé mon contrôleur
    }*/
    
}