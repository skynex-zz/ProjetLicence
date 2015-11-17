<?php

namespace Application\Model;

class LayoutExceptions {
    
    public static function traiteExceptionsAllRubriques($controller, $liste, $idMenu, $langue, $token, $exception = null) {
        $controller->layout()->setVariable('listeRubrique', $liste);
        $controller->layout()->setVariable('menu_id', $idMenu);
        $controller->layout()->setVariable('langue', $langue);
        $controller->layout()->setVariable('token', $token);
        $controller->layout()->setVariable('exceptionAll', $exception);
    }
    
    public static function traiteExceptionsOneRubrique($controller, $liste, $idMenu, $langue, $token, $exception = null) {
        $controller->layout()->setVariable('listeRubrique', $liste);
        $controller->layout()->setVariable('menu_id', $idMenu);
        $controller->layout()->setVariable('langue', $langue);
        $controller->layout()->setVariable('token', $token);
        $controller->layout()->setVariable('exceptionOne', $exception);
    }
    
}