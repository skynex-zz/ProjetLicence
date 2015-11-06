<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rubrique;

return array(
     'controllers' => array(
         'invokables' => array(
             'Rubrique\Controller\Rubrique' => 'Rubrique\Controller\RubriqueController',
         ),
     ),
    
         'router' => array(
         'routes' => array(
             'rubrique' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/rubriques[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Rubrique\Controller\Rubrique',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'onerubrique' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/rubrique[/:id]',
                     'constraints' => array(
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Rubrique\Controller\Rubrique',
                         'action'     => 'myrubrique',
                     ),
                 ),
             ),
         ),
     ),
    
     'view_manager' => array(
         'template_path_stack' => array(
             'rubrique' => __DIR__ . '/../view',
         ),
     ),
 );