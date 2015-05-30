<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use \Admin\Form\Post as PostForm;
use \Admin\Entity\Post as Post;

/**
 * Controlador que gerencia os posts
 *
 * @category Admin
 * @package Controller
 * @author  Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 */
class PostsController extends AbstractActionController
{

    /**
     * Exibe os posts
     * @return void
     */
    public function indexAction()
    {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $posts = $em->getRepository('\Admin\Entity\Post')->findAll();
        
        return new ViewModel(
            array(
                'posts' => $posts
            )
        );
    }

    /**
     * Cria ou edita um post
     * @return void
     */
    public function saveAction()
    {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new PostForm($em);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = new Post();
            $values = $request->getPost();
            $form->setInputFilter($post->getInputFilter());
            $form->setData($values);

            if ($form->isValid()) {
                $values = $form->getData();
                if ( (int) $values['id'] > 0)
                    $post = $em->find('\Admin\Entity\Post', $values['id']);


                $post->setTitulo($values['titulo']);
                $post->setMinText($values['minText']);
                $post->setPostComp($values['postComp']);
                $post->setAtivo($values['ativo']);
                $post->setData(new \Datetime());
               // var_dump($post);exit;

                $usuario = $em->find('\Admin\Entity\Usuario', 1);
                $post->setUsuario($usuario);

                $em->persist($post);
                try {
                    $em->flush();
                    $this->flashMessenger()->addSuccessMessage('Post armazenado com sucesso');
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage('Erro ao armazenar post'.$e);
                }

                return $this->redirect()->toUrl('/admin/posts');
            } else {
                var_dump($form->getMessages());exit;
            }
        }

        $id = $this->params()->fromRoute('id', 0);

       if ((int) $id > 0) {
            $post = $em->find('\Admin\Entity\Post', $id);
            $form->bind($post);
        }

        return new ViewModel(
            array('form' => $form)
        );
    }
        
     

    /**
     * Exclui um post
     * @return void
     */
    public function deleteAction()
        {
        $id = $this->params()->fromRoute('id', 0);
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        if ($id > 0) {
            $post = $em->find('\Admin\Entity\Post', $id);
            $em->remove($post);

            try {
                $em->flush();
            } catch (\Exception $e) {
                echo $e; exit;
            }
        }

        return $this->redirect()->toUrl('/admin/posts');
    }

}
