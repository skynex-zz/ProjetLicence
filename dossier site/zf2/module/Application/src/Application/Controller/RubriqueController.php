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

class RubriqueController extends AbstractActionController
{
    protected $rubriqueTable;
	
    public function rubriqueselectAction() 
    {        
        $rubriqueModel = new RubriqueModel();
        $data = $rubriqueModel->fetchAll();
		$this->layout()->setVariable('listeRubrique',$data);
		
		$data = $rubriqueModel->findOne($this->getEvent()->getRouteMatch()->getParam('id_menu'));
		//var_dump($$this->getEvent()->getRouteMatch()->getParam('id_menu'));
		return new ViewModel(array('rubrique'=>$data));
		
    }
}
