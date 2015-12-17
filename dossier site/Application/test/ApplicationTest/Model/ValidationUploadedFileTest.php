<?php

namespace ApplicationTest\Model;

use Application\Model\ValidationUploadedFile;

class ValidationUploadedFileTest extends \PHPUnit_Framework_TestCase
{
    private $vuf;
    private $goodFile;
    private $badFile;
    
    public function setUp()
    {
        $this->vuf = new ValidationUploadedFile();
        
        $this->goodFile = array();
        $this->badFile = array();
        
        $this->goodFile['name'] = 'test4toustests.bib';
        $this->goodFile['type'] = 'text/x-bibtex'; //on s'en fout de la valeur juste pour test
        $this->goodFile['tmp_name'] = 'C:\wamp\tmp\php5E22.tmp'; //idem
        $this->goodFile['error'] = 0; //idem
        $this->goodFile['size'] = 4071; //idem
        
        $this->badFile['name'] = 'test3petit.mp3';
        $this->badFile['type'] = 'text/x-bibtex'; //on s'en fout de la valeur juste pour test
        $this->badFile['tmp_name'] = 'C:\wamp\tmp\php5E22.tmp'; //idem
        $this->badFile['error'] = 0; //idem
        $this->badFile['size'] = 4071; //idem
    }
    
    public function testValidatorsGoodFile() {
        $this->assertTrue($this->vuf->validatorsFile($this->goodFile, 'bib'));
    }
    
    public function testValidatorsBadFile() {
        $this->assertFalse($this->vuf->validatorsFile($this->badFile, 'bib'));
    }
    
    /*public function testMoveFile() {
        $this->assertTrue($this->vuf->moveFile($this->goodFile));
    }*/
    
}