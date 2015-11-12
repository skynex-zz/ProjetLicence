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
		$langue = 'fr';
		$rubriqueModel = new RubriqueModel();
        $data = $rubriqueModel->fetchAll();
		$this->layout()->setVariable('langue','fr');
		$this->layout()->setVariable('listeRubrique',$data);
		
		
		$rubrique = $rubriqueModel->findOne($this->getEvent()->getRouteMatch()->getParam('id_menu'));
		$this->layout()->setVariable('rubrique',$data[0]);
        return new ViewModel(array('rubrique'=>$data[0],'langue'=>$langue));
    }
}
