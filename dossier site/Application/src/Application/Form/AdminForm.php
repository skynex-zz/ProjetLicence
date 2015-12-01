<?php 

namespace Application\Form;

 use Zend\Form\Form;

 class AdminForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('admin');

         $this->add(array(
             'name' => 'login',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Identifiant',
             ),
         ));
         $this->add(array(
             'name' => 'password',
             'type' => 'Password',
             'options' => array(
                 'label' => 'Mot de passe',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Valider',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
 
 ?>