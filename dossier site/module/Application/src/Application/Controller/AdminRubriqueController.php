<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container; //pour le token à envoyer dans une session pour pouvoir l'utiliser ailleurs

use Application\Model\Rubrique;
use Application\Model\Menu;
use Application\Model\AdminModel;
use Application\Model\RubriqueModel;
use Application\Model\SendLayout;
use Application\Model\Filter;
use Application\Model\VerifUser;

use Application\Form\RubriqueForm;


class AdminRubriqueController extends AbstractActionController
{    
    
    public function createRubriqueAction() 
    {
        //Vérification token
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
        $adminModel = new AdminModel();
        $form = new RubriqueForm(); //formulaire de création de rubrique
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $msgSuccess = null;
        
        //try catch du fetchAll des rubriques
        $listeRubriques = SendLayout::fetchAllRubriques($this, 'crrub', $langue, $token);
        
        //Traitement formulaire
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
                $msgSuccess = 'creationrubrique';
                $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue), array('query' => array('successCrR' => $msgSuccess)));
            } 
        }
        //Envoi des variables au layout
        SendLayout::sendGeneral($this, $listeRubriques, 'crrub', $langue, $token);
        return new ViewModel(array('form' => $form, 'langue' => $langue, 'msgSuccess' => $msgSuccess)); 
    }
    
    public function modifRubriqueAction() {
        
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
        $adminModel = new AdminModel();
        $form = new RubriqueForm(); //formulaire de modification de rubrique
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $idMenu = $this->getEvent()->getRouteMatch()->getParam('id_menu'); //récupère id du menu correspondant
        $msgSuccess = null;
        
        //try catch du fetchAll des rubriques
        $listeRubriques = SendLayout::fetchAllRubriques($this, 'modifrub', $langue, $token);
        //try catch du findOne de rubrique
        $rubriqueToModif = SendLayout::findOneRubrique($this, $listeRubriques, 'modifrub', $langue, $token, $idMenu);

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
                $msgSuccess = 'modifrubrique';
                $this->redirect()->toRoute('admin', array('langue' => $langue), array('query' => array('successMdfR' => $msgSuccess)));
            }
        }
        //Envoi des variables au layout
        SendLayout::sendGeneral($this, $listeRubriques, 'modifrub', $langue, $token);
        $this->layout()->setVariable('id_menu', $idMenu);
        
        return new ViewModel(array('form' => $form, 'rubriqueToModif' => $rubriqueToModif, 'langue' => $langue));
    }
    
    public function deleteRubriqueAction() 
    {
        $token = VerifUser::tokenAction();
        if($token == null) $this->redirect()->toRoute('home');
        
        $adminModel = new AdminModel();
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $msgSuccess = null;
        
        //try catch du fetchAll des rubriques
        $listeRubriques = SendLayout::fetchAllRubriques($this, 'admin', $langue, $token);
        
        try {
            $adminModel->deleteRubrique($token, $this->getEvent()->getRouteMatch()->getParam('id_menu'));
        }
        catch (\Exception $e) {
            $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue, 'exSuppRubrique' => $e->getMessage()));       
        }
        //Envoi des variables au layout
        SendLayout::sendGeneral($this, $listeRubriques, 'admin', $langue, $token);
        
        $msgSuccess = 'deleterubrique';
        $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue), array('query' => array('successDltR' => $msgSuccess)));
    }
	
}
