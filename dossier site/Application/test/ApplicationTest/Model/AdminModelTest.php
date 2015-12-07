<?php

namespace ApplicationTest\Model;

use Application\Model\AdminModel;
use Application\Model\Rubrique;
use Application\Model\Menu;
use Application\Model\Publication;

class AdminModelTest extends \PHPUnit_Framework_TestCase
{
    private $adminModel;
    private $rubrique;
    private $menu;
    private $publication;
    private $token;
    
    public function setUp()
    {
        $this->adminModel = new AdminModel();
        $this->token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        
        $this->rubrique = new Rubrique();
        $this->rubrique->content_fr = 'Bonjour le monde !';
        $this->rubrique->content_en = 'Hello world !';
        
        $this->menu = new Menu(null, null, 'My title', 0, 5);
        $this->menu->titre_en = 'English rubric test';
        $this->menu->actif = 1;
        
        $this->publication = new Publication();
        $this->publication->auteurs = 'A, B and C';
        $this->publication->reference = 'REF007';
        $this->publication->date = '2000-01-01';            
    }
    
    ////////////////////////////////////////////////////////// Tests CONNEXION /////////////////////////////////////////////////////////////
    
    /**
     * Test méthode VerifyUser avec des mauvais données
     * @expectedException \Exception
     */
    public function testVerifyUserBadDatas()
    {
        $this->adminModel->verifyUser('log','pass');
    }
    
    /**
     * Test méthode VerifyUser avec des bonnes données
     */
    public function testVerifyUserGoodDatas()
    {
        $this->assertEquals($this->token, $this->adminModel->verifyUser('admin','admin'));
    }
    
    
    ////////////////////////////////////////////////// Tests méthodes RUBRIQUES ////////////////////////////////////////////////////
    
    
    /**
     * @expectedException \Exception
     */
    public function testCreateRubriqueSansAuMoinsUnChampObligatoire()
    {
        //attribution des attributs de Menu faits dans le setUp
        //rubrique peut être vide
        $this->adminModel->createRubrique($this->token, $this->rubrique, $this->menu); //manque titre_fr
    }

    public function testCreateRubriqueAvecChampObligatoires()
    {
        $this->menu->titre_fr = 'Phase de test create'; //car pas fait dans le setUp
        //rubrique peut être vide
        $this->assertEquals('Rubrique created', $this->adminModel->createRubrique($this->token, $this->rubrique, $this->menu), 'bug creation rubrique'); //manque titre_fr
    }
    
    /**
     * @expectedException \Exception
     */
    public function testModifRubriqueSansAuMoinsUnChampObligatoire()
    {
        $this->menu->id = 4;
        $this->adminModel->modifRubrique($this->token, $this->rubrique, $this->menu); //manque titre_fr
    }
    
    public function testModifRubriqueAvecChampObligatoires()
    {
        $this->menu->id = 4; //id ok
        $this->menu->titre_fr = 'Phase de test modif';
        $this->assertEquals('Rubrique updated', $this->adminModel->modifRubrique($this->token, $this->rubrique, $this->menu), 'bug modif rubrique'); 
    }
    
    /**
     * @expectedException \Exception
     */
    public function testModifRubriqueAvecBadId()
    {
        $this->menu->id = 0; //mauvais id
        $this->menu->titre_fr = 'Phase de test modif';
        $this->adminModel->modifRubrique($this->token, $this->rubrique, $this->menu);
    }
    
    /**
     * @expectedException \Exception
     */
    public function testDeleteRubriqueAvecBadId()
    {
        $this->adminModel->deleteRubrique($this->token, 0); //mauvais id
    }
    
    /**
     * @expectedException \Exception
     */
    public function testDeleteRubriqueAvecBadToken()
    {
        $this->adminModel->deleteRubrique('tokenpasbon', 29); //bon id
    }

    public function testDeleteRubriqueAvecTokenOkAndIdOk()
    {
        $this->assertEquals('Rubrique deleted', $this->adminModel->deleteRubrique($this->token, 6));
    }
    
    
    
    ////////////////////////////////////////////////// Tests méthodes PUBLICATIONS //////////////////////////////////////////////////

    /**
     * @expectedException \Exception
     */
    public function testCreatePublicationSansAuMoinsUnChampObligatoire()
    {
        $this->adminModel->createPublication($this->token, $this->publication);
    }
    
    public function testCreatePublicationAvecChampObligatoires()
    {
        $this->publication->titre = 'La publication de fou create';
        $this->assertEquals('Publication created', $this->adminModel->createPublication($this->token, $this->publication), 'bug creation publi');
    }
    
    /**
     * @expectedException \Exception
     */
    public function testModifPublicationSansAuMoinsUnChampObligatoire()
    {
        $this->publication->id = 5475;
        $this->publication->reference = null;
        $this->adminModel->modifPublication($this->token, $this->publication);
    }
    
    /**
     * @expectedException \Exception
     */
    public function testModifPublicationAvecBadId()
    {
        $this->publication->id = 0;
        $this->publication->titre = 'La publication de fou modif';
        $this->adminModel->modifPublication($this->token, $this->publication);
    }
    
    public function testModifPublicationAvecChampObligatoires()
    {
        $this->publication->id = 5475;
        $this->publication->titre = 'La publication de fou modif';
        $this->assertEquals('Publication updated', $this->adminModel->modifPublication($this->token, $this->publication), 'bug modif publi');
    }
    
    /**
     * @expectedException \Exception
     */
    public function testDeletePublicationAvecBadId()
    {
        $this->adminModel->deletePublication($this->token, 0);
    }

    /**
     * @expectedException \Exception
     */
    public function testDeletePublicationAvecBadToken()
    {
        $this->adminModel->deletePublication('tokenpasbon', 200);
    }
    
    public function testDeletePublicationAvecTokenOk()
    {
        $this->assertEquals('Publication deleted', $this->adminModel->deletePublication($this->token, 6509));
    }
    
}