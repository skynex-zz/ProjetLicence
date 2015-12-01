<?php

namespace Application\Model;

use Zend\Validator\File\Extension;
use Zend\File\Transfer\Adapter\Http;

class ValidationUploadedFile {
    
    public function validatorsFile($file, $ext) {
        $validator = new Extension(array($ext));
        //$validator->setMessage('L\'extension du fichier doit être bib.', Extension::FALSE_EXTENSION);
        if($validator->isValid($file)) {
            return $validator;
        }
        return false;
    }
    
    public function moveFile($file) {
        $adapter = new Http();
        $adapter->setDestination(dirname(__DIR__).'./../../../../public/useruploads/files');
        $adapter->receive($file['name']);
    } 
    
}