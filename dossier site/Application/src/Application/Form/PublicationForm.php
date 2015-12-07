<?php 
namespace Application\Form;

use Zend\Form\Form;

class PublicationForm extends Form
{
     public function __construct($name = null)
     {
        parent::__construct('publication');
         
        $this->setAttribute('id', 'publication_form');
          
        $this->add(array(
             'name' => 'titre',
             'type' => 'Text',
             'attributes' => array(
                'id' => 'titre',
                'size' => 70,
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
                'size' => 70,
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
                'size' => 70,
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
                'size' => 70,
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
                'cols' => 50,
                'rows' => 3,
             ),
             'options' => array(
                 'label' => 'Résumé',
             ),
         ));
         $this->add(array(
            'name' => 'date',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'datepicker1',
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
                'size' => 70,
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
                'size' => 70,
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
                'size' => 70,
             ),
            'options' => array(
                'label' => 'Nombre de pages',
            )
        ));
        $this->add(array(
            'name' => 'note',
            'type' => 'Zend\Form\Element\Textarea',
             'attributes' => array(
                'id' => 'note',
                'cols' => 50,
                'rows' => 3,
             ),
            'options' => array(
                'label' => 'Note',
            )
        ));
        $this->add(array(
            'name' => 'keywords',
            'type' => 'Zend\Form\Element\Textarea',
             'attributes' => array(
                'id' => 'keywords',
                'cols' => 40,
                'rows' => 2,
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
                'size' => 70,
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
                'size' => 70,
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
                'size' => 70,
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
                'size' => 70,
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
                'size' => 70,
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
            'name' => 'doi',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'doi',
                'size' => 70,
             ),
            'options' => array(
                'label' => 'DOI',
            )
        ));
        $this->add(array(
            'name' => 'url',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'url',
                'size' => 70,
             ),
            'options' => array(
                'label' => 'URL',
            )
        ));
        $this->add(array(
            'name' => 'institution',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'institution',
                'size' => 70,
             ),
            'options' => array(
                'label' => 'Institution',
            )
        ));
        $this->add(array(
            'name' => 'howpublished',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'howpublished',
                'size' => 70,
             ),
            'options' => array(
                'label' => 'How published',
            )
        ));
        $this->add(array(
            'name' => 'urldate',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'datepicker2',
             ),
            'options' => array(
                'label' => 'Date URL',
            )
        ));
        $this->add(array(
            'name' => 'isbn',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'isbn',
                'size' => 70,
             ),
            'options' => array(
                'label' => 'ISBN',
            )
        ));
        $this->add(array(
            'name' => 'chapter',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'chapter',
                'size' => 70,
             ),
            'options' => array(
                'label' => 'Chapitre',
            )
        ));
        $this->add(array(
            'name' => 'booktitle',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'booktitle',
                'size' => 70,
             ),
            'options' => array(
                'label' => 'Titre du livre',
            )
        ));
        $this->add(array(
            'name' => 'type',
            'type' => 'Text',
             'attributes' => array(
                'id' => 'type',
                'size' => 70,
             ),
            'options' => array(
                'label' => 'Type',
            )
        ));
        $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Valider',
                 'id' => 'submitPublication',
             ),
         ));
     }
 }