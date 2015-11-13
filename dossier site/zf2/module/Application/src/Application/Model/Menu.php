<?php
 
namespace Application\Model;
 
 class Menu
 {
     public $id;
     public $titre_fr;
     public $titre_en;
     public $actif;
     public $position;

     public function __construct($id, $titre_fr, $titre_en, $actif, $position)
     {
         $this->id        = isset($id) ? $id : null;
         $this->titre_fr  = isset($titre_fr) ? $titre_fr : "Titre par défaut";
         $this->titre_en  = isset($titre_en) ? $titre_en : "Default title";
         $this->actif     = isset($actif) ? $actif : 1;
         $this->position  = isset($position) ? $position : 1;
     }   
 
 }
 
 ?>