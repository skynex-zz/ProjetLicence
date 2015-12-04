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
                 'allow_empty' => false,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                     array('name' => 'StripNewlines'),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'titre_en',
                 'required' => true,
                 'allow_empty' => false,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                     array('name' => 'StripNewlines'),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'position',
                 'required' => false,
                 'validators'  => array(
                     array(
                        'name' => 'Zend\Validator\GreaterThan',
                        'options' => array(
                            'min' => 0,
                            'inclusive' => false,
                        ),
                    ),
                )
             ));
             $inputFilter->add(array(
                 'name'     => 'actifradio',
             ));
             $inputFilter->add(array(
                 'name'     => 'content_fr',
                 'required' => false,
             ));
             $inputFilter->add(array(
                 'name'     => 'content_en',
                 'required' => false,
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
}