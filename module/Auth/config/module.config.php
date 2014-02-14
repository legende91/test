<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Auth\Controller\Auth' => 'Auth\Controller\AuthController'
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'auth' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Auth',
                        'action'     => 'login',
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),  
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);