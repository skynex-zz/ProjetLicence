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

     public function getAdmin($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Impossible de trouver".$id);
         }
         return $row;
     }
	 
	 /*public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }*/
 
 }
 
 ?>