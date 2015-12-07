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
use Application\Model\Rubrique;       
use Application\Model\RubriqueModel;

class LangueController extends AbstractActionController
{
	
    public function langueselectAction() 
    {        
        
		$rubriqueModel = new RubriqueModel();
        $data = $rubriqueModel->fetchAll();
		$this->layout()->setVariable('listeRubrique',$data);
		$this->layout()->setVariable('langue',$langue);
		
		$langue = $this->getEvent()->getRouteMatch()->getParam('id_menu'));
		$rubrique = $rubriqueModel->findOne($this->getEvent()->getRouteMatch()->getParam('id_menu'));
		$this->layout()->setVariable('rubrique',$rubrique);
		return new ViewModel(array('rubrique'=>$rubrique,'langue'=>$langue));
		
		
    }
}
