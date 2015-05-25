<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use \Admin\Form\Usuario as UsuarioForm;
use \Admin\Entity\Usuario as Usuario;

/**
 * Controlador que gerencia os usuários
 *
 * @category Admin
 * @package Controller
 * @author  Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 */
class UsuariosController extends AbstractActionController
{

    /**
     * Exibe os usuários
     * @return void
     */
    public function indexAction()
     {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $usuarios = $em->getRepository('\Admin\Entity\Usuario')->findAll();
        //var_dump($usuarios);exit;
        return new ViewModel(
            array(
                'usuarios' => $usuarios
            )
        );
    }

    /**
     * Cria ou edita um usuário
     * @return void
     */
    public function saveAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new UsuarioForm($em);
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $values = $request->getPost();
            $usuario = new Usuario();
            $form->setInputFilter($usuario->getInputFilter());
            $form->setData($values);
            var_dump($form); exit;
            
            if($form->isValid()) {
                $values = $form->getData();
                if ((int)$values['id'] > 0)
                    $usuario = $em->find('\Admin\Entity\Usuario', $values['id']);
                
                $usuario->setEmail($values['email']);
                $usuario->setNome($values['nome']);
                $usuario->setDataNasc(new \DateTime($values['data_nasc']));
                $usuario->setPerfil($values['perfil']);
                $usuario->setLogin($values['login']);
                $usuario->setSenha($values['senha']);
                $usuario->setRole($values['role']);

                $em->persist($usuario);

                try{
                    $em->flush();
                }catch(\Exception $e) {
                    echo $e; exit;
                }
                return $this->redirect()->toUrl('/admin/usuarios/index');
            }
        }
        
        return new ViewModel(
            array('form' => $form)
            );
    }
    
    /**
     * Exclui um usuário
     * @return void
     */
    public function deleteAction()
     {
        $id = $this->params()->fromRoute('id', 0);
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        if ($id > 0) {
            $usuario = $em->find('\Admin\Entity\Usuario', $id);
            $em->remove($usuario);

            try {
                $em->flush();
            } catch (\Exception $e) {
                echo $e; exit;
            }
        }

        return $this->redirect()->toUrl('/admin/usuarios');
    }

}
