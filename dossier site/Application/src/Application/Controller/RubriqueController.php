<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Rubrique;       
use Application\Model\RubriqueModel;

class RubriqueController extends AbstractActionController
{
    protected $rubriqueTable;
	
    public function rubriqueselectAction() 
    {        
        $rubriqueModel = new RubriqueModel();
        $data = null;
        $rubrique = null;
        try {
            $data = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            $this->layout()->setVariable('listeRubrique', $data);
            $this->layout()->setVariable('menu_id', 0);
            //$this->layout()->setVariable('rubrique', null);
            $this->layout()->setVariable('exception', $e->getMessage());
            $this->layout()->setVariable('langue', $this->getEvent()->getRouteMatch()->getParam('langue'));
            return new ViewModel(array('rubrique'=>null,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));
        }
        
        try {
            $rubrique = $rubriqueModel->findOne($this->getEvent()->getRouteMatch()->getParam('menu_id'));
        } catch (\Exception $e) {
            $this->layout()->setVariable('listeRubrique',$data);
            $this->layout()->setVariable('menu_id', 0);
            $this->layout()->setVariable('rubrique', $rubrique);
            $this->layout()->setVariable('langue',$this->getEvent()->getRouteMatch()->getParam('langue'));
            return new ViewModel(array('rubrique'=>null,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue'), 'exception' => $e->getMessage()));
        }

	$this->layout()->setVariable('listeRubrique',$data);
	$rubrique = $rubriqueModel->findOne($this->getEvent()->getRouteMatch()->getParam('menu_id'));
	$this->layout()->setVariable('menu_id',$rubrique['menu_id']);
	$this->layout()->setVariable('rubrique',$rubrique);
	$this->layout()->setVariable('langue',$this->getEvent()->getRouteMatch()->getParam('langue'));
	return new ViewModel(array('rubrique'=>$rubrique,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));
		
    }
	
	
	
}
