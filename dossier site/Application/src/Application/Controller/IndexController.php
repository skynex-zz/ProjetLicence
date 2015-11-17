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
use Application\Model\RubriqueModel;
use Application\Model\LayoutExceptions;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
	$rubriqueModel = new RubriqueModel();
        $data = null;
        try {
            $data = $rubriqueModel->fetchAll();
        } catch (Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $data, 'pbm', 'fr', $e->getMessage());
            //$this->redirect()->toRoute('publications', array('action' => 'afficherPublication', 'langue' => 'fr'));
            /*$this->layout()->setVariable('listeRubrique', $data);
            $this->layout()->setVariable('menu_id', 'pbm');
            $this->layout()->setVariable('langue', 'fr');
            $this->layout()->setVariable('exception', $e->getMessage());*/
            return new ViewModel(array('rubrique' => null, 'langue' => 'fr', 'exception' => $e->getMessage()));
        }
	$this->layout()->setVariable('listeRubrique',$data);
	$this->layout()->setVariable('langue','fr');
	$this->layout()->setVariable('menu_id',$data[0]['menu_id']);
        return new ViewModel(array('rubrique'=>$data[0],'langue'=>'fr'));
    }
	
}
