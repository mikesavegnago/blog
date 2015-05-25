<?php

namespace Main\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use \Main\Form\Comentario as ComentarioForm;
use \Main\Entity\Comentario as Comentario;

/**
 * Controlador que gerencia os comentarios
 *
 * @category Main
 * @package Controller
 * @author  Paulo Cella <paulocella@unochapeco.edu.br>
 */
class ComentariosController extends AbstractActionController
{

    /**
     * Exibe os comentarios
     * @return void
     */
    public function indexAction()
    {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $comentarios = $em->getRepository('\Main\Entity\Comentario')->findAll();
        var_dump($comentarios);exit;

        return new ViewModel(
            array(
                'comentarios' => $comentarios
            )
        );
    }

    /**
     * Cria ou edita um comentario
     * @return void
     */
    public function saveAction()
     {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new ComentarioForm($em);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $comentario = new Comentario();
            $values = $request->getPost();
            $form->setInputFilter($comentario->getInputFilter());
            $form->setData($values);
            
            if ($form->isValid()) {             
                $values = $form->getData();

                if ( (int) $values['id'] > 0)
                    $comentario = $em->find('\Main\Entity\Comentario', $values['id']);

                $comentario->setEmail($values['email']);
                $comentario->setComentario($values['comentario']);
                $comentario->setPost($values['post']);
                
                // nao sei bem certo como funciona para salvar os posts
                foreach ($values['post'] as $pos) {
                    $posts = $em->find('\AMain\Entity\Post', $pos);
                    $comentario->getPost()->add($posts);
                }

                $em->persist($comentario);

                try {
                    $em->flush();
                    $this->flashMessenger()->addSuccessMessage('Comentario armazenado com sucesso');
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage('Erro ao armazenar comentario');
                }

                return $this->redirect()->toUrl('/main/comentarios');
            }
        }

        $id = $this->params()->fromRoute('id', 0);

        if ((int) $id > 0) {
            $comentario = $em->find('\Main\Entity\Comentario', $id);
            $form->bind($comentario);
        }

        return new ViewModel(
            array('form' => $form)
        );
    }

     

    /**
     * Exclui um comentario
     * @return void
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        if ($id > 0) {
            $comentario = $em->find('\Main\Entity\Comentario', $id);
            $em->remove($comentario);

            try {
                $em->flush();
                $this->flashMessenger()->addSuccessMessage('Comentario excluído com sucesso');
            } catch (\Exception $e) {
                $this->flashMessenger()->addErrorMessage('Erro ao excluir coemntario');
            }
        }

        return $this->redirect()->toUrl('/main/usuarios');
    }

}
