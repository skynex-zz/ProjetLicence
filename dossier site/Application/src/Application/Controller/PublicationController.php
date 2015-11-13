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
use Application\Model\Publication;        
use Application\Model\PublicationModel;
use Application\Model\Rubrique;        
use Application\Model\RubriqueModel;
use Application\Model\Categorie;        
use Application\Model\CategorieModel;

class PublicationController extends AbstractActionController
{

    public function afficherPublicationAction() 
    {   
		$rubriqueModel = new RubriqueModel();
        $dataRubrique = $rubriqueModel->fetchAll();
		$this->layout()->setVariable('listeRubrique',$dataRubrique);
		
		$this->layout()->setVariable('langue',$this->getEvent()->getRouteMatch()->getParam('langue'));
		$this->layout()->setVariable('menu_id','pbl');
		
		$publicationModel = new PublicationModel();
        $dataPubli = $publicationModel->fetchAll();		
		
		$categorieModel = new CategorieModel();
		$dataCateg = $categorieModel->fetchAll();
		
		return new ViewModel(array('listeCateg'=>$dataCateg,'listePubli'=> $dataPubli,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));
		
    }
}
