<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Article' => 'Blog\Controller\ArticleController'
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Article',
                        'action'     => 'lister',
                    ),
                ),
            ),
            'article_ajouter' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/ajouter',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Article',
                        'action'     => 'ajouter',
                    ),
                ),
            ),
            'article_details' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/article/:id',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Article',
                        'action'     => 'details',
                    ),
                    'constraints' => array(
                        'id' => '[1-9][0-9]*',
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