<?php
 
namespace Application\Model;
 
 class Filter
 {
	 
	
	public function filterMail($varold){
        $var = filter_var($varold, FILTER_SANITIZE_EMAIL , $options);
		return $var;
	}   
	public function filterEncode($varold){
		$var = filter_var($varold, FILTER_SANITIZE_ENCODED , $options);
		return $var;
	}
	public function filterQuote($varold){
        $var = filter_var($varold, FILTER_SANITIZE_MAGIC_QUOTES, $options);
		return $var;
	}   
	public function filterFloat($varold){
		$var = filter_var($varold, FILTER_SANITIZE_NUMBER_FLOAT, $options);
		return $var;
	}
	public function filterInt($varold){
		$var = filter_var($varold, FILTER_SANITIZE_NUMBER_INT, $options);
		return $var;
	}
	public function filterSpecChar($varold){
		$var = filter_var($varold, FILTER_SANITIZE_SPECIAL_CHARS, $options);
	}
	public function filterFullSpecChar($varold){
		$var = filter_var($varold, FILTER_SANITIZE_FULL_SPECIAL_CHARS, $options);
		return $var;
	}
	public function filterString($varold){
		$var = filter_var($varold, FILTER_SANITIZE_STRING, $options);
		return $var;
	}
	public function filterFullSpecChar($varold){
		$var = filter_var($varold, FILTER_SANITIZE_STRIPPED, $options);
		return $var;
	}
	public function filterFullSpecChar($varold){
		$var = filter_var($varold, FILTER_SANITIZE_URL, $options);
		return $var;
	}
	public function filterFullSpecChar($varold){
		$var = filter_var($varold, FILTER_UNSAFE_RAW, $options);
		return $var;
	}	
 }
 
 ?>