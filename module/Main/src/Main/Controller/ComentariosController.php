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
        
        return new ViewModel(
          
        );
    }

    /**
     * Cria ou edita um comentario
     * @return void
     */
    public function saveAction()
    {
                return new ViewModel(
                    );
    }

     

    /**
     * Exclui um comentario
     * @return void
     */
    public function deleteAction()
    {
       
    }

}
