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

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
		$rubriqueModel = new RubriqueModel();
        $data = $rubriqueModel->fetchAll();
		$this->layout()->setVariable('listeRubrique',$data);
		$this->layout()->setVariable('langue','fr');
		$this->layout()->setVariable('menu_id',$data[0]['menu_id']);
		$this->layout()->setVariable('rubrique',$data[0]);
        return new ViewModel(array('rubrique'=>$data[0],'langue'=>'fr'));
    }
	
}
