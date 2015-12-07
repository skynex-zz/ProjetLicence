<?php
 
namespace Application\Model;
 
 class Filter
 {
     
	public function filterEncode($varold){
		$var = filter_var($varold, FILTER_SANITIZE_ENCODED , $options);
		return $var;
	}  
	public function filterFloat($varold){
		$var = filter_var($varold, FILTER_SANITIZE_NUMBER_FLOAT, $options);
		return $var;
	}
	public function filterInt($varold){
            $options = array(
                'options' => array(
                    'min_range' => 1,
                ),
            );
            $var = filter_var($varold, FILTER_VALIDATE_INT, $options);
            return $var;
	}
	public function filterSpecChar($varold){
		$var = filter_var($varold, FILTER_SANITIZE_SPECIAL_CHARS, $options);
	}
	/*public function filterFullSpecChar($varold){
		$var = filter_var($varold, FILTER_SANITIZE_FULL_SPECIAL_CHARS, $options);
		return $var;
	}*/
	public function nettoyageStringDefault($varold){
		$var = filter_var($varold, FILTER_SANITIZE_STRING);
                if($var != false) {
                    return $var;
                }
		return false;
	}
        
        public function nettoyageStringHigh($varold){
		$var = filter_var($varold, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); //supprime caractères avec code ASCII>127
                if($var != false) {
                    return $var;
                }
		return false;
	}
	/*public function filterFullSpecChar($varold){
		$var = filter_var($varold, FILTER_SANITIZE_STRIPPED, $options);
		return $var;
	}*/
	public function filterFullSpecChar($varold){
		$var = filter_var($varold, FILTER_UNSAFE_RAW, $options);
		return $var;
	}
        
        public function filterCreateRubrique($titreFr, $titreEn, $position) {
            $titreFr = $this->nettoyageStringDefault($titreFr);
            $titreEn = $this->nettoyageStringDefault($titreEn);
            $position = $this->filterInt($position);
            if($titreFr != false && $titreEn != false && $position != false) {
                return array($titreFr, $titreEn, $position);
            }
            else {
                return false;
            }
        }
 }
 
 ?>