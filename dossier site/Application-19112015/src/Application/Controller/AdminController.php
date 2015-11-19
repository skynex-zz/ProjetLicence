<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container; //pour le token à envoyer dans une session pour pouvoir l'utiliser ailleurs

use Application\Model\Admin;
use Application\Model\Rubrique;
use Application\Model\Publication;
use Application\Model\Menu;
use Application\Model\AdminModel;
use Application\Model\RubriqueModel;
use Application\Model\PublicationModel;
use Application\Model\CategorieModel;
use Application\Model\LayoutExceptions;
use Application\Model\ValidationUploadedFile;

use Application\Form\AdminForm; 
use Application\Form\RubriqueForm;
use Application\Form\PublicationForm;


class AdminController extends AbstractActionController
{    
    
    public function checkSession() {
        $session = new Container('user');
        if(isset($session->token)) {
            return $session->token;
        }
        return null;
    }
    
    public function getCategories() {
        $categorieModel = new CategorieModel();
        try {
            $listeCategories = $categorieModel->fetchAll();
        }
        catch(\Exception $e) {
            return null;
        }
        return $listeCategories;
    }
    
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
        $this->layout()->setVariable('menu_id', 'login');
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
                try {
                    $token = $adminModel->verifyUser($admin->login, $admin->password);
                }
                catch(\Exception $e) {
                    $token = null;
                    return new ViewModel(array('form' => $form, 'listeRubrique' => $listeRubrique, 
                        'langue' => $this->getEvent()->getRouteMatch()->getParam('langue'), 'exception' => $e->getMessage()));
                }
                //J'ai testé avec forward dispatch + envoyer token au layout plus redirection de différentes manières mais rien marche ==> Session peut-être
                if($token != null) {
                    $session = new Container('user');
                    $session->token = $token;
                    //Redirection vers l'interface d'administration
                    $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $this->getEvent()->getRouteMatch()->getParam('langue')));
                }
            }
        }
        return new ViewModel(array('form' => $form, 'listeRubrique' => $listeRubrique, 'langue' => $this->getEvent()->getRouteMatch()->getParam('langue')));
    }
    
    public function disconnectAction() 
    {
        $session = new Container('user');
        $session->token = null;
        $rubriqueModel = new RubriqueModel();
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $e->getMessage());
        }
        
        $this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 0);
        $this->layout()->setVariable('langue', $this->getEvent()->getRouteMatch()->getParam('langue'));
        $this->layout()->setVariable('token', $session->token);
        
        $this->redirect()->toRoute('home');
    }
    
    public function indexAction() 
    {   
        $token = null;
        if($this->checkSession() != null) {
            $token = $this->checkSession();
        }
        /*else {
            $this->redirect()->toRoute('home');
        }*/
        
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $rubriqueModel = new RubriqueModel();
        $publicationModel = new PublicationModel();
        $listeRubrique = null;
        $listePublications = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $langue, $token, $e->getMessage());
            return new ViewModel(array('listeRubrique' => $listeRubrique, 'listePublications' => $listePublications, 'langue' => $langue, 'exRubriques' => $e->getMessage()));
        }
        try {
            $listePublications = $publicationModel->fetchAll();
        } 
        catch (\Exception $e) {
            return new ViewModel(array('listeRubrique' => $listeRubrique, 'listePublications' => $listePublications, 'langue' => $langue, 'exPublications' => $e->getMessage()));
        }

	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $this->layout()->setVariable('langue', $langue);
        $this->layout()->setVariable('token', $token);
        return new ViewModel(array('listeRubrique' => $listeRubrique, 'listePublications' => $listePublications, 'langue' => $langue));
    }
    
    /****** GESTION RUBRIQUES ******/
    
    public function createRubriqueAction() 
    {
        $token = null;
        if($this->checkSession() != null) {
            $token = $this->checkSession();
        }
        
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $form = new RubriqueForm(); //formulaire de création de rubrique
        $listeRubrique = null;
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());
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
        $this->layout()->setVariable('token', $token);
        return new ViewModel(array('form' => $form, 'langue' => $langue));
    }
    
    public function modifRubriqueAction() {
        
        $token = null;
        if($this->checkSession() != null) {
            $token = $this->checkSession();
        }
        
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $form = new RubriqueForm(); //formulaire de modification de rubrique
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());
        }
        
        $idMenu = $this->getEvent()->getRouteMatch()->getParam('id_menu'); //récupère id du menu correspondant
        try {
            $rubriqueToModif = $rubriqueModel->findOne($idMenu);
        }
        catch (\Exception $e) {
            LayoutExceptions::traiteExceptionsOneRubrique($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());           
        }
        
	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $this->layout()->setVariable('langue', $langue);
        $this->layout()->setVariable('token', $token);

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
    
    public function deleteRubriqueAction() 
    {
        $token = null;
        if($this->checkSession() != null) {
            $token = $this->checkSession();
        }
        
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch (\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());
        }
        
        try {
            $adminModel->deleteRubrique($token, $this->getEvent()->getRouteMatch()->getParam('id_menu'));
        }
        catch (\Exception $e) {
            $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue, 'exSuppRubrique' => $e->getMessage()));       
        }
        
	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $this->layout()->setVariable('langue', $langue);
        $this->layout()->setVariable('token', $token);
        $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
    }
    
    /****** GESTION PUBLICATIONS ******/
    
    public function createPublicationAction() 
    {
        $token = null;
        if($this->checkSession() != null) {
            $token = $this->checkSession();
        }
        
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $form = new PublicationForm(); //formulaire de création de publication
        $listeRubrique = null;
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $this->getEvent()->getRouteMatch()->getParam('langue'), $token, $e->getMessage());
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $publication = new Publication();
            $form->setInputFilter($publication->getInputFilter());
            
            $other = $request->getPost()->toArray();
            $file = $this->params()->fromFiles('pdf');
            $data = array_merge(
                 $other,
                 array('pdf' => $file['name'])
             );
            $form->setData($data);
            
            if ($form->isValid()) {
                $publication->exchangeArray($form->getData());
                $publication->pdf = 'useruploads/files/'.$file['name'];
                try {
                    $adminModel->createPublication($token, $publication);
                }
                catch(\Exception $e) {
                    return new ViewModel(array('form' => $form, 'langue' => $langue, 'exCreatePublication' => $e->getMessage()));
                }
                
                $valid = new ValidationUploadedFile();
                if($valid->moveFile($file)) $this->redirect()->toRoute('admin', array('langue' => $langue));
            } 
        }
        
	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $this->layout()->setVariable('langue', $langue);
        $this->layout()->setVariable('token', $token);
        return new ViewModel(array('form' => $form, 'langue' => $langue, 'listeCategories' => $this->getCategories()));
    }
    
    public function modifPublicationAction() 
    {        
        $token = null;
        if($this->checkSession() != null) {
            $token = $this->checkSession();
        }
        
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $idPublication = $this->getEvent()->getRouteMatch()->getParam('id_publication'); //récupère id de la publication correspondante
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $publicationModel = new PublicationModel();
        $form = new PublicationForm(); //formulaire de modification de rubrique
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $langue, $token, $e->getMessage());
        }
        try {
            $publicationToModif = $publicationModel->findOne($token, $idPublication);
        }
        catch(\Exception $e) {
            LayoutExceptions::traiteExceptionsOneRubrique($this, $listeRubrique, 'admin', $langue, $token, $e->getMessage());   
        }
        
	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $this->layout()->setVariable('langue', $langue);
        $this->layout()->setVariable('token', $token);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $publicationModif = new Publication();
            $form->setInputFilter($publicationModif->getInputFilter());
            
            $other = $request->getPost()->toArray();
            $file = $this->params()->fromFiles('pdf');
            $data = array_merge(
                 $other,
                 array('pdf' => $file['name'])
             );
            $form->setData($data);

            if ($form->isValid()) {
                $publicationModif->exchangeArray($form->getData());
                $publicationModif->id = $idPublication;
                $publicationModif->pdf = 'useruploads/files/'.$file['name'];
                
                try {
                    $adminModel->modifPublication($token, $publicationModif);
                }
                catch(\Exception $e) {
                    return new ViewModel(array('form' => $form, 'publicationToModif' => $publicationToModif, 'listeCategories' => $this->getCategories(), 'langue' => $langue, 'exModifPublication' => $e->getMessage()));
                }
                
                $valid = new ValidationUploadedFile();
                if($valid->moveFile($file)) $this->redirect()->toRoute('admin', array('langue' => $langue));
            }
        }
        return new ViewModel(array('form' => $form, 'publicationToModif' => $publicationToModif, 'listeCategories' => $this->getCategories(), 'langue' => $langue));
    }
    
    public function deletePublicationAction() 
    {
        $token = null;
        if($this->checkSession() != null) {
            $token = $this->checkSession();
        }
        
        $rubriqueModel = new RubriqueModel();
        $adminModel = new AdminModel();
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $listeRubrique = null;
        
        try {
            $listeRubrique = $rubriqueModel->fetchAll();
        }
        catch (\Exception $e) {
            LayoutExceptions::traiteExceptionsAllRubriques($this, $listeRubrique, 'admin', $langue, $token, $e->getMessage());
        }
        
        try {
            $adminModel->deletePublication($token, $this->getEvent()->getRouteMatch()->getParam('id_publication'));
        }
        catch (\Exception $e) {
            $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue, 'exSuppPublication' => $e->getMessage()));       
        }
        
	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $this->layout()->setVariable('langue', $langue);
        $this->layout()->setVariable('token', $token);
        $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
    }
	
}
