<?php

namespace ApplicationTest\Model;

use Application\Model\BibtexManagement;

class BibtexManagementTest extends \PHPUnit_Framework_TestCase
{
    private $bibmng;
    
    public function setUp()
    {
        $this->bibmng = new BibtexManagement();
    }
    
    public function testParsingWithFileNotFound() {
        $this->assertFalse($this->bibmng->parsing('monfichiernexistepas.bib'));
    }
    
    public function testParsingWithBadExt() {
        $this->assertFalse($this->bibmng->parsing('testnul.aaaaa'));
    }
    
    public function testParsingWithEmptyFile() {
        $this->assertFalse($this->bibmng->parsing('vide.bib'));
    }
    
    /**
     * Test de parsing de fichier avec des publications qui n'ont pas un ou plusieurs champs obligatoires
     */
    public function testParsingWithError() {
        $this->assertTrue(in_array('AL910000000', $this->bibmng->parsing('test4toustests.bib')));
        $this->assertTrue(in_array('LSGL94000000', $this->bibmng->parsing('test4toustests.bib')));
        $this->assertTrue(in_array('LPT890000000', $this->bibmng->parsing('test4toustests.bib')));
    }
    
    public function testParsing() {
        $this->assertTrue(is_array($this->bibmng->parsing('test3petit.bib')));
    }
    
    //peut-être test avec fausses catégories
    
    public function testMappingBibtexManqueReference() {
        $tab = array(
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            //'cite' => 'SGH9500000000', //manque référence
        );
        $this->assertFalse($this->bibmng->mappingBibtex($tab));
    }
    
     public function testMappingBibtexManqueCategorie() {
        $tab = array(
            //'entryType' => 'article', //manque catégorie
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            'cite' => 'SGH9500000000',
            'journal' => 'testjournal',
        );
        $this->assertFalse($this->bibmng->mappingBibtex($tab));
    }
    
    public function testMappingBibtex() {
        $tab = array(
            'entryType' => 'article',
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            'cite' => 'SGH9500000000',
            'journal' => 'testjournal',
        );
        $this->assertInstanceOf('Application\Model\Publication', $this->bibmng->mappingBibtex($tab));
    }
    
    /**
     * Fonctions de test sur les publications où il manque un champ obligatoire selon le type de la catégorie
     * 1 = articl = journal
     * 2 et 6 = inproceedings et inbook = booktitle
     * 3 et 4 = techreport et phdthesis = type et institution
     * 5 = misc = editor
     */
    
    public function testMappingBibtexCategorie1Manque() {
        $tab = array(
            'entryType' => 'article',
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            'cite' => 'SGH9500000000',
            //'journal' => 'journaltest', //manque champ obligatoire pour cette catégorie
        );
        $this->assertEquals($tab['cite'], $this->bibmng->mappingBibtex($tab));
    }
    
    public function testMappingBibtexCategorie2Manque() {
        $tab = array(
            'entryType' => 'inproceedings',
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            'cite' => 'SGH9500000000',
            //'booktitle' => 'booktitletest', //manque champ obligatoire pour cette catégorie
        );
        $this->assertEquals($tab['cite'], $this->bibmng->mappingBibtex($tab));
    }
    
    public function testMappingBibtexCategorie3Manque() {
        $tab = array(
            'entryType' => 'techreport',
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            'cite' => 'SGH9500000000',
            //'type' => 'typetest', //manque champ obligatoire pour cette catégorie
            //'institution' => 'institutiontest', //manque champ obligatoire pour cette catégorie
        );
        $this->assertEquals($tab['cite'], $this->bibmng->mappingBibtex($tab));
    }
    
    public function testMappingBibtexCategorie4Manque() {
        $tab = array(
            'entryType' => 'phdthesis',
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            'cite' => 'SGH9500000000',
            //'type' => 'typetest', //manque champ obligatoire pour cette catégorie
            //'institution' => 'institutiontest', //manque champ obligatoire pour cette catégorie
        );
        $this->assertEquals($tab['cite'], $this->bibmng->mappingBibtex($tab));
    }
    
    public function testMappingBibtexCategorie5Manque() {
        $tab = array(
            'entryType' => 'misc',
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            'cite' => 'SGH9500000000',
            //'editor' => 'editortest',
        );
        $this->assertEquals($tab['cite'], $this->bibmng->mappingBibtex($tab));
    }
    
    public function testMappingBibtexCategorie6Manque() {
        $tab = array(
            'entryType' => 'inbook',
            'title' => '{Temporal Logic in Stochastic Environment}',
            'author' => '{B. Strulo and D. Gabbay and P.G. Harrison}',
            'cite' => 'SGH9500000000',
            //'booktitle' => 'booktitletest' //manque champ obligatoire pour cette catégorie
        );
        $this->assertEquals($tab['cite'], $this->bibmng->mappingBibtex($tab));
    }

}