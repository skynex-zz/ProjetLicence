<?php
namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
 
 class Rubrique implements InputFilterAwareInterface
 {
    public $id;
    public $date_creation;
    public $date_modification;
    public $content_fr;
    public $content_en;
    public $menu_id;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        //$this->id     = (!empty($data['id'])) ? $data['id'] : null;
        //$this->date_creation = (!empty($data['date_creation'])) ? $data['date_creation'] : null;
        //$this->date_modification  = (!empty($data['date_modification'])) ? $data['date_modification'] : null;
	$this->content_fr  = (!empty($data['content_fr'])) ? $data['content_fr'] : null;
	$this->content_en  = (!empty($data['content_en'])) ? $data['content_en'] : null;
	//$this->menu_id  = (!empty($data['menu_id'])) ? $data['menu_id'] : null;
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
                 'name'     => 'titre_fr',
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
                 'name'     => 'titre_en',
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
             ));
             $inputFilter->add(array(
                 'name'     => 'position',
                 'required' => true,
             ));
             $inputFilter->add(array(
                 'name'     => 'actifradio',
                 'required' => true,
             ));
             $inputFilter->add(array(
                 'name'     => 'content_fr',
                 'required' => true,
                 /*'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),*/
             ));
             $inputFilter->add(array(
                 'name'     => 'content_en',
                 'required' => true,
                 /*'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),*/
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
}