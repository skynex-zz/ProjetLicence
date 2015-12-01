<?php 

namespace Application\Form;

use Zend\Form\Form;

class BibtexPublicationForm extends Form
{
     public function __construct($name = null)
     {
        parent::__construct('bibtex');
         
        $this->setAttribute('id', 'form_modif');
          
        $this->add(array(
            'name' => 'bibtex',
            'type' => 'File',
            'required' => true,
            'attributes' => array(
                'id' => 'upload',
             ),
            'options' => array(
                'label' => 'Importer fichier Bibtex',
            )
        ));
        $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Valider',
                 'id' => 'submitBibtex',
             ),
         ));
     }
 }