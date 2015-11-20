<?php 

namespace Application\Form;

use Zend\Form\Form;

class PublicationForm extends Form
{
     public function __construct($name = null)
     {
        parent::__construct('publication');
         
        $this->setAttribute('id', 'form_modif');
          
        $this->add(array(
             'name' => 'titre',
             'type' => 'Text',
             'attributes' => array(
                'id' => 'titre',
             ),
             'options' => array(
                 'label' => 'Titre',
             ),
         ));
         $this->add(array(
             'name' => 'reference',
             'type' => 'Text',
             'attributes' => array(
                'id' => 'reference',
             ),
             'options' => array(
                 'label' => 'Référence',
             ),
         ));
         $this->add(array(
             'name' => 'auteurs',
             'type' => 'Text',
             'attributes' => array(
                'id' => 'auteurs',
             ),
             'options' => array(
                 'label' => 'Auteurs',
             ),
         ));
         $this->add(array(
            'name' => 'journal',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'journal',
             ),
            'options' => array(
                'label' => 'Journal',
            )
        ));
         $this->add(array(
             'name' => 'abstract',
             'type' => 'Zend\Form\Element\Textarea',
             'attributes' => array(
                'id' => 'editor_abstract',
             ),
             'options' => array(
                 'label' => 'Résumé',
             ),
         ));
         $this->add(array(
            'name' => 'date',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'datepicker',
             ),
            'options' => array(
                'label' => 'Date',
                'format' => 'Y-m-d',
            )
        ));
        $this->add(array(
            'name' => 'volume',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'volume',
             ),
            'options' => array(
                'label' => 'Volume',
            )
        ));
        $this->add(array(
            'name' => 'number',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'number',
             ),
            'options' => array(
                'label' => 'Number',
            )
        ));
        $this->add(array(
            'name' => 'pages',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'pages',
             ),
            'options' => array(
                'label' => 'Nombre de pages',
            )
        ));
        $this->add(array(
            'name' => 'note',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'note',
             ),
            'options' => array(
                'label' => 'Note',
            )
        ));
        $this->add(array(
            'name' => 'keywords',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'keywords',
             ),
            'options' => array(
                'label' => 'Mots-clés',
            )
        ));
        $this->add(array(
            'name' => 'series',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'series',
             ),
            'options' => array(
                'label' => 'Series',
            )
        ));
        $this->add(array(
            'name' => 'localite',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'localite',
             ),
            'options' => array(
                'label' => 'Localisation',
            )
        ));
        
        $this->add(array(
            'name' => 'publisher',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'publisher',
             ),
            'options' => array(
                'label' => 'Publieur',
            )
        ));
        $this->add(array(
            'name' => 'editor',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'editor',
             ),
            'options' => array(
                'label' => 'Editeur',
            )
        ));
        
        $this->add(array(
            'name' => 'pdf',
            'type' => 'File',
             'attributes' => array(
                'id' => 'upload',
             ),
            'options' => array(
                'label' => 'Importer fichier PDF',
            )
        ));
        $this->add(array(
            'name' => 'date_display',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'date_display',
             ),
            'options' => array(
                'label' => 'Date à afficher',
            )
        ));
        
        $this->add(array(
            'name' => 'categorie_id',
            'type' => 'Select',
             'attributes' => array(
                'id' => 'categorie',
             ),
            'options' => array(
                'label' => 'Catégorie',
                'disable_inarray_validator' => true,
            )
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