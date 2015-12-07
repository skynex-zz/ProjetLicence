<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;    
use Application\Model\RubriqueModel;
use Application\Model\LayoutExceptions;
use Application\Model\VerifUser;

class IndexController extends AbstractActionController
{
    
    public function indexAction()
    {
        VerifUser::setTokenToDisconnect();
        
		$rubriqueModel = new RubriqueModel();
        $data = null;
        try {
            $data = $rubriqueModel->fetchAll();
        } catch (Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $data, 'pbm', 'fr', $e->getMessage());
            return new ViewModel(array('rubrique' => null, 'langue' => 'fr', 'exception' => $e->getMessage()));
        }
	
		//envoie des variables a la vue
		$this->layout()->setVariable('listeRubrique',$data);
		$this->layout()->setVariable('langue','fr');
		$this->layout()->setVariable('menu_id',$data[0]['menu_id']);
		
		//gestion d'erreur avec ErreurHandler -> voir module.php
		if(!empty($this->getRequest()->getQuery('erreur',false))){
			return new ViewModel(array('langue'=>'fr','erreur' =>$this->getRequest()->getQuery('erreur',false)));
		}
		else{
		// affichage de la vue
		return new ViewModel(array('rubrique'=>$data[0],'langue'=>'fr'));
		}
	}
}
