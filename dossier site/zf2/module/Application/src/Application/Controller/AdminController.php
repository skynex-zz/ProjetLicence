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
use Application\Model\Admin;
use Application\Form\AdminForm; 
use Application\Model\AdminModel;

//Tests avec Rubrique mais faut mettre tout ce qui concerne les rubriques dans RubriqueController je pense
use Application\Model\Rubrique;
use Application\Form\RubriqueForm; 
use Application\Model\RubriqueModel;
use Application\Model\Menu;

class AdminController extends AbstractActionController
{
    public $token; //token récupéré à la connexion
	
    public function loginAction() 
    {        
        $rubriqueModel = new RubriqueModel();
        $listeRubrique = $rubriqueModel->fetchAll();

	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $this->layout()->setVariable('langue', $langue);
        
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
                $admin->login = filter_var($admin->login, FILTER_SANITIZE_STRING);
                $admin->password = filter_var($admin->password, FILTER_SANITIZE_STRING);
                
                $token = $adminModel->verifyUser($admin->login, $admin->password);
                
                //if code 200
                $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
                
                /*return $this->forward()->dispatch('Rubrique\Controller\Admin', array(
                    'action' => 'index',
                    'token'   => $token,
                ));*/
            }
        }
        return new ViewModel(array('form' => $form, 'listeRubrique' => $listeRubrique, 'langue' => $langue));
    }
    
    public function indexAction() 
    {
        $rubriqueModel = new RubriqueModel();
        $listeRubrique = $rubriqueModel->fetchAll();

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
        $listeRubrique = $rubriqueModel->fetchAll();

	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $this->layout()->setVariable('langue', $langue);
        
        $form = new RubriqueForm(); //formulaire de connexion
        $adminModel = new AdminModel();
        $idMenu = $this->getEvent()->getRouteMatch()->getParam('id_menu'); //récupère id du menu correspondant
        $rubriqueToModif = $rubriqueModel->findOne($idMenu);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $rubriqueModif = new Rubrique();
            $form->setInputFilter($rubriqueModif->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formDatas = $form->getData();
                $rubriqueModif->exchangeArray($formDatas);
                $menu = new Menu($idMenu, $formDatas['titre_fr'], $formDatas['titre_en'], $formDatas['actifradio'], $formDatas['position']);
                
                $adminModel->modifRubrique($token, $rubriqueModif, $menu);
                $this->redirect()->toRoute('admrubrique', array('id_menu' => $idMenu, 'langue' => $langue));
            }
        }
        return new ViewModel(array('form' => $form, 'listeRubriques' => $listeRubrique, 'rubriqueToModif' => $rubriqueToModif, 'langue' => $langue));
    }
    
    public function createRubriqueAction() 
    {
        //Token en brut pour tester -- Voir Mr. Salva
        $token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        //-----------------------------------------------------------------------
        
        $rubriqueModel = new RubriqueModel();
        $listeRubrique = $rubriqueModel->fetchAll();

	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $this->layout()->setVariable('langue', $langue);
        
        $form = new RubriqueForm(); //formulaire de connexion
        $adminModel = new AdminModel();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $rubrique = new Rubrique();
            $form->setInputFilter($rubrique->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formDatas = $form->getData();
                $rubrique->exchangeArray($formDatas);
                $menu = new Menu(null, $formDatas['titre_fr'], $formDatas['titre_en'], $formDatas['actifradio'], $formDatas['position']);
                
                $adminModel->createRubrique($token, $rubrique, $menu);
                $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
            } 
        }
        return new ViewModel(array('form' => $form, 'listeRubriques' => $listeRubrique, 'langue' => $langue));
    }
    
    public function deleteRubriqueAction() 
    {
        //Token en brut pour tester -- Voir Mr. Salva
        $token = 'WU8nb/rCD6JgtiyxTW3ZP+s4n9Vg9liUllh5bZLoLQhAMMoCaHE72nYLQSsw12uhkgWJLDmgMmZVD+aIk6BsZw==';
        //-----------------------------------------------------------------------
        
        $rubriqueModel = new RubriqueModel();
        $listeRubrique = $rubriqueModel->fetchAll();

	$this->layout()->setVariable('listeRubrique', $listeRubrique);
        $this->layout()->setVariable('menu_id', 'admin');
        $langue = $this->getEvent()->getRouteMatch()->getParam('langue');
        $this->layout()->setVariable('langue', $langue);
        
        $idMenu = $this->getEvent()->getRouteMatch()->getParam('id_menu');
        $adminModel = new AdminModel();
        $adminModel->deleteRubrique($token, $idMenu);
        $this->redirect()->toRoute('admin', array('action' => 'index', 'langue' => $langue));
    }
	
}
