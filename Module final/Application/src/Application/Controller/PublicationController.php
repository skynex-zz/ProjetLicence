<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\VerifUser;
use Application\Model\Publication;        
use Application\Model\PublicationModel;
use Application\Model\Rubrique;        
use Application\Model\RubriqueModel;
use Application\Model\Categorie;
use Application\Model\CategorieModel;
use Application\Model\SendLayout;

class PublicationController extends AbstractActionController
{

    public function afficherPublicationAction() 
    {   
		// verification de connexion
		$token = VerifUser::tokenAction();
        // verification des rubriques 
        $rubriqueModel = new RubriqueModel();
        $data = null;
        $rubrique = null;
        try {
            $data = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            SendLayout::traiteExceptionsAllRubriques($this, $data, 'pbm', $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());
        }
		//verification des publications
	$publicationModel = new PublicationModel();
        $dataP = null;
        $publication = null;
        try {
            $dataP = $publicationModel->fetchAll();
			$dataP = $publicationModel->fetchAllByDate();
        }
        catch(\Exception $e) {
            $exceptionP = $e;
        }
		// verification des categories
		$categorieModel = new CategorieModel();
        $dataC = null;
        $categorie = null;
        try {
            $dataC = $categorieModel->fetchAll();
        }
        catch(\Exception $e) {
            $exceptionC = $e;
        }
		
		$this->layout()->setVariable('listeRubrique',$data);
		$this->layout()->setVariable('langue',$this->getEvent()->getRouteMatch()->getParam('langue'));
		$this->layout()->setVariable('menu_id','pbm');
		$this->layout()->setVariable('token', $token);
		
		if($this->getEvent()->getRouteMatch()->getParam('trie')=='categ'){
			$listeSup=$dataC;
		}
		elseif($this->getEvent()->getRouteMatch()->getParam('trie')=='date'){
			$listeSup=$dataP;
		}
                if(isset($listeSup)){
                    if((isset($exceptionP))&&(isset($exceptionC))){
			return new ViewModel(array('trie'=>$this->getEvent()->getRouteMatch()->getParam('trie'),'excC'=>$exceptionC,'excP'=>$exceptionP,'listePubli'=> $dataP,'listeSup' => $listeSup, 'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));	
                    }
                    elseif(isset($exceptionC)){
			return new ViewModel(array('trie'=>$this->getEvent()->getRouteMatch()->getParam('trie'),'excC'=>$exceptionC,'listePubli'=> $dataP,'listeSup' => $listeSup, 'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));
                    }
                    elseif(isset($exceptionP)){			 
                        return new ViewModel(array('trie'=>$this->getEvent()->getRouteMatch()->getParam('trie'),'excP'=>$exceptionP,'listePubli'=> $dataP,'listeSup' => $listeSup, 'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));	
                    }
                    else {   			 
                        return new ViewModel(array('trie'=>$this->getEvent()->getRouteMatch()->getParam('trie'),'listePubli'=> $dataP,'listeSup' => $listeSup, 'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));	
                    }
                    
                }        
                else {    
                    return new ViewModel(array('trie'=>$this->getEvent()->getRouteMatch()->getParam('trie'),'listePubli'=> $dataP, 'msgError' => 'error', 'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));	
                }
    
    }
}
