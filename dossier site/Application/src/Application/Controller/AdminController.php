<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;     
use Application\Model\Admin;
use Application\Form\AdminForm; 
use Application\Model\AdminModel;

//Tests avec Rubrique mais faut mettre tout ce qui concerne les rubriques dans RubriqueController je pense
use Application\Model\Rubrique;
use Application\Form\RubriqueForm; 
use Application\Model\RubriqueModel;
use Application\Model\Menu;
use Application\Model\LayoutExceptions;

class AdminController extends AbstractActionController
{    
    public function loginAction() 
    {        
        $rubriqueModel = new RubriqueModel();
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
        }
        
        //peut-être mettre dans une classe avec une méthode statique comme pour LayoutExceptions
        $this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 0);
        $this->layout()->setVariable('langue', $this->getEvent()->getRouteMatch()->getParam('langue'));
        //---------------------------------------------------------------------------------------------------
        
        $form = new AdminForm(); //formulaire de connexion
        $adminModel = new AdminModel();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $admin = new Admin();
            $form->setInputFilter($admin->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $admin->exchangeArray($form->getData());
                
                //filtrage des données récupérées
                /*$admin->login = filter_var($admin->login, FILTER_SANITIZE_STRING);
                $admin->password = filter_var($admin->password, FILTER_SANITIZE_STRING);*/
                
                try {
                    $token = $adminModel->verifyUser($admin->login, $admin->password);
                }
                catch(\Exception $e) {
                    return new ViewModel(array('form' => $form, 'listeRubrique' => $listeRubrique, 
                        'langue' => $this->getEvent()->getRouteMatch()->getParam('langue'), 'exception' => $e->getMessage()));
                }
                //Redirection vers l'interface d'administration
                $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $this->getEvent()->getRouteMatch()->getParam('langue')));
            }
        }
        return new ViewModel(array('form' => $form, 'listeRubrique' => $listeRubrique, 'langue' => $this->getEvent()->getRouteMatch()->getParam('langue')));
    }
    
    public function indexAction() 
    {
        $rubriqueModel = new RubriqueModel();
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
            return new ViewModel(array('listeRubrique' => $listeRubrique, 'langue' => $this->getEvent()->getRouteMatch()->getParam('langue')));
        }

	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $this->layout()->setVariable('langue', $langue);
        return new ViewModel(array('listeRubrique' => $listeRubrique, 'langue' => $langue));
    }
    
    public function modifRubriqueAction() {
        //Token en brut pour tester -- Voir Mr. Salva
        $token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        //-----------------------------------------------------------------------
        
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $form = new RubriqueForm(); //formulaire de modification de rubrique
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
        }
        
        $idMenu = $this->getEvent()->getRouteMatch()->getParam('id_menu'); //récupère id du menu correspondant
        try {
            $rubriqueToModif = $rubriqueModel->findOne($idMenu);
        }
        catch (\Exception $e) {
            LayoutExceptions::traiteExceptionsOneRubrique($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());           
        }
        
	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $this->layout()->setVariable('langue', $langue);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $rubriqueModif = new Rubrique();
            $form->setInputFilter($rubriqueModif->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formDatas = $form->getData();
                $rubriqueModif->exchangeArray($formDatas);
                $menu = new Menu($idMenu, $formDatas['titre_fr'], $formDatas['titre_en'], $formDatas['actifradio'], $formDatas['position']);
                
                try {
                    $adminModel->modifRubrique($token, $rubriqueModif, $menu);
                }
                catch(\Exception $e) {
                    return new ViewModel(array('form' => $form, 'rubriqueToModif' => $rubriqueToModif, 'langue' => $langue, 'exception' => $e->getMessage()));
                }
                
                $this->redirect()->toRoute('admin', array('langue' => $langue));
            }
        }
        return new ViewModel(array('form' => $form, 'rubriqueToModif' => $rubriqueToModif, 'langue' => $langue));
    }
    
    public function createRubriqueAction() 
    {
        //Token en brut pour tester -- Voir Mr. Salva
        $token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        //-----------------------------------------------------------------------
        
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $form = new RubriqueForm(); //formulaire de création de rubrique
        $listeRubrique = null;
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $rubrique = new Rubrique();
            $form->setInputFilter($rubrique->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formDatas = $form->getData();
                $rubrique->exchangeArray($formDatas);
                $menu = new Menu(null, $formDatas['titre_fr'], $formDatas['titre_en'], $formDatas['actifradio'], $formDatas['position']);
                
                try {
                    $adminModel->createRubrique($token, $rubrique, $menu);
                }
                catch(\Exception $e) {
                    return new ViewModel(array('form' => $form, 'langue' => $langue, 'exception' => $e->getMessage()));
                }
                
                $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
            } 
        }
        
	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $this->layout()->setVariable('langue', $langue);
        return new ViewModel(array('form' => $form, 'langue' => $langue));
    }
    
    public function deleteRubriqueAction() 
    {
        //Token en brut pour tester -- Voir Mr. Salva
        $token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        //-----------------------------------------------------------------------
        
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch (\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
        }
        
        try {
            $adminModel->deleteRubrique($token, $this->getEvent()->getRouteMatch()->getParam('id_menu'));
        }
        catch (\Exception $e) {
            $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue/*, 'exception' => $e->getMessage()*/));       
        }
        
	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $this->layout()->setVariable('langue', $langue);
        $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
    }
	
}
