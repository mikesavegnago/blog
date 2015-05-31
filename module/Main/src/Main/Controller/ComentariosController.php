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
            //var_dump($comentario);
            //$form->setInputFilter($comentario->getInputFilter());
            //var_dump($comentario);exit;
            $form->setData($values);
           
            
            if ($form->isValid()){             
                $values = $form->getData();
                $comentario->setEmail($values['email']);
                $comentario->setComentario($values['comentario']);
                $post = $em->find('\Admin\Entity\Post', $values['post']);
                $comentario->setPost($post);
                
                
               $em->persist($comentario);

                try {
                    $em->flush();
                    $this->flashMessenger()->addSuccessMessage('Comentario armazenado com sucesso');
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage('Erro ao armazenar comentario'.$e->getMessage());
                }

                return $this->redirect()->toUrl('/main/index/pagina/id/'.$values["post"]);
            }
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
