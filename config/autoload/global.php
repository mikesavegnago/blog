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
            'EDITOR' => 'VISITANTE',
            'ADMIN' => 'EDITOR',
        ),
        'resources' => array(
            'Admin\Controller\Index.index',
            'Admin\Controller\Index.opcoes',
            'Main\Controller\Index.index',
            'Main\Controller\Index.pagina',
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
                    'Main\Controller\Index.index',
                    'Main\Controller\Index.pagina',
                    'Admin\Controller\Index.index',
                    'Admin\Controller\Posts.index', 
                    'Admin\Controller\Login.login',
                    'Admin\Controller\Login.logout',
                    'Main\Controller\Comentarios.index',
                    'Main\Controller\Comentarios.save'
                )
            ),
            
            'EDITOR' => array(
                'allow' => array(
                    'Admin\Controller\Posts.save'
                )
            ),
            
            'ADMIN' => array(
                'allow' => array(
                    'Admin\Controller\Index.opcoes',
                    'Admin\Controller\Usuarios.index',
                    'Admin\Controller\Usuarios.save',
                    'Admin\Controller\Usuarios.delete',
                    'Admin\Controller\Posts.delete',
                    'Main\Controller\Comentarios.delete'
                )
            ),
        )
        
    )
    
);