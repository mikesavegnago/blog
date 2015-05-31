<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use \Main\Form\Comentario as ComentarioForm;
use \Main\Entity\Comentario as Comentario;

/**
 * Controlador que gerencia os comentarios
 *
 * @category Admin
 * @package Controller
 * @author  Paulo Cella <paulocella@unochapeco.edu.br>
 */
class ComentariosController extends AbstractActionController
{

    public function indexAction()
    {
         //verificar a sessao e só dar permissao de exclusao se forma dministrador
        
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $comentarios = $em->getRepository('\Main\Entity\Comentario')->findAll();

        return new ViewModel(
            array(
                
                'comentarios' => $comentarios
            )
        );
    }

    
    public function deleteAction()
    {
        //verificar a sessao e só dar permissao de exclusao se forma dministrador
        
        $id = $this->params()->fromRoute('id', 0);
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        if ($id > 0) {
            $comentario = $em->find('\Main\Entity\Comentario', $id);
            $em->remove($comentario);

            try {
                $em->flush();
                $this->flashMessenger()->addSuccessMessage('Comentario excluído com sucesso');
            } catch (\Exception $e) {
                $this->flashMessenger()->addErrorMessage('Erro ao excluir comentario');
            }
        }

        return $this->redirect()->toUrl('/main');
        
    }

}
