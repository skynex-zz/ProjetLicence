 <?php
 class Rubrique
 {
     public $id;
     public $titre_fr;
     public $titre_en;
     public $actif;
     public $position;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->titre_fr  = (!empty($data['titre_fr'])) ? $data['titre_fr'] : null;
         $this->titre_en  = (!empty($data['titre_en'])) ? $data['titre_en'] : null;
         $this->actif = (!empty($data['actif'])) ? $data['actif'] : null;
         $this->position  = (!empty($data['position'])) ? $data['position'] : null;
     }   
 
 }
 
 ?>