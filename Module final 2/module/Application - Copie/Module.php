<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Application;
use Zend\Mvc\Controller\AbstractActionController;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch.error',
             array($this,
             'handleControllerNotFoundAndControllerInvalidAndRouteNotFound'), 100);
		
		$moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	 public function handleControllerCannotDispatchRequest(MvcEvent $e)
    {
        $action = $e->getRouteMatch()->getParam('action');
        $controller = get_class($e->getTarget());
         
        // error-controller-cannot-dispatch
        if (! method_exists($e->getTarget(), $action.'Action')) {
            $typeErreur = 1;
            $controller.' was unable to dispatch the request : '.$action.'Action';
            //you can do logging, redirect, etc here
			$url = $e->getRouter()->assemble(array('erreur' => 'erreur'), array('name' => 'home', 'query' => array ('erreur'=> $typeErreur)));
			$response=$e->getResponse();
			$response->getHeaders()->addHeaderLine('Location', $url);
			$response->setStatusCode(302);
			$response->sendHeaders();
			return $response;
		}
    }   
	
	
	public function handleControllerNotFoundAndControllerInvalidAndRouteNotFound(MvcEvent $e)
    {
        $error  = $e->getError();
        if ($error == Application::ERROR_CONTROLLER_NOT_FOUND) {
            //there is no controller named $e->getRouteMatch()->getParam('controller')
            $typeErreur = 2; 
		}
        if ($error == Application::ERROR_CONTROLLER_INVALID) {
            //the controller doesn't extends AbstractActionController
            $typeErreur = 3; 
            }         
        if ($error == Application::ERROR_ROUTER_NO_MATCH) {
            // the url doesn't match route, for example, there is no /foo literal of route
            $typeErreur = 4; 
            }
		$url = $e->getRouter()->assemble(array('erreur' => 'erreur'), array('name' => 'home', 'query' => array ('erreur'=> $typeErreur)));
		$response=$e->getResponse();
		$response->getHeaders()->addHeaderLine('Location', $url);
		$response->setStatusCode(302);
		$response->sendHeaders();
		return $response;
	
	} 
}
