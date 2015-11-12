 <?php
 class User
 {
     public $id;
     public $login;
     public $password;
	 public $rank;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->login = (!empty($data['login'])) ? $data['login'] : null;
         $this->password  = (!empty($data['password'])) ? $data['password'] : null;
		 $this->rank  = (!empty($data['rank'])) ? $data['rank'] : null;
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