<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;      
use Application\Model\RubriqueModel;
use Application\Model\LayoutExceptions;
use Application\Model\VerifUser;
use Application\Model\SendLayout;

class RubriqueController extends AbstractActionController
{
    
    public function rubriqueselectAction() 
    {    
        //Vérification token
        $token = VerifUser::tokenAction();
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        
        $rubriqueModel = new RubriqueModel();
        $data = null;
        $rubrique = null;
        //try catch du fetchAll des rubriques
        $listeRubriques = SendLayout::fetchAllRubriques($this, 0, $langue, $token);
        
        try {
            $rubrique = $rubriqueModel->findOne($this->getEvent()->getRouteMatch()->getParam('menu_id'));
        } catch (\Exception $e) {
            SendLayout::traiteExceptionsOneRubrique($this, $data, $this->getEvent()->getRouteMatch()->getParam('menu_id'), 
                        $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());
            return new ViewModel(array('rubrique'=>null,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue'),
                        $this->getEvent()->getRouteMatch()->getParam('langue'), 'exception' => $e->getMessage()));
        }
        
        SendLayout::sendGeneral($this, $listeRubriques, $rubrique['menu_id'], $langue, $token);
	return new ViewModel(array('rubrique'=>$rubrique,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));
		
    }
    
	
	
	
}
