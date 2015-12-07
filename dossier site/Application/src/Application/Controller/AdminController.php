<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container; //pour le token à envoyer dans une session pour pouvoir l'utiliser ailleurs

use Application\Model\Admin;
use Application\Model\AdminModel;
use Application\Model\RubriqueModel;
use Application\Model\PublicationModel;
use Application\Model\VerifUser;
use Application\Model\SendLayout;

use Application\Form\AdminForm; 


class AdminController extends AbstractActionController
{    
    
    private function getSuccessAndErrors() {
        $successTab = array();
        if(!empty($this->getRequest()->getQuery('successCrR', false))) $successCrRub = $this->getRequest()->getQuery('successCrR', false);
        else $successCrRub = null;
        if(!empty($this->getRequest()->getQuery('successCrP', false))) $successCrPubli = $this->getRequest()->getQuery('successCrP', false);
        else $successCrPubli = null;
        if(!empty($this->getRequest()->getQuery('successMdfR', false))) $successModifRub = $this->getRequest()->getQuery('successMdfR', false);
        else $successModifRub = null;
        if(!empty($this->getRequest()->getQuery('successMdfP', false))) $successModifPubli = $this->getRequest()->getQuery('successMdfP', false);
        else $successModifPubli = null;
        if(!empty($this->getRequest()->getQuery('successDltR', false))) $successDeleteRub = $this->getRequest()->getQuery('successDltR', false);
        else $successDeleteRub = null;
        if(!empty($this->getRequest()->getQuery('successDltP', false))) $successDeletePubli = $this->getRequest()->getQuery('successDltP', false);
        else $successDeletePubli = null;
        if(!empty($this->getRequest()->getQuery('errorDltR', false))) $errorDeleteRub = $this->getRequest()->getQuery('errorDltR', false);
        else $errorDeleteRub = null;
        if(!empty($this->getRequest()->getQuery('errorDltP', false))) $errorDeletePubli = $this->getRequest()->getQuery('errorDltP', false);
        else $errorDeletePubli = null;
        array_push($successTab, $successCrRub, $successCrPubli, $successModifRub, 
                $successModifPubli, $successDeleteRub, $successDeletePubli, $errorDeleteRub, $errorDeletePubli);
        return $successTab;
    }
    
    public function loginAction() 
    {
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $token = VerifUser::tokenAction();
        if($token != null) $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
        
        $listeRubrique = SendLayout::fetchAllRubriques($this, 'login', $langue, $token);
        
        $form = new AdminForm(); //formulaire de connexion
        $adminModel = new AdminModel();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $admin = new Admin();
            $form->setInputFilter($admin->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $admin->exchangeArray($form->getData());
                try {
                    $token = $adminModel->verifyUser($admin->login, $admin->password);
                }
                catch(\Exception $e) {
                    $token = null;
                    SendLayout::sendGeneral($this, $listeRubrique, 'login', $langue, $token);
                    return new ViewModel(array('form' => $form, 'listeRubrique' => $listeRubrique, 
                        'langue' => $this->getEvent()->getRouteMatch()->getParam('langue'), 'exception' => $e->getMessage()));
                }
                $session = new Container('user');
                $session->token = $token;
                //Redirection vers l'interface d'administration
                $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
                //echo $token;
            }
        }
        SendLayout::sendGeneral($this, $listeRubrique, 'login', $langue, $token);
        return new ViewModel(array('form' => $form, 'listeRubrique' => $listeRubrique, 'langue' => $langue));
    }
    
    public function disconnectAction() 
    {
        VerifUser::setTokenToDisconnect();
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
        $rubriqueModel = new RubriqueModel();
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            SendLayout::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
        }
        
        $this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 0);
        $this->layout()->setVariable('langue', $this->getEvent()->getRouteMatch()->getParam('langue'));
        $this->layout()->setVariable('token', $token);
        
        $this->redirect()->toRoute('home');
    }
    
    public function indexAction() 
    {   
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
        $successTab = $this->getSuccessAndErrors();
        
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $rubriqueModel = new RubriqueModel();
        $publicationModel = new PublicationModel();
        $listeRubrique = null;
        $listePublications = null;
        
        try {
            $listePublications = $publicationModel->fetchAll();
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            SendLayout::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $langue, $token, $e->getMessage());
            return new ViewModel(array('listeRubrique' => $listeRubrique, 'listePublications' => $listePublications, 
                'langue' => $langue, 'exRubriques' => $e->getMessage(), 'successTab' => $successTab));
        }
        
        SendLayout::sendGeneral($this, $listeRubrique, 'admin', $langue, $token);
        return new ViewModel(array('listeRubrique' => $listeRubrique, 'listePublications' => $listePublications, 'langue' => $langue, 'successTab' => $successTab));
    }
	
}
