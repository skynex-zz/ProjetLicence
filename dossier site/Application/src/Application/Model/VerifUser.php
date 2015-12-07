<?php

namespace Application\Model;

use Zend\Session\Container;

class VerifUser {
    
    public static function tokenAction() {
        $session = new Container('user');
        if(isset($session->token)) {
            return $session->token;
        }
        return null;
    }
    
    public static function setTokenToDisconnect() {
        $session = new Container('user');
        $session->token = null;
    }
    
}