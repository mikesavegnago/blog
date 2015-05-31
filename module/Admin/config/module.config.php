<?php

// module/Admin/conﬁg/module.config.php:
return array(
    'controllers' => array( //add module controllers
        'invokables' => array(
            'Admin\Controller\Usuarios' => 'Admin\Controller\UsuariosController',
            'Admin\Controller\Posts' => 'Admin\Controller\PostsController',
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Login' => 'Admin\Controller\LoginController',
            'Admin\Controller\Comentarios' => 'Admin\Controller\ComentariosController'
        ),
    ),
    //Configuração doctrine
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Admin/Entity'
                      )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Admin\Entity' => 'application_entities'
                )
            ))),
    //*********************************************************

    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'module'        => 'admin'
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
                        'child_routes' => array( //permite mandar dados pela url 
                            'wildcard' => array(
                                'type' => 'Wildcard'
                            ),
                        ),
                    ),
                    
                ),
            ),
            'index_paginacao' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[page/:page]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Main\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                        'module' => 'main',
                        'page' => 1,
                    ),
                ),
            ), 
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Session' => function($sm) {
                return new Zend\Session\Container('Blog');
            },
            'Admin\Service\Auth' => function($sm) {
                $dbAdapter = $sm->get('DbAdapter');
                return new Admin\Service\Auth($dbAdapter);
            },
        )
    ),

    'view_manager' => array( 
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
    ),
   
);
