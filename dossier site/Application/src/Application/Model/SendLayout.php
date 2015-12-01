<?php

namespace Application\Model;

use Application\Model\RubriqueModel;

class SendLayout {
    
    public static function sendGeneral($controller, $liste, $idMenu, $langue, $token) {
        $controller->layout()->setVariable('listeRubrique', $liste);
        $controller->layout()->setVariable('menu_id', $idMenu);
        $controller->layout()->setVariable('langue', $langue);
        $controller->layout()->setVariable('token', $token);
    }
    
    public static function traiteExceptionsAllRubriques($controller, $liste, $idMenu, $langue, $token, $exception = null) {
        SendLayout::sendGeneral($controller, $liste, $idMenu, $langue, $token);
        $controller->layout()->setVariable('exceptionAllR', $exception);
    }
    
    public static function traiteExceptionsOneRubrique($controller, $liste, $idMenu, $idRubrique, $langue, $token, $exception = null) {
        SendLayout::sendGeneral($controller, $liste, $idMenu, $langue, $token);
        $controller->layout()->setVariable('id_menu', $idRubrique);
        $controller->layout()->setVariable('exceptionOneR', $exception);
    }
    
    public static function fetchAllRubriques($controller, $idMenu, $langue, $token) {
        $listeRubrique = null;
        $rubriqueModel = new RubriqueModel();
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            SendLayout::traiteExceptionsAllRubriques($controller, $listeRubrique, $idMenu, $langue, $token, $e);
        }
        return $listeRubrique;
    }
    
     public static function findOneRubrique($controller, $liste, $idMenu, $langue, $token, $idRubrique) {
        $rubriqueToModif = null;
        $rubriqueModel = new RubriqueModel();
        try {
            $rubriqueToModif = $rubriqueModel->findOne($idRubrique);
        }
        catch(\Exception $e) {
            SendLayout::traiteExceptionsOneRubrique($controller, $liste, $idMenu, $idRubrique, $langue, $token, $e);
        }
        return $rubriqueToModif;
    }
    
}