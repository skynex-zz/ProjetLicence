<?php
namespace Application\Model;
 
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
 
class Admin implements InputFilterAwareInterface
{
    public $id;
    public $login;
    public $password;
    public $rank;
    protected $inputFilter;
     
    public function exchangeArray($data)
     {
         //$this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->login = (!empty($data['login'])) ? $data['login'] : null;
         $this->password  = (!empty($data['password'])) ? $data['password'] : null;
         //$this->rank  = (!empty($data['rank'])) ? $data['rank'] : null;
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
                 'name'     => 'login',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'password',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 /*'validators' => array(
                     array(
                         'name'    => 'StringLength', //Pour le nmbre de caractères de la valeur
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),*/
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
     
 }
 
 ?>