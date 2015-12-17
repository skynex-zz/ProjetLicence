<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Session\Container;

class AdminRubriqueControllerTest extends AbstractHttpControllerTestCase
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
    
    public function testCreateRubriqueActionAccesPasConnecte() {
        $this->session->token = null;
        $this->dispatch('/admin/fr/createrubrique');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }
    
    public function testCreateRubriqueActionAccessConnecte() {
        $this->dispatch('/admin/fr/createrubrique');
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('createrubrique');
    }
    
    public function testCreateRubriqueActionAvecGoodDatas() {
        $postDatas = array(
            'content_en' => 'english', 
            'content_fr' => 'francais',
            'position' => '10',
            'titre_en' => 'Title',
            'titre_fr' => 'Titre',
            'actifradio' => '0',
            'submit' => 'Valider',
        );
        $this->dispatch('/admin/fr/createrubrique', 'POST', $postDatas);
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/admin/fr?successCrR=creationrubrique');
    }
    
    //manque 'actifradio'
    public function testCreateRubriqueActionAvecBadDatas() {
        $postDatas = array(
            'content_en' => 'english', 
            'content_fr' => 'français',
            'position' => '10',
            'titre_en' => 'Title',
            'titre_fr' => 'Titre',
        );
        $this->dispatch('/admin/fr/createrubrique', 'POST', $postDatas);
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('createrubrique');
    }
    
    public function testModifRubriqueActionAccesPasConnecte() {
        $this->session->token = null;
        $this->dispatch('/admin/fr/rubrique/50');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }
    
    public function testModifRubriqueActionAccessConnecte() {
        $this->dispatch('/admin/fr/rubrique/50');
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('admrubrique');
    }
    
    public function testModifRubriqueActionAvecBadId() {
        $this->dispatch('/admin/fr/rubrique/0');
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('admrubrique');
        //faire des que j'ai actualisé mon contrôleur
    }
    
    public function testModifRubriqueActionAvecGoodDatas() {
        $postDatas = array(
            'content_en' => 'english', 
            'content_fr' => 'francais',
            'position' => '2',
            'titre_en' => 'Title',
            'titre_fr' => 'Titre',
            'actifradio' => '0',
            'submit' => 'Valider',
        );
        $this->dispatch('/admin/fr/rubrique/9', 'POST', $postDatas);
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/admin/fr?successMdfR=modifrubrique');
    }
    
    //manque 'actifradio'
    public function testModifRubriqueActionAvecBadDatas() {
        $postDatas = array(
            'content_en' => 'english', 
            'content_fr' => 'français',
            'position' => '10',
            'titre_en' => 'Title',
            'titre_fr' => 'Titre',
        );
        $this->dispatch('/admin/fr/rubrique/9', 'POST', $postDatas);
        $this->assertResponseStatusCode(200);
        $this->assertMatchedRouteName('admrubrique');
    }
    
    public function testDeleteRubriqueActionAccesPasConnecte() {
        $this->session->token = null;
        $this->dispatch('/admin/fr/deleterubrique/0'); //peu importe l'id vu quon doit être redirigé au debut
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }
    
    public function testDeleteRubriqueActionAccessConnecte() {
        $this->dispatch('/admin/fr/deleterubrique/12');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/admin/fr?successDltR=deleterubrique');
    }
    
    public function testDeleteRubriqueActionAvecBadId() {
        $this->dispatch('/admin/fr/deleterubrique/0');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/admin/fr?errorDltR=errordeleterubrique');
        //faire des que j'ai actualisé mon contrôleur
    }
    
}