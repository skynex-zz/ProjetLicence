<?php 

namespace Application\Form;

 use Zend\Form\Form;

 class RubriqueForm extends Form
 {
     public function __construct($name = null)
     {
         parent::__construct('rubrique');
         
        $this->setAttribute('id', 'form_modif');
          
        $this->add(array(
             'name' => 'titre_fr',
             'type' => 'Text',
             'attributes' => array(
                'id' => 'titre_fr',
             ),
             'options' => array(
                 'label' => 'Titre français',
             ),
         ));
         $this->add(array(
             'name' => 'titre_en',
             'type' => 'Text',
             'attributes' => array(
                'id' => 'titre_en',
             ),
             'options' => array(
                 'label' => 'Titre anglais',
             ),
         ));
         $this->add(array(
             'name' => 'position',
             'type' => 'Number',
             'attributes' => array(
                'id' => 'position',
             ),
             'options' => array(
                 'label' => 'Position dans le menu',
             ),
         ));
         $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'actifradio',
            'options' => array(
                'label' => 'Visible sur le site ?',
                'value_options' => array(
                    array(
                        'value' => 0,
                        'label' => 'Non',
                        'attributes' => array(
                            'id' => 'radio_no',
                        ),
                        'label_attributes' => array(
                            'id' => 'no_label',
                        ),
                    ),
                    array(
                        'value' => 1,
                        'label' => 'Oui',
                        'attributes' => array(
                            'id' => 'radio_yes',
                        ),
                        'label_attributes' => array(
                            'id' => 'yes_label',
                        ),
                    ),
                ),
            )
        ));
         $this->add(array(
             'name' => 'content_fr',
             'type' => 'Zend\Form\Element\Textarea',
             'attributes' => array(
                'id' => 'editor_fr',
             ),
             'options' => array(
                 'label' => 'Contenu français',
             ),
         ));
         $this->add(array(
             'name' => 'content_en',
             'type' => 'Zend\Form\Element\Textarea',
             'attributes' => array(
                'id' => 'editor_en',
             ),
             'options' => array(
                 'label' => 'Contenu anglais',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Valider',
                 'id' => 'submitRubrique',
             ),
         ));
     }
 }