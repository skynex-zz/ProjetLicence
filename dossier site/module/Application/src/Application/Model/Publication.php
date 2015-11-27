<?php
namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
 
 class Publication implements InputFilterAwareInterface
 {
    public $id;
    public $reference;
    public $auteurs;
    public $titre;
    public $date;
    public $journal;
    public $volume;
    public $number;
    public $pages;
    public $note;
    public $abstract;
    public $keywords;
    public $series;
    public $localite;
    public $publisher;
    public $editor;
    public $pdf;
    public $date_display;
    public $categorie_id;
    //nouveaux
    public $doi;
    public $url;
    public $institution;
    public $howpublished;
    public $urldate;
    public $isbn;
    public $chapter;
    public $booktitle;
    public $type;
    protected $inputFilter;

     public function exchangeArray($data)
     {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->reference = (!empty($data['reference'])) ? $data['reference'] : null;
        $this->auteurs  = (!empty($data['auteurs'])) ? $data['auteurs'] : null;
	$this->titre = (!empty($data['titre'])) ? $data['titre'] : null;
        $this->date  = (!empty($data['date'])) ? $data['date'] : null;
        $this->journal = (!empty($data['journal'])) ? $data['journal'] : null;
	$this->volume = (!empty($data['volume'])) ? $data['volume'] : null;
        $this->number  = (!empty($data['number'])) ? $data['number'] : null;
	$this->pages = (!empty($data['pages'])) ? $data['pages'] : null;
        $this->note  = (!empty($data['note'])) ? $data['note'] : null;
	$this->abstract = (!empty($data['abstract'])) ? $data['abstract'] : null;
        $this->keywords  = (!empty($data['keywords'])) ? $data['keywords'] : null;
	$this->series = (!empty($data['series'])) ? $data['series'] : null;
        $this->localite  = (!empty($data['localite'])) ? $data['localite'] : null;
	$this->publisher = (!empty($data['publisher'])) ? $data['publisher'] : null;
        $this->editor  = (!empty($data['editor'])) ? $data['editor'] : null;
	$this->pdf = (!empty($data['pdf'])) ? $data['pdf'] : null;
        $this->date_display  = (!empty($data['date_display'])) ? $data['date_display'] : null;
	$this->categorie_id  = (!empty($data['categorie_id'])) ? $data['categorie_id'] : null;
        $this->doi = (!empty($data['doi'])) ? $data['doi'] : null;
        $this->url  = (!empty($data['url'])) ? $data['url'] : null;
	$this->institution = (!empty($data['institution'])) ? $data['institution'] : null;
        $this->howpublished  = (!empty($data['howpublished'])) ? $data['howpublished'] : null;
	$this->urldate = (!empty($data['urldate'])) ? $data['urldate'] : null;
        $this->isbn  = (!empty($data['isbn'])) ? $data['isbn'] : null;
	$this->chapter  = (!empty($data['chapter'])) ? $data['chapter'] : null;
        $this->booktitle  = (!empty($data['booktitle'])) ? $data['booktitle'] : null;
        $this->type  = (!empty($data['type'])) ? $data['type'] : null;
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();
             
             $inputFilter->add(array(
                 'name'     => 'titre',
                 'required' => true,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Le titre ne peut pas etre vide' 
                            ),
                        ),
                     ),
                ),
                 /*'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),*/
             ));
             $inputFilter->add(array(
                 'name'     => 'reference',
                 'required' => true,
             ));
             $inputFilter->add(array(
                 'name'     => 'auteurs',
                 'required' => true,
             ));
             $inputFilter->add(array(
                 'name'     => 'date',
                 'required' => true,
             ));
             $inputFilter->add(array(
                 'name'     => 'journal',
                 'required' => false,
                 /*'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),*/
             ));
             $inputFilter->add(array(
                 'name'     => 'abstract',
                 'required' => false,
             ));
             $inputFilter->add(array(
                 'name'     => 'volume',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'number',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'pages',
                 'required' => false,
            ));
            $inputFilter->add(array(
                 'name'     => 'note',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'keywords',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'series',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'localite',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'publisher',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'editor',
                 'required' => false,
             ));
            //$validatorExt = new \Zend\Validator\File\Extension('pdf');
            $inputFilter->add(array(
                 'name'     => 'pdf',
                 'required' => false,
                 /*'validators' => array(
                    array(
                      'name' =>'Extension', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\File\Extension::FALSE_EXTENSION => 'L\'extension du fichier doit être .pdf',                                                             
                            ),
                            'extension' => 'pdf',
                        ),
                     ),
                ),*/
             ));
            $inputFilter->add(array(
                 'name'     => 'date_display',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'categorie_id',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'doi',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'url',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'institution',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'howpublished',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'urldate',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'isbn',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'chapter',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'booktitle',
                 'required' => false,
             ));
            $inputFilter->add(array(
                 'name'     => 'type',
                 'required' => false,
             ));
            
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
    
 }
 
 
 ?>