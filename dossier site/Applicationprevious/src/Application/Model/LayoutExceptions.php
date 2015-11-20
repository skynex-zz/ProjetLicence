<?php

namespace Application\Model;

class LayoutExceptions {
    
    public static function traiteGeneral($controller, $liste, $idMenu, $langue, $token) {
        $controller->layout()->setVariable('listeRubrique', $liste);
        $controller->layout()->setVariable('menu_id', $idMenu);
        $controller->layout()->setVariable('langue', $langue);
        $controller->layout()->setVariable('token', $token);
    }
    
    public static function traiteExceptionsAllRubriques($controller, $liste, $idMenu, $langue, $token, $exception = null) {
        LayoutExceptions::traiteGeneral($controller, $liste, $idMenu, $langue, $token);
        $controller->layout()->setVariable('exceptionAll', $exception);
    }
    
    public static function traiteExceptionsOneRubrique($controller, $liste, $idMenu, $langue, $token, $exception = null) {
        LayoutExceptions::traiteGeneral($controller, $liste, $idMenu, $langue, $token);
        $controller->layout()->setVariable('exceptionOne', $exception);
    }
    
}