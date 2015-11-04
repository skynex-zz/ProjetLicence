 <?php
 class Rubrique
 {
     public $id;
     public $date_creation;
     public $date_modification;
     public $content_fr;
     public $content_en;
     public $menu_id;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->date_creation = (!empty($data['date_creation'])) ? $data['date_creation'] : null;
         $this->date_modification  = (!empty($data['date_modification'])) ? $data['date_modification'] : null;
		 $this->content_fr  = (!empty($data['content_fr'])) ? $data['content_fr'] : null;
		 $this->content_en  = (!empty($data['content_en'])) ? $data['content_en'] : null;
		 $this->menu_id  = (!empty($data['menu_id'])) ? $data['menu_id'] : null;
     }
 }
 
 ?>