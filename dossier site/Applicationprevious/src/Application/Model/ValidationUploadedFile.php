<?php

namespace Application\Model;

use Zend\Validator\File\Extension;
use Zend\File\Transfer\Adapter\Http;

class ValidationUploadedFile {
    
    public function validatorsFile() {
        $validator = new Extension(array('pdf'));
        return $validator;
    }
    
    public function moveFile($file) {
        $adapter = new Http();
        $validator = $this->validatorsFile();
        if($validator->isValid($file)) { 
            $adapter->setDestination(dirname(__DIR__).'./../../../../public/useruploads/files');
            if($adapter->receive($file['name'])) {
                return true;
            }
        }
        return false;
     } 
    
}