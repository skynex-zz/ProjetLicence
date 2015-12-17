<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
	// route par default pour l'index
    'controllers' => array(
		'invokables' => array(
			'Application\Controller\Index' => Controller\IndexController::class,
			'Application\Controller\Rubrique' => Controller\RubriqueController::class,
			'Application\Controller\Publication' => Controller\PublicationController::class,
                        'Application\Controller\Admin' => Controller\AdminController::class,
                        'Application\Controller\AdminRubrique' => Controller\AdminRubriqueController::class,
                        'Application\Controller\AdminPublication' => Controller\AdminPublicationController::class,
		),
	),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // route pour les rubriques
            'laRubrique' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/rubrique/:langue[/:menu_id]',
                    'constraints' => array(
			'menu_id' => '[0-9]+',
                        'langue' => '[a-z]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Rubrique',
                        'action'     => 'rubriqueselect',
                    ),
                ),
            ),
			// route pour la page publication
            'publications' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/publication/:langue/:trie',
			'constraints' => array(
                            'langue' => '[a-z]+',
                            'trie' => '[a-z]+',
                        ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Publication',
                        'action' => 'afficherPublication',
			'trie' => 'categ',
                    ),
                ),
            ),
            //route connexion administrateur
             'login' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/login/:langue',
                     'constraints' => array(
                            'langue' => '[a-z]+',
                      ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Admin',
                         'action'     => 'login',
                     ),
                 ),
             ),
            'disconnect' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/disconnect/:langue',
                     'constraints' => array(
                            'langue' => '[a-z]+',
                      ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Admin',
                         'action'     => 'disconnect',
                     ),
                 ),
             ),
              'admin' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/:langue',
                     'constraints' => array(
                            'langue' => '[a-z]+',
                      ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Admin',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'admrubrique' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/:langue/rubrique/:id_menu',
                     'constraints' => array(
                         'id_menu'     => '[0-9]+',
                         'langue' => '[a-z]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\AdminRubrique',
                         'action'     => 'modifRubrique',
                     ),
                 ),
             ),
             'createrubrique' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/:langue/createrubrique',
                     'constraints' => array(
                         'langue' => '[a-z]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\AdminRubrique',
                         'action'     => 'createRubrique',
                     ),
                 ),
             ),
             'delrubrique' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/:langue/deleterubrique/:id_menu',
                     'constraints' => array(
                         'id_menu'     => '[0-9]+',
                         'langue' => '[a-z]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\AdminRubrique',
                         'action'     => 'deleteRubrique',
                     ),
                 ),
             ),
            'admpublication' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/:langue/publication/:id_publication',
                     'constraints' => array(
                         'id_publication' => '[0-9]+',
                         'langue' => '[a-z]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\AdminPublication',
                         'action'     => 'modifPublication',
                     ),
                 ),
             ),
             'createpublication' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/:langue/createpublication',
                     'constraints' => array(
                         'langue' => '[a-z]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\AdminPublication',
                         'action'     => 'createPublication',
                     ),
                 ),
             ),
             'delpublication' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/:langue/deletepublication/:id_publication',
                     'constraints' => array(
                         'id_publication' => '[0-9]+',
                         'langue' => '[a-z]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\AdminPublication',
                         'action'     => 'deletePublication',
                     ),
                 ),
             ),
            'bibtexpublication' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin/:langue/bibtexpublication',
                     'constraints' => array(
                         'langue' => '[a-z]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\AdminPublication',
                         'action' => 'createBibtexPublication',    
                     ),
                 ),
             ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
