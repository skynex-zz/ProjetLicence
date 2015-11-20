 <?php
 class Categorie
 {
     public $id;
     public $name_fr;
     public $name_en;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->name_fr = (!empty($data['name_fr'])) ? $data['name_fr'] : null;
         $this->name_en  = (!empty($data['name_en'])) ? $data['name_en'] : null;
     }
 }
 
 
 ?>