 <?php
 class Publication
 {
     public $id;
     public $reference;
     public $auteurs;
	 public $titre;
	 public $date;
	 public $journal;
	 public $volume;
	 public $number;
	 public $pages;
	 public $note;
	 public $abstract;
	 public $keywords;
	 public $series;
	 public $localite;
	 public $publisher;
	 public $editor;
	 public $pdf;
	 public $date_display;
	 public $categorie_id;

     public function exchangeArray($data)
     {
         $this->id = (!empty($data['id'])) ? $data['id'] : null;
         $this->reference = (!empty($data['reference'])) ? $data['reference'] : null;
         $this->auteurs  = (!empty($data['auteurs'])) ? $data['auteurs'] : null;
		 $this->titre = (!empty($data['titre'])) ? $data['titre'] : null;
         $this->date  = (!empty($data['date'])) ? $data['date'] : null;
		 $this->volume = (!empty($data['volume'])) ? $data['volume'] : null;
         $this->number  = (!empty($data['number'])) ? $data['number'] : null;
		 $this->pages = (!empty($data['pages'])) ? $data['pages'] : null;
         $this->note  = (!empty($data['note'])) ? $data['note'] : null;
		 $this->abstract = (!empty($data['abstract'])) ? $data['abstract'] : null;
         $this->keywords  = (!empty($data['keywords'])) ? $data['keywords'] : null;
		 $this->series = (!empty($data['series'])) ? $data['series'] : null;
         $this->localite  = (!empty($data['localite'])) ? $data['localite'] : null;
		 $this->publisher = (!empty($data['publisher'])) ? $data['publisher'] : null;
         $this->editor  = (!empty($data['editor'])) ? $data['editor'] : null;
		 $this->pdf = (!empty($data['pdf'])) ? $data['pdf'] : null;
         $this->date_display  = (!empty($data['date_display'])) ? $data['date_display'] : null;
		 $this->categorie_id  = (!empty($data['categorie_id'])) ? $data['categorie_id'] : null;
	 }
 }
 
 
 ?>