<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;    
use Application\Model\RubriqueModel;
use Application\Model\SendLayout;
use Application\Model\VerifUser;

class IndexController extends AbstractActionController
{
    
    public function indexAction()
    {
        VerifUser::setTokenToDisconnect();
        
	$rubriqueModel = new RubriqueModel();
        $data = null; $cptActif = 0;
        
        $data = SendLayout::fetchAllRubriques($this, 'autre', 'fr', null);
        
	$this->layout()->setVariable('listeRubrique', $data);
	$this->layout()->setVariable('langue', 'fr');
        $this->layout()->setVariable('token', null);
	if(!empty($data)) {
            foreach($data as $d) {
                if($d['actif'] == 1) {
                    $cptActif++;
                    $this->layout()->setVariable('menu_id', $d['menu_id']);
                    return new ViewModel(array('rubrique'=>$d, 'langue'=>'fr'));
                }
            }
        }
        if(empty($data) || $cptActif == 0){
            $this->layout()->setVariable('menu_id', 'pbm');
            $this->redirect()->toRoute('publications', array('langue' => 'fr'));
        }
    }
	
}
