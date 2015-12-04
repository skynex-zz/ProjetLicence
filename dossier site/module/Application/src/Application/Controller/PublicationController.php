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
use Application\Model\PublicationModel;      
use Application\Model\RubriqueModel;
use Application\Model\CategorieModel;
use Application\Model\VerifUser;
use Application\Model\SendLayout;

class PublicationController extends AbstractActionController
{

    public function afficherPublicationAction() 
    {   
        //Vérification token
        $token = VerifUser::tokenAction();
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        
	$rubriqueModel = new RubriqueModel();
	$categorieModel = new CategorieModel();
        $publicationModel = new PublicationModel();
		
	//try catch du fetchAll des rubriques
        $listeRubriques = SendLayout::fetchAllRubriques($this, 'pbm', $langue, $token);
        
	if($this->getEvent()->getRouteMatch()->getParam('trie')=='categ'){
            $listeSup = $categorieModel->fetchAll();
	}
	elseif($this->getEvent()->getRouteMatch()->getParam('trie')=='date'){
            $listeSup = $publicationModel->fetchAllByDate();
	}
	
        SendLayout::sendGeneral($this, $listeRubriques, 'pbm', $langue, $token);
	return new ViewModel(array('trie'=>$this->getEvent()->getRouteMatch()->getParam('trie'),'listePubli'=> $publicationModel->fetchAll(),'listeSup' => $listeSup, 'langue'=>$langue));
		
    }
}
