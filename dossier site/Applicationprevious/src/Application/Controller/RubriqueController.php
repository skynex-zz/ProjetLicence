<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Rubrique;       
use Application\Model\RubriqueModel;
use Application\Model\LayoutExceptions;
use Zend\Session\Container;

class RubriqueController extends AbstractActionController
{
    public function rubriqueselectAction() 
    {    
        $token = null;
        $session = new Container('user');
        if(isset($session->token)) {
            $token = $session->token;
        }
        
        $rubriqueModel = new RubriqueModel();
        $data = null;
        $rubrique = null;
        try {
            $data = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $data, 0, $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());
        }
        
        try {
            $rubrique = $rubriqueModel->findOne($this->getEvent()->getRouteMatch()->getParam('menu_id'));
        } catch (\Exception $e) {
            LayoutExceptions::traiteExceptionsOneRubrique($this, $data, $this->getEvent()->getRouteMatch()->getParam('menu_id'), 
                        $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());
            return new ViewModel(array('rubrique'=>null,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue'),
                        $this->getEvent()->getRouteMatch()->getParam('langue'), 'exception' => $e->getMessage()));
        }

	$this->layout()->setVariable('listeRubrique', $data);
	$this->layout()->setVariable('menu_id', $rubrique['menu_id']);
	$this->layout()->setVariable('langue', $this->getEvent()->getRouteMatch()->getParam('langue'));
        $this->layout()->setVariable('token', $token);
	return new ViewModel(array('rubrique'=>$rubrique,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));
		
    }
    
	
	
	
}
