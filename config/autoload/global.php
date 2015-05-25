<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    // ...
    
    'acl' => array(
        'roles' => array(
            'VISITANTE' => null,
            'ADMIN' => 'VISITANTE',
        ),
        'resources' => array(
            'Application\Controller\Index.index',
            'Admin\Controller\Login.login',
            'Admin\Controller\Login.logout',
            'Admin\Controller\Usuarios.index',
            'Admin\Controller\Usuarios.save',
            'Admin\Controller\Usuarios.delete',
            'Admin\Controller\Posts.index',
            'Admin\Controller\Posts.save',
            'Admin\Controller\Posts.delete',
            'Main\Controller\Comentarios.index',
            'Main\Controller\Comentarios.save',
            'Main\Controller\Comentarios.delete',
        ),
        'privilege' => array(
            'VISITANTE' => array(
                'allow' => array(
                    'Admin\Controller\Posts.index',
                    'Main\Controller\Comentarios.index'
                )
            ),
            ),
            'ADMIN' => array(
                'allow' => array(
                	'Application\Controller\Index.index',
           		    'Admin\Controller\Login.login',
            		'Admin\Controller\Login.logout',
                    'Admin\Controller\Usuarios.index',
                    'Admin\Controller\Usuarios.save',
                    'Admin\Controller\Usuarios.delete',
                    'Admin\Controller\Posts.save',
                    'Admin\Controller\Posts.delete',
                    'Main\Controller\Comentarios.save',
                    'Main\COntroller\Comentarios.delete'
                )
            ),
        
    )
    
);