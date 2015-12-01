<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container; //pour le token à envoyer dans une session pour pouvoir l'utiliser ailleurs

use Application\Model\Publication;
use Application\Model\AdminModel;
use Application\Model\RubriqueModel;
use Application\Model\PublicationModel;
use Application\Model\CategorieModel;
use Application\Model\SendLayout;
use Application\Model\ValidationUploadedFile;
use Application\Model\BibtexManagement;
use Application\Model\VerifUser;

use Application\Form\PublicationForm;
use Application\Form\BibtexPublicationForm;


class AdminPublicationController extends AbstractActionController
{    
    
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
    
    /****** GESTION PUBLICATIONS ******/
    
    public function createPublicationAction() 
    {
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
        $adminModel = new AdminModel();
        $form = new PublicationForm(); //formulaire de création de publication
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        
        $listeRubriques = SendLayout::fetchAllRubriques($this, 'crpubli', $langue, $token);
        
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
                $valid = new ValidationUploadedFile();
                if($valid->validatorsFile($file, 'pdf') != false) {
                    $valid->moveFile($file);
                    $publication->pdf = 'useruploads/files/'.$file['name'];
                }
                else {
                    $publication->pdf = null;
                    $errorExt = 'error extension';
                }
                try {
                    $adminModel->createPublication($token, $publication);
                }
                catch(\Exception $e) {
                    return new ViewModel(array('form' => $form, 'langue' => $langue, 'exCreatePublication' => $e->getMessage()));
                }
                $this->redirect()->toRoute('admin', array('langue' => $langue));
            } 
        }
        //Envoi des variables au layout
        SendLayout::sendGeneral($this, $listeRubriques, 'crpubli', $langue, $token);
        
        if(!isset($errorExt)) {
            return new ViewModel(array('form' => $form, 'langue' => $langue, 'listeCategories' => $this->getCategories()));
        }
        return new ViewModel(array('form' => $form, 'langue' => $langue, 'listeCategories' => $this->getCategories(), 'errorMsgExtension' => 'L\'extension du fichier doit être pdf.'));
    }
    
    public function createBibtexPublicationAction() 
    {
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
        $adminModel = new AdminModel();
        $form = new BibtexPublicationForm(); //formulaire de création de publication
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        
        $listeRubriques = SendLayout::fetchAllRubriques($this, 'crbibtex', $langue, $token);
        
        $request = $this->getRequest();
        if ($request->isPost()) {            
            $other = $request->getPost()->toArray();
            $file = $this->params()->fromFiles('bibtex');
            $data = array_merge(
                 $other,
                 array('bibtex' => $file['name'])
             );
            $form->setData($data);
            
            if ($form->isValid()) {
                $valid = new ValidationUploadedFile();
                if($valid->validatorsFile($file, 'bib') != false) {
                    $valid->moveFile($file);
                    $publis = BibtexManagement::parsing($file['name']);
                    /*foreach($publis as $pub) {
                        try {
                            $adminModel->createPublication($token, $pub);
                        }
                        catch(\Exception $e) {
                            return new ViewModel(array('form' => $form, 'langue' => $langue, 'exCreatePublication' => $e->getMessage()));
                        }
                    }
                    $this->redirect()->toRoute('admin', array('langue' => $langue))*/;
                }
                else {
                    $errorExt = 'error extension';
                }
            }
        }
        //Envoi des variables au layout
        SendLayout::sendGeneral($this, $listeRubriques, 'crbibtex', $langue, $token);
        
        if(!isset($errorExt)) {
            return new ViewModel(array('form' => $form, 'langue' => $langue));
        }
        return new ViewModel(array('form' => $form, 'langue' => $langue, 'errorMsgExtension' => 'L\'extension du fichier doit être bib.'));
    }
    
    public function modifPublicationAction() 
    {        
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $idPublication = $this->getEvent()->getRouteMatch()->getParam('id_publication'); //récupère id de la publication correspondante
        $adminModel = new AdminModel();
        $publicationModel = new PublicationModel();
        $form = new PublicationForm(); //formulaire de modification de rubrique
        
        $listeRubriques = SendLayout::fetchAllRubriques($this, 'modifpubli', $langue, $token);
        try {
            $publicationToModif = $publicationModel->findOne($token, $idPublication);
        }
        catch(\Exception $e) {
            //LayoutExceptions::traiteExceptionsOneRubrique($this, $listeRubrique, 'admin', $langue, $token, $e->getMessage());
            return 0;
        }

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
                $valid = new ValidationUploadedFile();
                if($valid->moveFile($file, 'pdf')) {
                    $publicationModif->pdf = 'useruploads/files/'.$file['name'];
                }
                else {
                    $publicationModif->pdf = null;
                }
                
                try {
                    $adminModel->modifPublication($token, $publicationModif);
                }
                catch(\Exception $e) {
                    return new ViewModel(array('form' => $form, 'publicationToModif' => $publicationToModif, 'listeCategories' => $this->getCategories(), 'langue' => $langue, 'exModifPublication' => $e->getMessage()));
                }
                $this->redirect()->toRoute('admin', array('langue' => $langue));
            }
        }
        
        $this->layout()->setVariable('listeRubrique', $listeRubriques);
        $this->layout()->setVariable('menu_id', 'modifpubli');
        $this->layout()->setVariable('id_publication', $idPublication);
        $this->layout()->setVariable('langue', $langue);
        $this->layout()->setVariable('token', $token);
        //Envoi des variables au layout
        //SendLayout::sendGeneral($this, $listeRubriques, 'modifpubli', $langue, $token);
        //$this->layout()->setVariable('id_publication', $idPublication);
        
        return new ViewModel(array('form' => $form, 'publicationToModif' => $publicationToModif, 'listeCategories' => $this->getCategories(), 'langue' => $langue));
    }
    
    public function deletePublicationAction() 
    {
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
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
