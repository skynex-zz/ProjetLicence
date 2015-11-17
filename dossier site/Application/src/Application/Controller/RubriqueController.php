<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Rubrique;       
use Application\Model\RubriqueModel;
use Application\Model\LayoutExceptions;

class RubriqueController extends AbstractActionController
{
    public function rubriqueselectAction() 
    {        
        $rubriqueModel = new RubriqueModel();
        $data = null;
        $rubrique = null;
        try {
            $data = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $data, 0, $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
        }
        
        try {
            $rubrique = $rubriqueModel->findOne($this->getEvent()->getRouteMatch()->getParam('menu_id'));
        } catch (\Exception $e) {
            LayoutExceptions::traiteExceptionsOneRubrique($this, $data, $this->getEvent()->getRouteMatch()->getParam('menu_id'), 
                        $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
            return new ViewModel(array('rubrique'=>null,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue'),
                        $this->getEvent()->getRouteMatch()->getParam('langue'), 'exception' => $e->getMessage()));
        }

	$this->layout()->setVariable('listeRubrique',$data);
	$this->layout()->setVariable('menu_id',$rubrique['menu_id']);
	$this->layout()->setVariable('langue',$this->getEvent()->getRouteMatch()->getParam('langue'));
	return new ViewModel(array('rubrique'=>$rubrique,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));
		
    }
    
	
	
	
}
