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

class PublicationController extends AbstractActionController
{

    public function afficherPublicationAction() 
    {   
		$rubriqueModel = new RubriqueModel();
        $data = $rubriqueModel->fetchAll();
		$this->layout()->setVariable('listeRubrique',$data);
		$this->layout()->setVariable('langue',$this->getEvent()->getRouteMatch()->getParam('langue'));
		$this->layout()->setVariable('menu_id',0);
		$publicationModel = new PublicationModel();
        $dataPubli = $publicationModel->fetchAll();		
		return new ViewModel(array('listePubli'=> $dataPubli,'langue'=>$this->getEvent()->getRouteMatch()->getParam('langue')));
		
    }
}
