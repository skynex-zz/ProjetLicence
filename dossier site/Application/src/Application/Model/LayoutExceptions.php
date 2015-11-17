<?php

namespace Application\Model;

class LayoutExceptions {
    
    public static function traiteExceptionsAllRubriques($controller, $liste, $idMenu, $langue, $exception = null) {
        $controller->layout()->setVariable('listeRubrique', $liste);
        $controller->layout()->setVariable('menu_id', $idMenu);
        $controller->layout()->setVariable('exceptionAll', $exception);
        $controller->layout()->setVariable('langue', $langue);
    }
    
    public static function traiteExceptionsOneRubrique($controller, $liste, $idMenu, $langue, $exception = null) {
        $controller->layout()->setVariable('listeRubrique', $liste);
        $controller->layout()->setVariable('menu_id', $idMenu);
        $controller->layout()->setVariable('exceptionOne', $exception);
        $controller->layout()->setVariable('langue', $langue);
    }
    
}